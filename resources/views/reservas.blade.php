@extends('header')
@section('titulo','Reservas')
@section('body')
<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="form-group">
                <button type="button" class="btn btn-primary" onclick="novaReserva()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Adicionar reserva
                </button>
            </div>
        <div>
        <!-- FILTROS DE ABERTO ENCERRADO E ANDAMENTO -->
        <div class="btn-group" style="display:none" id="statusdosap">
            <button type="button" id="LIVRE" onclick="filtro()" class="btn btn-success btn-xs">Livre</button>
            <button type="button" id="OCUPADO" onclick="filtro()" class="btn btn-warning btn-xs">Ocupado</button>
            <button type="button" id="RESERVADO" onclick="filtro()" class="btn btn-danger btn-xs">Reservado</button>
            <button type="button" class="btn btn-xs">Todos</button>
        </div>
        <!--FIM DOS FILTROS DE ABERTO ENCERRADO E ANDAMENTO -->

        <table class="table table-bordered table-hover" id="tabelaReserva">
            <thead>
            <tr>
                <th>ID</th>
                <th>Hospede</th>
                <th>Quarto</th>
                <th>Status</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <!-- PARA QUE FUNCIONE O JAVASCRIPT DO FILTRO DE ABERTO ANDAMENTO ENCERRADO, É PRECISO
                CONFIGURAR O RETORNO DO BANCO COM O DATA ESTADO
        <tr>
            <td>#1</td>
            <td>Internet</td>
            <td data-estado="encerrado">Encerrado</td>
            <td>Alexandre</td>
            <td>Carlos</td>
        </tr>
        <tr>
            <td>#2</td>
            <td>Monitor</td>
            <td data-estado="aberto">Aberto</td>
            <td>Renato</td>
            <td>#</td>
        </tr>
        <tr>
            <td>#3</td>
            <td>Formatação</td>
            <td data-estado="em_andamento">andamento</td>
            <td>Alexandre</td>
            <td>José</td>
        </tr>
