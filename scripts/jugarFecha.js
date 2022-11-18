let subir = document.querySelector('.subir');
let jugadoresA,jugadoresB, equipos, goles, data = [];

subir.addEventListener('click', e => {
    e.preventDefault();

    jugadoresA = document.querySelectorAll('.jugador-0');
    jugadoresB = document.querySelectorAll('.jugador-1');
    equipos = document.querySelectorAll('.equipo');
    //golesA = document.querySelector('.goles-0');
    //golesB = document.querySelector('.goles-1')

    equipos.forEach((equipo,i) => {
        //Obtenemos el Id del equipo
        let idEquipo = equipo.value.split("=")[1];

        //Obtenemos los goles del equipo
        goles = document.querySelector(`.goles-${i}`).value;

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
    
    console.log(JSON.stringify(data))
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
})