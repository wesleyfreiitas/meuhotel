@extends('header')
@section('titulo','Quartos')
@section('body')
<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="btn-group">
                <button type="button" id="LIVRE" onclick="filtro()" class="btn btn-success btn-xs">Livre
                </button>
                <button type="button" id="OCUPADO" onclick="filtro()" class="btn btn-warning btn-xs">Ocupado
                </button>
                <button type="button" id="RESERVADO" onclick="filtro()" class="btn btn-danger btn-xs">
                    Reservado
                </button>
                <button type="button" class="btn btn-xs">Todos</button>
                <button type="button" class="btn btn-xs" onclick="novoQuarto()">Novo Quarto</button>
            </div>
            <br>
        <table class="table table-bordered table-hover" id="tabelaQuarto">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Valor diária</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
            <!-- Aqui vem o formulário de adicionar quarto -->
        <div class="modal" tabindex="-1" role="dialog" id="dlgQuarto">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="formQuarto">
                        <!-- Título do form -->
                        <div class="modal-header">
                            <h5 class="modal-title">Novo Quarto</h5>
                        </div>
                        <!-- Fim -->
                        <!--Corpo do formulário -->
                        <div class="modal-body">
                            <input type="hidden" id="id" class="form-control">
                            <div class="form-group">
                                <label for="nomeQuarto" class="control-label">Nome</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomeQuarto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="vlrDiaria" class="control-label">Diária</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="vlr_diaria">
                                </div>
                            </div>
                                <label for="status" class="control-label"></label>
                                <input type="hidden" value="LIVRE" name="LIVRE" class="form-control" id="status">
                        </div>
                        <!-- Fim -->
                        <!--Footer do formulário -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar
                            </button>
                        </div>
                        <!-- Fim -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    });

    function filtro() {
        var tds = document.querySelectorAll('table td[data-estado]');
        document.querySelector('.btn-group').addEventListener('click', function (e) {
            var estado = e.target.id;
            for (var i = 0; i < tds.length; i++) {
                var tr = tds[i].closest('tr');
                tr.style.display = estado == tds[i].dataset.estado || !estado ? '' : 'none';
            }
        });
    }

    function novoQuarto() {
        $('#id').val('');
        $('#nomeQuarto').val('');
        $('#vlr_diaria').val('');
        $('#status');
        $('#dlgQuarto').modal('show');
    }

    function criarQuartos() {
        prod = {
            nome: $("#nomeQuarto").val(),
            vlr_diaria: $("#vlr_diaria").val(),
            status: $("#status").val()
        };
        $.post("api/quartos", prod, function (data) {
            console.log(prod);
            produto = JSON.parse(data);
            linha = montarLinha(produto);
            $('#tabelaQuarto>tbody').append(linha);
        });
    }

    function montarLinha(p) {

        if (p.status == "OCUPADO"){
                var x = '<button class="btn btn-xs btn-danger">'+p.status+'</button>';
        }else if(p.status == "RESERVADO"){
                var x = '<button class="btn btn-xs btn-primary">'+p.status+'</button>';
        }else{
            var x = '<button class="btn btn-xs btn-success">'+p.status+'</button>';
        }

        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.nome + "</td>" +
            "<td>" + p.vlr_diaria + "</td>" +
            "<td data-estado=" + p.status + " > " + x + "</td>" +
            "<td>" +
            '<button class="btn btn-xs btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
            '<button class="btn btn-xs btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function carregarQuartos() {
        $.getJSON('/api/quartos', function (produtos) {
            for (i = 0; i < produtos.length; i++) {
                linha = montarLinha(produtos[i]);
                $('#tabelaQuarto>tbody').append(linha);
            }
        });
    }

    function editar(id) {
        $.getJSON('/api/quartos/' + id, function (data) {
            console.log(data);
            $('#id').val(data.id);
            $('#nomeQuarto').val(data.nome);
            $('#vlr_diaria').val(data.vlr_diaria);
            $('#dlgQuarto').modal('show');
        });
    }

    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/quartos/" + id,
            context: this,
            success: function () {
                console.log('Apagou OK');
                linhas = $("#tabelaQuarto>tbody");
                e = linhas.filter(function (i, elemento) {
                    return elemento.cells[0].textContent == id;
                });
                if (e)
                    e.remove();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function salvarQuartos() {
        prod = {
            id: $("#id").val(),
            nome: $("#nomeQuarto").val(),
            vlr_diaria: $("#vlr_diaria").val(),
        };
        $.ajax({
            type: "PUT",
            url: "/api/quartos/" + prod.id,
            context: this,
            data: prod,
            success: function (data) {
                prod: JSON.parse(data);
                linhas = $('#tabelaQuarto>tbody');
                e = linhas.filter(function (i, e) {
                    return (e.cells[0].textContent == prod.id);
                });
                if (e) {
                    e[0].cells[0].textContent = prod.id;
                    e[0].cells[1].textContent = prod.nome;
                    e[0].cells[2].textContent = prod.vlr_diaria;
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    $('#formQuarto').submit(function (event) {
        event.preventDefault();
        if ($("#id").val() != '')
            salvarQuartos();
        else
            criarQuartos();

        $("#dlgQuarto").modal('hide');
    });

    $(function () {
        carregarQuartos();
    });
</script>
@endsection
