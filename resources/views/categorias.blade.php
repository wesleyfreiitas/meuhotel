@extends('header')
@section('titulo','Categorias')
@section('body')
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <button type="button" class="btn btn-primary" onclick="novaCategoria()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path
                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Nova categoria
                </button><br>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tabelaCategoria">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <!-- Aqui vem o formulário que cadastra os hospedes -->
                    <div class="modal" tabindex="-1" role="dialog" id="dlgCategoria">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <form class="form-horizontal" id="formCategoria">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Nova categoria</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="id" class="form-control">
                                        <div class="form-group">
                                            <label for="nomeCategoria" class="control-label">Nome do categoria</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nomeCategoria">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
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

        function novaCategoria(){
            $('#id').val('');
            $('#nomeCategoria').val('');
            $('#dlgCategoria').modal('show');
        }
        function criarCategorias() {
            prod = {
                nome: $("#nomeCategoria").val()
            };

            $.post("api/categorias", prod, function (data) {
                console.log(prod);
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $('#tabelaCategoria>tbody').append(linha);
            });
        }

        function montarLinha(p){
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.nome + "</td>" +
                "<td>" +
                '<button class="btn btn-xs btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
                '<button class="btn btn-xs btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
                "</td>" +
                "</tr>";
            return linha;
        }

        function carregarCategorias() {
            $.getJSON('/api/categorias', function (produtos) {
                for (i = 0; i < produtos.length; i++) {
                    linha = montarLinha(produtos[i]);
                    $('#tabelaCategoria>tbody').append(linha);
                }
            });
        }

        function editar(id){
            $.getJSON('/api/categorias/' + id, function (data) {
                console.log(data);
                $('#id').val(data.id);
                $('#nomeCategoria').val(data.nome);
                $('#dlgCategoria').modal('show');
            });
        }

        function remover(id){
            $.ajax({
                type: "DELETE",
                url: "/api/categorias/" + id,
                context: this,
                success: function () {
                    console.log('Apagou OK');
                    linhas = $("#tabelaCategoria>tbody>tr");
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

        function salvarCategorias() {
            prod = {
                id: $("#id").val(),
                nome: $("#nomeCategoria").val()
            };
            $.ajax({
                type: "PUT",
                url: "/api/categorias/" + prod.id,
                context: this,
                data: prod,
                success: function (data) {
                    prod: JSON.parse(data);
                    linhas = $('#tabelaCategoria>tbody>tr');
                    e = linhas.filter(function (i, e) {
                        return (e.cells[0].textContent == prod.id);
                    });
                    if (e) {
                        e[0].cells[0].textContent = prod.id;
                        e[0].cells[1].textContent = prod.nome;
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        $('#formCategoria').submit(function (event) {
            event.preventDefault();
            if ($("#id").val() != '')
                salvarCategorias();
            else
                criarCategorias();

            $("#dlgCategoria").modal('hide');
        });

        $(function () {
            carregarCategorias();
        });
</script>
@endsection
