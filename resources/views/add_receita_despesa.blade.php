@extends('header')
@section('titulo','Financeiro')
@section('body')
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4"><br><br>
            <div class="row">
                <div class="card-deck">
                    <div class="card" style="width: 20rem;">

                        <div class="card-body">
                            <h5 class="card-title">Credito
                                <!--  <span style="margin-left:180px; color: green;">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                   class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd"
                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                          </svg></span>-->
                            </h5>
                            <h1 class="card-text" style="color: green">R$ 0.00</h1>
                        </div>

                    </div>


                    <div class="card" style="width: 20rem;">

                        <div class="card-body">
                            <h5 class="card-title">Debito
                                <!--<span style="margin-left:180px; color: red;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                        </svg></span>-->
                            </h5>
                            <h1 class="card-text" style="color: red">R$ 0.00</h1>
                        </div>

                    </div>
                    <div class="card" style="width: 20rem; background-color:green; color:white;">

                        <div class="card-body">
                            <h5 class="card-title">Saldo
                                <!--<span style="margin-left:180px; color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            class="bi bi-bank" viewBox="0 0 16 16">
                            <path
                                d="M8 .95 14.61 4h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.379l.5 2A.5.5 0 0 1 15.5 17H.5a.5.5 0 0 1-.485-.621l.5-2A.5.5 0 0 1 1 14V7H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 4h.89L8 .95zM3.776 4h8.447L8 2.05 3.776 4zM2 7v7h1V7H2zm2 0v7h2.5V7H4zm3.5 0v7h1V7h-1zm2 0v7H12V7H9.5zM13 7v7h1V7h-1zm2-1V5H1v1h14zm-.39 9H1.39l-.25 1h13.72l-.25-1z"/>
                        </svg></span>-->
                            </h5>
                            <h1 class="card-text" style="color: white">R$ 0.00</h1>

                        </div>

                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="card text-center">
                <div class="card-header">
                    LIVRO CAIXA
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="tabelaProduto">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>DT. LANCAMENTO</th>
                            <th>TIPO</th>
                            <th>NOME CAIXA</th>
                            <th>OPERADOR</th>
                            <th>VALOR</th>
                            <th>TIPO PG</th>
                            <th>REPETIR</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted" style="text-align:right;">

                    <button class="btn btn-secondary" role="button" onclick="buscaConta()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-search"
                             viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        Buscar
                    </button>
                    <button class="btn btn-primary" role="button" onclick="adicionaConta()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Adicionar
                    </button>
                    <button class="btn btn-secondary" role="button" onclick="imprimeConta()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-printer"
                             viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                            <path
                                d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                        </svg>
                        Imprimir
                    </button>
                    <button class="btn btn-danger" role="button" onclick="apagaConta()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-trash"
                             viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd"
                                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        Apagar
                    </button>
                    <button class="btn btn-warning" role="button" onclick="editaConta()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-pencil"
                             viewBox="0 0 16 16">
                            <path
                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                        Editar
                    </button>
                </div>
            </div>
            <!--configuração dos botões -->
            <!--Recurso de adicionar -->
            <div class="modal" tabindex="-1" role="dialog" id="adcProduto">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" id="formProduto">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Contas</h5>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" id="id" class="form-control">
                                <div class="row" style="margin-left:80px;">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                               id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Receita
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                               id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Despesa
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                               id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">
                                            Transparência
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6" style="margin-bottom: 12px;">
                                        <div class="form-group">
                                            <label class="control-label">Descrição</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="categoriaProduto" class="control-label">Forma de
                                                pagamento</label>
                                        </div>
                                        <br>
                                        <div class="form-group ">
                                            <label for="categoriaProduto" class="control-label">Conta caixa</label>
                                        </div>
                                        <br>
                                        <div class="form-group ">
                                            <label for="categoriaProduto" class="control-label">Caixa</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="precoProduto" class="control-label">Valor</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="quantidadeProduto" class="control-label">Data</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantidadeProduto" class="control-label">Observacoes</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantidadeProduto" class="control-label">Parcelado?</label>
                                        </div>
                                        <div class="form-group" id="divOutsourcing" data-label="outsourcing"
                                             style="display: none;">
                                            <div id="outsourcing">
                                                <label for="quantidadeProduto" class="control-label">Qtd.
                                                    Parcelas</label><br>
                                                <label for="quantidadeProduto" class="control-label">
                                                    Intervalo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nomeProduto"
                                                       placeholder="Nome do produto">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control" id="categoriaProduto">
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group ">
                                                <div class="input-group">
                                                    <select class="form-control" id="categoriaProduto">
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group ">
                                                <div class="input-group">
                                                    <select class="form-control" id="categoriaProduto">
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="precoProduto"
                                                           placeholder="Preço do produto">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="date" class="form-control" id="quantidadeProduto">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="textarea" size="140" class="form-control"
                                                           id="quantidadeProduto"
                                                           placeholder="Observacoes do dadasto da conta">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="switch__container" id="segmento">

                                                        <input id="switch-shadow" class="switch switch--shadow"
                                                               type="checkbox" name="outsourcing" value="outsourcing">
                                                        <label for="switch-shadow"></label>

                                                    </div>

                                                    <div class="form-group" id="divOutsourcing" data-label="outsourcing"
                                                         style="display: none;">

                                                        <div id="outsourcing">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="textarea" class="form-control"
                                                                           id="quantidadeProduto"
                                                                           placeholder="quantidade deparcelas">
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="input-group">
                                                                        <select class="form-control"
                                                                                id="categoriaProduto">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
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
        //configuracao do on/off
        $('#segmento input[type="checkbox"]').change(function () {

            let name = this.value;

            $('[data-label=' + name + ']').css('display', this.checked ? '' : 'none');

        });//fim da configuracao do on/off
        function adicionaConta() {
            $('#adcProduto').modal('show');
        }
    </script>
@endsection
