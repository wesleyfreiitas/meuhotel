window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const tabelaQuarto = document.getElementById('tabelaQuarto');
    if (tabelaQuarto) {
        new simpleDatatables.DataTable(tabelaQuarto);
    }
});
