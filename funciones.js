function generarTicket() {
    $.ajax({
        url: 'ticket.php',
        type: 'GET',
        dataType: 'text', 
        success: function(data) {
            $("#resultado").text("Ticket generado: " + data);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Hubo un error al generar el ticket.');
        }
    });
}

function cargarTickets() {
    $.ajax({
        url: "lista.php", 
        type: "GET",
        dataType: "json",
        success: function(data) {
            let lista = $("#listaTickets");
            lista.empty();
            if (data.length === 0) {
                lista.append('<li>No hay tickets pendientes.</li>');
            } else {
                data.forEach(ticket => {
                    lista.append(`${ticket.nombre}<br>`);
                });
            }
        },
        error: function() {
            alert("Error al cargar los tickets.");
        }
    });
}
function cargarCajas() {
    $.ajax({
        url: "turno.php", 
        type: "GET",
        dataType: "json",
        success: function(data) {
         
            $("#caja1").text(data.caja1);
            $("#caja2").text(data.caja2);
            $("#caja3").text(data.caja3);
            $("#caja4").text(data.caja4);
        },
        error: function() {
            alert("Error al cargar los tickets.");
        }
    });
}
function actualizarCaja() {
    fetch("actualizar_caja.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            estado_id: 3,
            nuevo_estado: 2,
            caja_id: 1
        })
    })
    .then(response => response.json())  
    .then(data => {
        if (data.success) {
            alert("La caja ha sido actualizada.");
            
        } else {
            alert("Hubo un error al actualizar la caja.");
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Hubo un error en la solicitud.");
    });
}
function cambiarEstadoSiguiente() {

    fetch("cambiar_estado_siguiente.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            estado_id_actual: 1,
            estado_id_nuevo: 3
        })
    })
    .then(response => response.json())  
    .then(data => {
        if (data.success) {
            alert("El estado del ticket ha sido actualizado.");
          
        } else {
            alert("No se encontró un ticket con el estado especificado o hubo un error.");
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Hubo un error en la solicitud.");
    });
}
