// admin.js
function avanzarTurno(idCajero) {
    // Aquí haces una solicitud AJAX para actualizar el turno en la base de datos
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "actualizar_turno.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Actualizar la parte de la interfaz de usuario después de la respuesta
                var response = JSON.parse(xhr.responseText);
                console.log(response); // Ver la respuesta JSON parseada
                var nuevoNumero = response.nuevoNumero;
                var cajeroNumeroElement = document.getElementById(idCajero + "Numero");
                cajeroNumeroElement.textContent = nuevoNumero;
            } else {
                console.error('Hubo un error al actualizar el turno');
            }
        }
    };
    xhr.send("cajero_id=" + idCajero);
}
