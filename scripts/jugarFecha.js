let subir = document.querySelector('.subir');
let jugadoresA,jugadoresB, equipos, goles, data = [];
let estado = true;
let golesA = 0, golesB = 0, golesTemporalesA = 0, golesTemporalesB = 0;

subir.addEventListener('click', e => {
    e.preventDefault();

    jugadoresA = document.querySelectorAll('.jugador-0');
    jugadoresB = document.querySelectorAll('.jugador-1');
    equipos = document.querySelectorAll('.equipo');

    equipos.forEach((equipo,i) => {
        //Obtenemos el Id del equipo
        let idEquipo = equipo.value.split("=")[1];

        //Obtenemos los goles del equipo
        goles = document.querySelector(`.goles-${i}`).value;
        if(i == 0) golesA = goles;
        else golesB = goles;

        //Obtenemos todos los jugadores del equipo
        jugadores = document.querySelectorAll(`.jugador-${i}`);

        let goleadores = []; //Array vacio para meter a los goleadores

        jugadores.forEach(jugador => {
            //Obtenemos los jugadores que realizaron goles
            if(jugador.value > 0){
                goleadores.push({
                    idJugador : jugador.getAttribute('key').split("=")[1],
                    goles : jugador.value
                })

                if(i == 0) golesTemporalesA += parseInt(jugador.value);
                else golesTemporalesB += parseInt(jugador.value);

            }
        })

        let obj = {
            equipo : idEquipo,
            goles,
            goleadores
        };

        //Metemos el objeto del equipo en el array Data
        data.push(obj);
    })

    if(golesA != golesTemporalesA || golesB != golesTemporalesB) estado = false;
    else estado = true;

    console.log("Goles A: " + golesA + " golesB: " + golesB + "GolesTmpA: " + golesTemporalesA + "GolesTmpB: " + golesTemporalesB)

    console.log("Estado = " + estado)
    //console.log(JSON.stringify(data))
    if(estado){

      try{
          let body = new FormData;
          body.append("json",JSON.stringify(data));

          fetch("tools/cargarResultados.php",{
              headers : new Headers(),
              method : "POST",
              body
          })
          .then(res => res.text())
          .then(res => {
              console.log(res);
              window.location.href="./"; //TODO Probar que funcione
          })
          .catch(e => console.log("Error: " + e))
      }
      catch(e){
          console.log("Error: " + e)
      }

    }
    else{
      estado = true;
        golesA = 0;
        golesB = 0;
        golesTemporalesA = 0;
        golesTemporalesB = 0;
    }
})
