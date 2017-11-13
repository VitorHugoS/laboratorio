@extends("admin.layout.adminLayout")

@section("content")
 <section class="content-header">
      <h1>
       	Clientes
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Clientes</a></li>
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
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Telefone</th>
                  <th>Celular</th>
                </tr>
                </thead>
                <tbody>
                 @foreach ($Clientes as $cliente)
                 	<tr>
                 		<td>{{str_limit($cliente->name, 15)}}</td>
                 		<td>{{str_limit($cliente->email, 30)}}</td>                 	
                 		<td>{{str_limit($cliente->telefone, 15)}}</td>
                 		<td>{{str_limit($cliente->celular, 15)}}</td>
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