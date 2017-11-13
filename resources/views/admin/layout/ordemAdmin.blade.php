@extends("admin.layout.adminLayout")

@section("content")
   <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td>
                        Código
                        </td>
                        <td>
                        {{$Album->hash}}
                        </td>
                    </tr>
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
                           {{$Laminas}} 
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
                    <tr>
                        <td>Cliente</td>
                        <td>{{$Cliente->name}}</td>
                    </tr>
                </tbody>
        </table>

         </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection
@section("js")
<script type="text/javascript">
    function deletarProjeto(id){
        $("input[name=deletarAlbum]").val(id);
    }
</script>

@endsection