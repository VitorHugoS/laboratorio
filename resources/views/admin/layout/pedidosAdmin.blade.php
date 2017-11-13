@extends("admin.layout.adminLayout")

@section("content")
 <section class="content-header">
      <h1>
       	Pedidos
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pedidos</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Projeto</th>
                  <th>Cliente</th>
                  <th>Status</th>
                  <th>Download</th>
                  <th>Ordem de Serviço</th>
                </tr>
                </thead>
                <tbody>
                 @foreach ($Projetos as $projeto)
                 	<tr>
                 		<td>{{$projeto->hash}}</td>
                 		<td>{{str_limit($projeto->nomeAlbum, 15)}}</td>                 	
                 		<td>{{str_limit($projeto->name, 15)}}</td>
                 		<td>
                 			@if ($projeto->status==0)
                                    Aguardando Envio!
                                @elseif ($projeto->status==1)
                                    Em Espera!
                                @elseif ($projeto->status==2)
                                    Em Produção!
                                @elseif ($projeto->status==3)
                                    Entregue!
                                @endif

                 		<td><a href="/admin/download/{{$projeto->hash}}" target="_blank">Download</a></td>
                 		<td><a href="/admin/ordem/{{$projeto->hash}}" target="_blank">Ordem</a></td>
                 	</tr>
                 @endforeach
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


@endsection