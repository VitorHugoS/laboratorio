@extends("layouts.app")

@section("content")
    <div class="md-card uk-margin-large-bottom">
        <div class="md-card-content">
            <h3>Projetos em adamento</h3>


            <table class="uk-table uk-table-striped">
                <thead>
                    <tr>
                        <th>Nome do projeto</th>
                        <th>Status</th>
                        <th>Editar Projeto</th>
                        <th>Apagar  </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Projetos as $projeto)
                       <tr>
                            <td>{{$projeto->nomeAlbum}}</td>
                            <td>
                                @if ($projeto->status==0)
                                    Aguardando Envio!
                                @elseif ($projeto->status==1)
                                    Em Espera!
                                @elseif ($projeto->status==2)
                                    Em Produção!
                                @elseif ($projeto->status==3)
                                    Entregue!
                                @else
                                    Erro ao carregar status!
                                @endif

                            </td>
                            <td>
                            @if ($projeto->status==0)
                                <a href="/projeto/{{$projeto->hash}}" uk-icon="icon: image"></a></td>
                            @elseif ($projeto->status==1)
                                    Em Espera!
                                @elseif ($projeto->status==2)
                                    Em Produção!
                                @elseif ($projeto->status==3)
                                    Entregue!
                                @else
                                    Erro ao carregar status!
                                @endif

                            <td>
                            <button onclick="deletarProjeto({{$projeto->id}})" class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-example" uk-icon="icon: trash"></button>
                               
                            </td>


<!-- This is a button toggling the modal -->



<!-- This is the modal -->
<div id="modal-example" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Deseja realmente apagar o projeto?</h2>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Não</button>
            <form method="post" action="/deletarProjeto">
                {{ csrf_field() }}
                <input type="hidden" name="deletarAlbum">
            <button class="uk-button uk-button-primary" type="submit">Sim</button>
            </form>
        </p>
    </div>
</div>
                            <!-- This is the modal -->
                            
                       </tr>
                    @endforeach
                </tbody>
        </table>

        </div>
    </div>
@endsection
@section("js")
<script type="text/javascript">
    function deletarProjeto(id){
        $("input[name=deletarAlbum]").val(id);
    }
</script>

@endsection