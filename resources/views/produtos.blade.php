@extends('header')
@section('titulo','hospede')

@section('body')
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <button type="button" class="btn btn-primary" onclick="novoProduto()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path
                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Novo Produto
                </button><br>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tabelaProduto">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Estoque</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                        <!-- Aqui vem o formulário que cadastra os hospedes -->
                        <div class="modal" tabindex="-1" role="dialog" id="dlgProduto">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <form class="form-horizontal" id="formProduto">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Novo Produto</h5>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" id="id" class="form-control">
                                            <div class="form-group">
                                                <label for="nomeProduto" class="control-label">Nome do produto</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="nomeProduto">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="qtdEstoque" class="control-label">Estoque</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="qtdEstoque">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="categoriaProduto" class="control-label">Categoria</label>
                                                <div class="input-group">
                                                    <select class="form-control" id="categoriaProduto">

                                                    </select>
                                                </div>
                                                <!--<div class="input-group">
                                                    <input type="text" class="form-control" id="categoria">
                                                </div>-->
                                            </div>
                                            <div class="form-group">
                                                <label for="preco" class="control-label">Preço</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="preco">
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
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        function novoProduto(){
            $('#id').val('');
            $('#nomeProduto').val('');
            $('#qtdEstoque').val('');
            $('#preco').val('');
            $('#dlgProduto').modal('show');
        }

        function criarProdutos() {
            prod = {
                nome: $("#nomeProduto").val(),
                categoria_id: $("#categoriaProduto").val(),
                estoque: $("#qtdEstoque").val(),
                preco: $("#preco").val()
            };

            $.post("api/produtos", prod, function (data) {
                console.log(prod);
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $('#tabelaProduto>tbody').append(linha);
            });
        }

        function montarLinha(p){
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.nome + "</td>" +
                "<td>" + p.categoria.nome + "</td>" +
                "<td>" + p.estoque + "</td>" +
                "<td>" + p.preco + "</td>" +
                "<td>" +
                '<button class="btn btn-xs btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
                '<button class="btn btn-xs btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
                "</td>" +
                "</tr>";
            return linha;
        }

        function carregarProdutos() {
            $.getJSON('/api/produtos', function (produtos) {
                for (i = 0; i < produtos.length; i++) {
                    linha = montarLinha(produtos[i]);
                    $('#tabelaProduto>tbody').append(linha);
                }
            });
        }

        function carregarCategorias() {
            $.getJSON('/api/categorias', function(data) {
                for(i=0;i<data.length;i++) {
                    opcao = '<option value ="' + data[i].id + '">' +
                        data[i].nome + '</option>';
                    $('#categoriaProduto').append(opcao);
                }
            });
        }

        function editar(id){
            $.getJSON('/api/produtos/' + id, function (data) {
                console.log(data);
                $('#id').val(data.id);
                $('#nomeProduto').val(data.nome);
                $('#categoriaProduto').val(data.categoria_id);
                $('#qtdEstoque').val(data.estoque);
                $('#preco').val(data.preco);
                $('#dlgProduto').modal('show');
            });
        }

        function remover(id){
            $.ajax({
                type: "DELETE",
                url: "/api/produtos/" + id,
                context: this,
                success: function () {
                    console.log('Apagou OK');
                    linhas = $("#tabelaProduto>tbody>tr");
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

        function salvarProdutos() {
            prod = {
                id: $("#id").val(),
                nome: $("#nomeProduto").val(),
                estoque: $("#qtdEstoque").val(),
                preco: $("#preco").val()
            };
            $.ajax({
                type: "PUT",
                url: "/api/produtos/" + prod.id,
                context: this,
                data: prod,
                success: function (data) {
                    prod: JSON.parse(data);
                    linhas = $('#tabelaProduto>tbody>tr');
                    e = linhas.filter(function (i, e) {
                        return (e.cells[0].textContent == prod.id);
                    });
                    if (e) {
                        e[0].cells[0].textContent = prod.id;
                        e[0].cells[1].textContent = prod.nome;
                        e[0].cells[2].textContent = prod.estoque;
                        e[0].cells[3].textContent = prod.preco;
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        $('#formProduto').submit(function (event) {
            event.preventDefault();
            if ($("#id").val() != '')
                salvarProdutos();
            else
                criarProdutos();

            $("#dlgProduto").modal('hide');
        });

        $(function () {
            carregarProdutos();
            carregarCategorias();
        });
    </script>
@endsection
