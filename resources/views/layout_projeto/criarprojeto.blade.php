@extends("layouts.app")

@section("content")
<style type="text/css">
    .modelConfirm{
        background-color: green;
        color: #fff;
    }
    .uk-alert-success{
        background-color: green!important;
        color: #fff!important;
    }

.custom-file-upload-hidden {
    display: none;
    visibility: hidden;
    position: absolute;
    left: -9999px;
}
.custom-file-upload {
    display: block;
    width: auto;
    font-size: 16px;
    margin-top: 0;
    //border: 1px solid #ccc;
    label {
        display: block;
        margin-bottom: 5px;
    }
}

.file-upload-wrapper {
    position: relative; 
    margin-bottom: 5px;
    //border: 1px solid #ccc;
}
.file-upload-input {
    width: 300px;
    color: #fff;
    font-size: 16px;
    padding: 11px 17px; 
    border: none;
    background-color: #c0392b; 
    float: left; /* IE 9 Fix */
}
.file-upload-button {
    cursor: pointer; 
    display: inline-block; 
    color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    padding: 11px 20px; 
    border: none;
    margin-left: -1px;  
    background-color: darken(#c0392b, 10); 
    float: left; /* IE 9 Fix */

}
</style>
            <div class="md-card uk-margin-large-bottom">
                <div class="md-card-content">
                    <form method="post"  action="/criarProjeto" class="uk-form-stacked" id="wizard_advanced_form" enctype="multipart/form-data">
                         {{ csrf_field() }}
                        <input type="hidden" name="idUsuario" value="{{ Auth::user()->id }}">
                        <h1 class="uk-text-center">Criar Projeto</h1>
                        <hr>
                        <div>
                            <h2>Nome do projeto</h2>
                             <div class="uk-margin">
            <input class="uk-input" type="text" name="nomeProjeto" placeholder="Nome">
        </div>
                        </div>
                        <div> 
                            <h2>Selecione o modelo do Álbum</h2>
                            <table id="modelos">
                            <tr>
                            @foreach ($Modelos as $modelo)
                               <td id="model{{$modelo->id}}" onclick="selecionaModelo({{$modelo->id}}, '{{$modelo->nome}}')" class="uk-text-center"><img src="{{$modelo->url}}" style="width: 250px;"><br>{{$modelo->nome}}</td>
                            @endforeach
                            </tr>
                                <input type="hidden" name="modelo" value="0">
                            </table>
                            <h3 id="checkedM" class="uk-hidden uk-text-center uk-text-success">Modelo Selecionado: <span class="modelChecked"></span></h3>
                        </div>
                        <hr>
                        <div id="tamanhos" class="uk-hidden"> 
                            <h2>Selecione o tamanho do Álbum</h2>
                            <div class="uk-margin">

                                <select name="tamanhoAlbum" class="uk-select">
                                      
                                </select>
                            </div>
                            <hr>
                        </div> 

                        <div id="capa" class="uk-hidden"> 
                            <h2>Selecione a capa do Álbum</h2>
                            <table id="capas">

                            </table>
                            <input type="hidden" name="tipoCapaEscolhida" value="0">
                            <div id="fotografico" class="uk-hidden">
                            <hr>
                                <h3>Envie a imagem para capa</h3>

                                <div class="custom-file-upload">
                                    <!--<label for="file">File: </label>--> 
                                    <input type="file" id="file" name="imageCapa" />
                                </div>
                                <div class="clearfix"></div>
                                <h3>Escolha o papel da capa</h3>
                                <select name="papelCapaFoto" class="uk-select">
                                        <option disabled selected="">Selecione uma opção</option>
                                        <option>Silk</option>
                                        <option>Fosco</option>
                                        <option>Brilho</option>                            
                                </select>
                            </div>
                            <div id="revestimento" class="uk-hidden">
                            <hr>
                            <h3>Selecione a Textura</h3>
                            <table  id="texturas" class="uk-table uk-table-responsive">
                            <tr>
                                @foreach ($Texturas as $textura)
                                    <td id="selTextura{{$textura->id}}"><img onclick="selectedTextura({{$textura->id}})" src='{{$textura->url}}' style="width: 100px;"></td>
                                @endforeach
                            </tr>
                            </table>
                            <input type="hidden" name="texturaCapa" value="0">
                            </div>
                        <hr>
                        </div> 

                        <div id="papelAlbum" class="uk-hidden"> 
                            <h2>Selecione o papel do Álbum</h2>
                            <div class="uk-margin">
                                <select name="papelAlbum" class="uk-select">
                                      <option disabled selected="">Selecione uma opção</option>
                                      <option value="1">Silk</option>
                                      <option value="2">Fosco</option>
                                      <option value="3">Brilho</option>
                                      <option value="4">Canvas</option>
                                </select>
                            </div>
                            <hr>
                            <div id="lamAlbum" class="uk-hidden">
                            <h2>Selecione a laminação do papel do Álbum</h2>
                            <div class="uk-margin">
                                <select name="lamPapelAlbum" class="uk-select">
                                     
                                </select>
                            </div>
                            <hr>
                            </div>
                            
                        </div> 
                        <div id="lateral" class="uk-hidden"> 
                            <h2>Selecione o acabamento lateral das folhas</h2>
                            <div class="uk-margin">
                                <select name="lateralAlbum" class="uk-select">
                                      <option disabled selected="">Selecione uma opção</option>
                                      <option value="1">Prata</option>
                                      <option value="2">Prata Holográfica</option>
                                      <option value="3">Dourada</option>
                                      <option value="4">Dourada Holográfica</option>
                                      <option value="5">Preta</option>
                                      <option value="6">Natural</option>
                                </select>
                            </div>
                            <hr>
                            
                        </div> 

                        <div id="estojo" class="uk-hidden">
                        <h2>Selecione o estojo</h2>
                            <div class="uk-margin">
                                <select name="estojoAlbum" class="uk-select">
                                      <option disabled selected="">Selecione uma opção</option>
                                      <option value="1">Sem estojo</option>
                                      <option value="2">Estojo</option>
                                      <option value="3">Caixa Sapato</option>
                                </select>
                            </div>
                            <hr>
                        </div>
                        <div id="estojoConf" class="uk-hidden">
                            <div id="estojoPerson" class="uk-hidden">
                            <h2>Personalize o estojo</h2>
                                <div class="uk-margin">
                                    <select name="estojoPerson" class="uk-select">
                                          <option disabled selected="">Selecione uma opção</option>
                                          <option value="1">Imagem</option>
                                          <option value="2">Napa</option>
                                    </select>
                                </div>
                                <hr>
                            </div>
                            <div id="imageEstojo" class="uk-hidden">
                            <h2>Personalize o estojo</h2>
                                 <h3>Envie a imagem para capa</h3>

                                    <div class="custom-file-upload">
                                        <!--<label for="file">File: </label>--> 
                                        <input type="file" id="file" name="imageEstojo" />
                                    </div>
                                    <div class="clearfix"></div>
                                <hr>
                            </div>
                            <div id="napaEstojo" class="uk-hidden">
                            <h3>Selecione a Napa</h3>
                                <table  id="napa" class="uk-table uk-table-responsive">
                                <tr>
                                    @foreach ($Texturas as $textura)
                                        <td id="selNapa{{$textura->id}}"><img onclick="selNapa({{$textura->id}})" src='{{$textura->url}}' style="width: 100px;"></td>
                                    @endforeach
                                </tr>
                                <input type="hidden" name="napaEstojo" value="0">
                                </table>
                                <div class="clearfix"></div>
                            </div>
                            <div id="fechoEstojo" class="uk-hidden">
                            <h2>Fecho do estojo</h2>
                                <div class="uk-margin">
                                    <select name="fechoEstojo" class="uk-select">
                                          <option disabled selected="">Selecione uma opção</option>
                                          <option value="1">Imã</option>
                                          <option value="2">Fecho</option>
                                    </select>
                                </div>
                                <hr>
                            </div>
                            <div id="corfechoEstojo" class="uk-hidden" value="0">
                            <h2>Cor do Fecho</h2>
                                <div class="uk-margin">
                                    <select name="corFechoEstojo" class="uk-select">
                                          <option disabled selected="">Selecione uma opção</option>
                                          <option value="1">Prata</option>
                                          <option value="2">Dourado</option>
                                    </select>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div id="finalizarProjeto" class="uk-hidden">
                        <button type="submit" class="uk-button uk-button-primary uk-button-large">Criar</button>
                        </div>
                    </section>
                        
                    </form>
                </div>
            </div>
@endsection
@section("js")
    <script type="text/javascript">
        //selecionar o modelo e carregar tamanhos
        function selecionaModelo(idModel, nameModel){
            $("input[name=modelo]").val(idModel);
            $(".modelChecked").html(nameModel);
            $("#checkedM").removeClass("uk-hidden");
            $("#modelos td").parent().find("td").removeClass("modelConfirm");
            $("#model"+idModel).addClass("modelConfirm");
            $.ajax({
                    url: "/buscaTamanhos/"+idModel,
                    method: "GET",
                    data:{},
                    success: function(data){
                        var dados = JSON.parse(data);
                        $("select[name=tamanhoAlbum]").removeClass("uk-alert-success");
                        $('select[name=tamanhoAlbum]').empty();
                        $('select[name=tamanhoAlbum]').append($('<option>', {
                                value: "0",
                                text: "Selecione uma opção"
                            }));
                        for (var i = 0, len = dados.length; i < len; i++) {
                            $('select[name=tamanhoAlbum]').append($('<option>', {
                                value: dados[i].id,
                                text: dados[i].tamanho
                            }));
                        }
                    }
            });
            $("#tamanhos").removeClass("uk-hidden");
        }
        //tamanhos album e carregar capa
        $('select[name=tamanhoAlbum]').change(function(){ 
            $("select[name=tamanhoAlbum]").addClass("uk-alert-success");
            var value = $(this).val();
            var idModel = $("input[name=modelo]").val();
            $.ajax({
                    url: "/buscaCapas/"+idModel,
                    method: "GET",
                    data:{},
                    success: function(data){
                        $("#capas").empty();
                        var dados = JSON.parse(data);
                        //$("select[name=tamanhoAlbum]").removeClass("uk-alert-success");
                        //$('select[name=tamanhoAlbum]').empty();
                        //$('select[name=tamanhoAlbum]').append($('<option>', {
                        //       value: "0",
                        //        text: "Selecione uma opção"
                        //    }));
                        for (var i = 0, len = dados.length; i < len; i++) {
                            $('#capas').append("<td onclick='selectedCapa("+dados[i].id+")' id='capaTipo"+dados[i].id+"' class='uk-text-center'><img src="+dados[i].img+" style='width: 250px;'><br><span>"+dados[i].tipo+"</span></td>");
                        }
                    }
            });
            $("#capa").removeClass("uk-hidden");
        });

        function selectedCapa(idModel){
            $("input[name=tipoCapaEscolhida]").val(idModel);
           if(idModel==1){
                $("#fotografico").removeClass("uk-hidden");
                if($("#revestimento").hasClass("uk-hidden")){

                }else{
                    $("#revestimento").addClass("uk-hidden");
                }

                if($("#capaTipo1").hasClass("modelConfirm")){

                }else{
                    $("#capaTipo2").removeClass("modelConfirm");
                    $("#capaTipo1").addClass("modelConfirm");
                }
           }else{
                $("#revestimento").removeClass("uk-hidden");
                if($("#fotografico").hasClass("uk-hidden")){

                }else{
                    $("#fotografico").addClass("uk-hidden");
                }

                if($("#capaTipo2").hasClass("modelConfirm")){

                }else{
                    $("#capaTipo1").removeClass("modelConfirm");
                    $("#capaTipo2").addClass("modelConfirm");
                }
           }
           $("#papelAlbum").removeClass("uk-hidden");
        }
        function selectedTextura(idModel){
            $("#texturas td").parent().find("td").removeClass("modelConfirm");
            $("#selTextura"+idModel).addClass("modelConfirm");
            $("input[name=texturaCapa]").val(idModel);
        }
        function selNapa(idModel){
            $("#napa td").parent().find("td").removeClass("modelConfirm");
            $("#selNapa"+idModel).addClass("modelConfirm");
            $("input[name=napaEstojo]").val(idModel);
        }
        $('select[name=papelCapaFoto]').change(function(){ 
            $("select[name=papelCapaFoto]").addClass("uk-alert-success");
        });
         $('select[name=lamPapelAlbum]').change(function(){ 
            $("select[name=lamPapelAlbum]").addClass("uk-alert-success");
        });
        $('select[name=lateralAlbum]').change(function(){ 
            $("select[name=lateralAlbum]").addClass("uk-alert-success");
            $("#estojo").removeClass("uk-hidden");
        });
        $('select[name=estojoAlbum]').change(function(){ 
            $("select[name=estojoAlbum]").addClass("uk-alert-success");
            if($(this).val()!=1){
                $("#estojoConf").removeClass("uk-hidden");
            }else{
                $("#estojoConf").addClass("uk-hidden");
            }
            $("#estojoPerson").removeClass("uk-hidden");
            $("#fechoEstojo").removeClass("uk-hidden");
            $("#finalizarProjeto").removeClass("uk-hidden");
        });
        $('select[name=fechoEstojo]').change(function(){ 
            $("select[name=fechoEstojo]").addClass("uk-alert-success");
             if($(this).val()!=1){
                $("#corfechoEstojo").removeClass("uk-hidden");
             }else{
                $("#corfechoEstojo").addClass("uk-hidden");
             }
        });
        $('select[name=corFechoEstojo]').change(function(){ 
            $("select[name=corFechoEstojo]").addClass("uk-alert-success");
             
        });
        $('select[name=estojoPerson]').change(function(){ 
            $("select[name=estojoPerson]").addClass("uk-alert-success");
            var persoEstojo = $(this).val();
            if(persoEstojo==1){
                if($("#napaEstojo").hasClass("uk-hidden")){

                }else{
                    $("#napaEstojo").addClass("uk-hidden");
                }
                if($("#imageEstojo").hasClass("uk-hidden")){
                    $("#imageEstojo").removeClass("uk-hidden");
                }else{
                    
                }

            }
            if(persoEstojo==2){
                 if($("#napaEstojo").hasClass("uk-hidden")){
                     $("#napaEstojo").removeClass("uk-hidden");
                }else{
                   
                }
                if($("#imageEstojo").hasClass("uk-hidden")){

                }else{
                    $("#imageEstojo").addClass("uk-hidden");
                }
            }
        });

        $('select[name=papelAlbum]').change(function(){ 
            $("select[name=papelAlbum]").addClass("uk-alert-success");
            $("#lateral").removeClass("uk-hidden");
            var selecionadoPapel = $("select[name=papelAlbum]").val();
            if(selecionadoPapel==1){
                $('select[name=lamPapelAlbum]').empty();
                if($("#lamAlbum").hasClass("uk-hidden")){

                }else{
                    $("#lamAlbum").addClass("uk-hidden");
                }

            }
            if(selecionadoPapel==2){
                $('select[name=lamPapelAlbum]').empty();
                if($("#lamAlbum").hasClass("uk-hidden")){
                    $("#lamAlbum").removeClass("uk-hidden");
                }
                $('select[name=lamPapelAlbum]').append($('<option>', {
                                value: "1",
                                text: "UV Fosco"
                            }));
                $('select[name=lamPapelAlbum]').append($('<option>', {
                                value: "2",
                                text: "UV Brilho"
                }));
            }
            if(selecionadoPapel==3){
                $('select[name=lamPapelAlbum]').empty();
                if($("#lamAlbum").hasClass("uk-hidden")){
                    $("#lamAlbum").removeClass("uk-hidden");
                }
                $('select[name=lamPapelAlbum]').append($('<option>', {
                                value: "1",
                                text: "Filme BRilho"
                            }));
            }
            if(selecionadoPapel==4){
                $('select[name=lamPapelAlbum]').empty();
                if($("#lamAlbum").hasClass("uk-hidden")){

                }else{
                    $("#lamAlbum").addClass("uk-hidden");
                }
            }
        });
    </script>
    <script type="text/javascript">
        //Reference: 
//https://www.onextrapixel.com/2012/12/10/how-to-create-a-custom-file-input-with-jquery-css3-and-php/
;(function($) {

          // Browser supports HTML5 multiple file?
          var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
              isIE = /msie/i.test( navigator.userAgent );

          $.fn.customFile = function() {

            return this.each(function() {

              var $file = $(this).addClass('custom-file-upload-hidden'), // the original file input
                  $wrap = $('<div class="file-upload-wrapper">'),
                  $input = $('<input type="text" class="file-upload-input" />'),
                  // Button that will be used in non-IE browsers
                  $button = $('<button type="button" class="file-upload-button">Enviar Arquivo</button>'),
                  // Hack for IE
                  $label = $('<label class="file-upload-button" for="'+ $file[0].id +'">Enviar Arquivo</label>');

              // Hide by shifting to the left so we
              // can still trigger events
              $file.css({
                position: 'absolute',
                left: '-9999px'
              });

              $wrap.insertAfter( $file )
                .append( $file, $input, ( isIE ? $label : $button ) );

              // Prevent focus
              $file.attr('tabIndex', -1);
              $button.attr('tabIndex', -1);

              $button.click(function () {
                $file.focus().click(); // Open dialog
              });

              $file.change(function() {

                var files = [], fileArr, filename;

                // If multiple is supported then extract
                // all filenames from the file array
                if ( multipleSupport ) {
                  fileArr = $file[0].files;
                  for ( var i = 0, len = fileArr.length; i < len; i++ ) {
                    files.push( fileArr[i].name );
                  }
                  filename = files.join(', ');

                // If not supported then just take the value
                // and remove the path to just show the filename
                } else {
                  filename = $file.val().split('\\').pop();
                }

                $input.val( filename ) // Set the value
                  .attr('title', filename) // Show filename in title tootlip
                  .focus(); // Regain focus

              });

              $input.on({
                blur: function() { $file.trigger('blur'); },
                keydown: function( e ) {
                  if ( e.which === 13 ) { // Enter
                    if ( !isIE ) { $file.trigger('click'); }
                  } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
                    // On some browsers the value is read-only
                    // with this trick we remove the old input and add
                    // a clean clone with all the original events attached
                    $file.replaceWith( $file = $file.clone( true ) );
                    $file.trigger('change');
                    $input.val('');
                  } else if ( e.which === 9 ){ // TAB
                    return;
                  } else { // All other keys
                    return false;
                  }
                }
              });

            });

          };

          // Old browser fallback
          if ( !multipleSupport ) {
            $( document ).on('change', 'input.customfile', function() {

              var $this = $(this),
                  // Create a unique ID so we
                  // can attach the label to the input
                  uniqId = 'customfile_'+ (new Date()).getTime(),
                  $wrap = $this.parent(),

                  // Filter empty input
                  $inputs = $wrap.siblings().find('.file-upload-input')
                    .filter(function(){ return !this.value }),

                  $file = $('<input type="file" id="'+ uniqId +'" name="'+ $this.attr('name') +'"/>');

              // 1ms timeout so it runs after all other events
              // that modify the value have triggered
              setTimeout(function() {
                // Add a new input
                if ( $this.val() ) {
                  // Check for empty fields to prevent
                  // creating new inputs when changing files
                  if ( !$inputs.length ) {
                    $wrap.after( $file );
                    $file.customFile();
                  }
                // Remove and reorganize inputs
                } else {
                  $inputs.parent().remove();
                  // Move the input so it's always last on the list
                  $wrap.appendTo( $wrap.parent() );
                  $wrap.find('input').focus();
                }
              }, 1);

            });
          }

}(jQuery));

$('input[type=file]').customFile();
    </script>
 	

@endsection