window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const tabelaReserva = document.getElementById('tabelaReserva');
    if (tabelaReserva) {
        new simpleDatatables.DataTable(tabelaReserva);
    }
});
