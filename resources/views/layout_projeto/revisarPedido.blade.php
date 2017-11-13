@extends("layouts.app")

@section("content")
    <div class="md-card uk-margin-large-bottom">
        <div class="md-card-content">
            <h3>Revisar Pedido</h3>

            <table class="uk-table uk-table-striped">
                <thead>
                    <tr>
                        <td>
                        Projeto
                        </td>
                        <td>
                        {{$Album->nomeAlbum}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Modelo
                        </td>
                        <td>
                        {{$Modelo->nome}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Tamanho
                        </td>
                        <td>
                        {{$Tamanho->tamanho}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Lâminas
                        </td>
                        <td>
                        @if ($Laminas<15)
                           {{$Laminas}} <span class="uk-label uk-label-danger">Valor mínimo 15 lâminas.</span>
                        @else
                            {{$Laminas}}
                        @endif
                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Capa do Álbum
                        </td>
                        <td>
                        @if ($Album->tipoCapa==1)
                           Fotográfica
                        @else
                            Napa
                        @endif
                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Papel Álbum
                        </td>
                        <td>
                        @if ($Album->id_papelAlbum==1)
                           Silk
                        @elseif ($Album->id_papelAlbum==2)
                           Fosco
                        @elseif ($Album->id_papelAlbum==3)
                            Brilho
                        @elseif ($Album->id_papelAlbum==4)
                            Canvas
                        @endif
                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Laminação Papel Álbum
                        </td>
                        <td>
                         @if ($Album->id_laminacaoPapel==1)
                           @if ($Album->id_papelAlbum==2)
                               UV Fosco
                            @elseif ($Album->id_papelAlbum==3)
                                Filme Brilho
                            @endif
                        @elseif ($Album->id_laminacaoPapel==2)
                             @if ($Album->id_papelAlbum==2)
                               UV Brilho
                            @endif
                        @elseif ($Album->id_laminacaoPapel==3)
                           
                        @elseif ($Album->id_laminacaoPapel==4)
                            Canvas
                        @endif
                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Acabamento Lateral
                        </td>
                        <td>
                        @if ($Album->id_lateral==1)
                           Prata
                        @elseif ($Album->id_lateral==2)
                           Prata Holográfica
                        @elseif ($Album->id_lateral==3)
                            Dourada
                        @elseif ($Album->id_lateral==4)
                            Dourada Holográfica
                        @elseif ($Album->id_lateral==5)
                            Preta
                        @elseif ($Album->id_lateral==6)
                            Natural
                        @endif
                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Tipo Estojo
                        </td>
                        <td>
                        @if ($Album->tipoEstojo==1)
                           Sem Caixa
                        @elseif ($Album->tipoEstojo==2)
                           Estojo
                        @elseif ($Album->tipoEstojo==3)
                            Caixa Sapato
                        @endif 
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Tipo Fecho Estojo
                        </td>
                        <td>
                        @if ($Album->tipoFecho==1)
                           Imã
                        @elseif ($Album->tipoFecho==2)
                           Fecho
                        @endif 
                        </td>
                    </tr>
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