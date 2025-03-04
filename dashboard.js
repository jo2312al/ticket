document.addEventListener('DOMContentLoaded', async () => {
    const respuesta = await fetch('dashboard.php');
    const datos = await respuesta.json();

    // Gráfico de clientes atendidos por caja
    new Chart(document.getElementById('graficoAtendidos'), {
        type: 'bar',
        data: {
            labels: datos.atendidos.map(d => `Caja ${d.caja}`),
            datasets: [{
                label: 'Clientes Atendidos',
                data: datos.atendidos.map(d => d.total),
                backgroundColor: 'blue'
            }]
        }
    });

    // Gráfico de clientes que no asistieron
    new Chart(document.getElementById('graficoNoAsistieron'), {
        type: 'doughnut',
        data: {
            labels: ['No Asistieron', 'Asistieron'],
            datasets: [{
                data: [datos.no_asistieron, datos.atendidos.reduce((acc, d) => acc + d.total, 0)],
                backgroundColor: ['red', 'green']
            }]
        }
    });
});