FIM DA CONFIGURAÇÃO
    -->
            </tbody>
        </table>
    </div>
    <!--Adicionar reserva -->
    <div class="modal" tabindex="-1" role="dialog" id="dlgReserva">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formReserva">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Reserva</h5>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="id" class="form-control">

                        <div class="row">
                            <!--
                             <div class="col-4">
                                <div class="form-group">
                                    <label for="status" class="control-label">Ação</label>
                                </div>
                                <div class="form-group">
                                    <label for="hospede_id" class="control-label">Hospede</label>
                                </div>
                                <div class="form-group">
                                    <label for="quarto_id" class="control-label">Quarto</label>
                                </div>
                                <div class="form-group">
                                    <label for="nomePeriodo" class="control-label">Período</label>
                                </div>

                                <div class="form-group">
                                    <label for="numeroHospede" class="control-label">Número de hospedes</label>
                                </div>
                                <div class="form-group">
                                    <label for="obs" class="control-label">Observação</label>
                                </div>
                            </div>
                             -->
                            <div class="8">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <select class="form-control" id="status">
                                                    <option value="OCUPADO">Hospedar</option>
                                                    <option value="RESERVADO">Reservar</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="datetime-local" class="form-control" style="width:0px;"
                                               id="chegada">
                                        <input type="datetime-local" class="form-control" id="saida">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control" id="hospede_id">

                                        </select>
                                        <button class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                                <path
                                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                <path fill-rule="evenodd"
                                                      d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control" id="quarto_id">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" class="form-control" style="width:0px;" id="adulto"
                                               placeholder="Adulto">
                                        <input type="number" class="form-control" id="crianca"
                                               placeholder="    Crianças">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <textarea class="form-control" rows="10" cols="10" id="obs"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
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

        function novaReserva() {
            $('#id').val('');
            $('#chegada').val('');
            $('#saida').val('');
            $('#adulto').val('');
            $('#crianca').val('');
            $('#status').val('');
            $('#obs').val('');
            $('#hospede_id').val('');
            $('#quarto_id').val('');
            $('#dlgReserva').modal('show');
        }

        function montarLinha(p) {
            if (p.quarto.status == "OCUPADO"){
                var x = '<button class="btn btn-xs btn-danger">'+p.quarto.status+'</button>';
            }else{
                var x = '<button class="btn btn-xs btn-primary">'+p.quarto.status+'</button>';
            }
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.hospede.nome + "</td>" +
                "<td>" + p.quarto.nome + "</td>" +
                "<td data-estado=" + p.quarto.status +">"  + x + "</td>" +
                "<td>" + p.chegada + "</td>" +
                "<td>" + p.saida + "</td>" +
                "<td>" +
                '<button class="btn btn-xs btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
                '<button class="btn btn-xs btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
                "</td>" +
                "</tr>";

            

            return linha;
        }
        function editar(id) {
            $.getJSON('/api/comandas/' + id, function (data) {
                console.log(data);
                $('#id').val(data.id);
                $("#status").val(data.status);
                $("#chegada").val(data.chegada);
                $("#saida").val(data.saida);
                $("#obs").val(data.obs);
                $("#quarto_id").val(data.quarto_id);
                $("#hospede_id").val(data.hospede_id);
                $("#crianca").val(data.crianca);
                $("#adulto").val(data.adulto);
                $('#dlgReserva').modal('show');
            });
        }

        function remover(id) {
            $.ajax({
                type: "DELETE",
                url: "/api/comandas/" + id,
                context: this,
                success: function () {
                    console.log('Apagou OK');
                    linhas = $("#tabelaReserva>tbody>tr");
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

        function carregarReservas() {
            $.getJSON('/api/comandas', function (produtos) {
                for (i = 0; i < produtos.length; i++) {
                    linha = montarLinha(produtos[i]);
                    $('#tabelaReserva>tbody').append(linha);
                }
            });
        }

        function criarReservas() {
            prod = {
                status: $("#status").val(),
                chegada: $("#chegada").val(),
                saida: $("#saida").val(),
                obs: $("#obs").val(),
                quarto_id: $("#quarto_id").val(),
                hospede_id: $("#hospede_id").val(),
                crianca: $("#crianca").val(),
                adulto: $("#adulto").val()
            };
            $.post("api/comandas", prod, function (data) {
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $('#tabelaReserva>tbody').append(linha);
            });

            $.ajax({
                type: "PATCH",
                url: "/api/atualizaQuartos/" + prod.quarto_id,
                context: this,
                data: prod,
                success: function (data) {
                    prod: JSON.parse(data);
                    linhas = $('#tabelaQuartos>tbody>tr');
                    e = linhas.filter(function (i, e) {
                        return (e.cells[0].textContent == prod.quarto_id);
                    });
                    if (e) {
                        e[0].cells[0].textContent = prod.status;
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function salvarReservas() {
            prod = {
                id: $("#id").val(),
                status: $("#status").val(),
                chegada: $("#chegada").val(),
                saida: $("#saida").val(),
                obs: $("#obs").val(),
                quarto_id: $("#quarto_id").val(),
                hospede_id: $("#hospede_id").val(),
                crianca: $("#crianca").val(),
                adulto: $("#adulto").val()
            };
            $.ajax({
                type: "PUT",
                url: "/api/comandas/" + prod.id,
                context: this,
                data: prod,
                success: function (data) {
                    prod: JSON.parse(data);
                    linhas = $('#tabelaReserva>tbody>tr');
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

        function carregarHospedes() {
            $.getJSON('/api/hospedes', function (data) {
                for (i = 0; i < data.length; i++) {
                    opcao = '<option value ="' + data[i].id + '">' +
                        data[i].nome + '</option>';
                    $('#hospede_id').append(opcao);
                }
            });
        }

        function carregarQuartos() {
            $.getJSON('/api/quartos', function (data) {
                for (i = 0; i < data.length; i++) {
                    opcao = '<option value ="' + data[i].id + '">' +
                        data[i].nome + '</option>';
                    $('#quarto_id').append(opcao);
                }
            });
        }
        /*CODIGO JS QUE FAZ O FILTRO POR ABERTO ANDAMENTO E ENCERRADO.*/
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
        /*FIM DO JS QUE FAZ O FILTRO POR ABERTO ANDAMENTO E ENCERRADO. */

        $('#formReserva').submit(function (event) {
            event.preventDefault();
            if ($("#id").val() != '')
                salvarReservas();
            else
                criarReservas();

            $("#dlgReserva").modal('hide');
        });
/*Mostra os filtros*/
function mostrarFiltros(){
    $("#mostrar").click(function () {
        $("#statusdosap").show();
    });
}

        $(function () {
            carregarReservas();
            carregarHospedes();
            carregarQuartos();
        })


    </script>
@endsection

