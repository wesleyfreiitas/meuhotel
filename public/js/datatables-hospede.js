window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const tabelaHospede = document.getElementById('tabelaHospede');
    if (tabelaHospede) {
        new simpleDatatables.DataTable(tabelaHospede);
    }
});
