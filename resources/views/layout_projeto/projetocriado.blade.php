@extends("layouts.app")

@section("content")
<?php
    $zoomLam1="100% 100%";
    $zoomLam2="100% 100%";
?>
<script type="text/javascript">
    editorPosicao=0;
    zoom=0;
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<style type="text/css">
.guideline{
    position: absolute;
    z-index: 999;
    border-left: 1px solid #333;
    border-right: 1px solid #F2F2F2;
}



    #editorL:hover{
        cursor: move;
    }
    .layoutLamina{
        width: 900px;
        height: 300px;
        margin: 0 auto;
       
    }

    /* zoom */
     .zl10x15{
        width: 1063px;
        margin: 0 auto; 
        
    }
    .zl15x10{
        width: 700px;
        margin: 0 auto; 
       
    }
    .zl15x20{
        width: 1063px;
        margin: 0 auto; 
       
    }
    .zl20x15{
        width: 700px;
        margin: 0 auto; 
      
    }

    .zl20x25{
        width: 1063px;
        margin: 0 auto; 
       
    }

    .zl25x20{
         width: 700px;
        margin: 0 auto; 
        
    }

    .zl20x30{
        width: 700px;
        margin: 0 auto; 
       
    }
    
    .zl30x20{
        width: 700px;
        margin: 0 auto; 
        
    }
    
    .zl25x30{
        width: 709px;
        margin: 0 auto; 
       
    }
    
    .zl30x25{
        width: 1063px;
        margin: 0 auto;
        
    }
    
    .zl30x30{
        width: 900px;
        margin: 0 auto; 
       
    }
    
    .zl30x35{
        width: 1063px;
        margin: 0 auto; 
      
    }

    .zl30x40{
       width: 900px;
        margin: 0 auto; 
     
    }
    
    .zl30x45{
        width: 900px;
        margin: 0 auto; 
      
    }

    .zl35x25{
       width: 700px;
        margin: 0 auto; 
       
    }
        
    .zl35x30{
        width: 700px;
        margin: 0 auto; 
     
    }

    .zl40x30{
       width: 700px;
        margin: 0 auto; 
    
    }
    
    .zl40x40{
        width: 900px;
        margin: 0 auto; 
    
    }

    .zl45x30{
       width: 700px;
        margin: 0 auto; 
    
    }
 /* zoom */

    .l10x15{
        width: calc( ((15*2)/3) * 118px);
        height: calc( ((10)/3) * 118px);
        margin: 0 auto; 
        
    }
    .l15x10{
        width: calc( ((10*2)/3) * 118px);
        height: calc( ((15)/3) * 118px);
        margin: 0 auto; 
       
    }
    .l15x20{
        width: calc( ((20*2)/6) * 118px);
        height: calc( ((15)/6) * 118px);
        margin: 0 auto; 
       
    }
    .l20x15{
        width: calc( ((15*2)/6) * 118px);
        height: calc( ((20)/6) * 118px);
        margin: 0 auto; 
      
    }

    .l20x25{
        width: calc( ((25*2)/6) * 118px);
        height: calc( ((20)/6) * 118px);
        margin: 0 auto; 
       
    }

    .l25x20{
        width: calc( ((20*2)/6) * 118px);
        height: calc( ((25)/6) * 118px);
        margin: 0 auto; 
        
    }

    .l20x30{
       width: calc( ((30*2)/6) * 118px);
        height: calc( ((20)/6) * 118px);
        margin: 0 auto; 
       
    }
    
    .l30x20{
        width: calc( ((20*2)/6) * 118px);
        height: calc( ((30)/6) * 118px);
        margin: 0 auto; 
        
    }
    
    .l25x30{
       width: calc( ((30*2)/6) * 118px);
        height: calc( ((25)/6) * 118px);
        margin: 0 auto; 
       
    }
    
    .l30x25{
        width: calc( ((25*2)/6) * 118px);
        height: calc( ((30)/6) * 118px);
        margin: 0 auto;
        
    }
    
    .l30x30{
        width: calc( ((30*2)/9) * 118px);
        height: calc( ((30)/9) * 118px);
        margin: 0 auto; 
       
    }
    
    .l30x35{
        width: calc( ((35*2)/9) * 118px);
        height: calc( ((30)/9) * 118px);
        margin: 0 auto; 
      
    }

    .l30x40{
      width: calc( ((40*2)/9) * 118px);
        height: calc( ((30)/9) * 118px);
        margin: 0 auto; 
     
    }
    
    .l30x45{
        width: calc( ((45*2)/9) * 118px);
        height: calc( ((30)/9) * 118px);
        margin: 0 auto; 
      
    }

    .l35x25{
      width: calc( ((25*2)/9) * 118px);
        height: calc( ((35)/9) * 118px);
        margin: 0 auto; 
       
    }
        
    .l35x30{
        width: calc( ((30*2)/9) * 118px);
        height: calc( ((35)/9) * 118px);
        margin: 0 auto; 
     
    }

    .l40x30{
      width: calc( ((30*2)/9) * 118px);
        height: calc( ((40)/9) * 118px);
        margin: 0 auto; 
    
    }
    
    .l40x40{
       width: calc( ((40*2)/9) * 118px);
        height: calc( ((40)/9) * 118px);
        margin: 0 auto; 
    
    }

    .l45x30{
       width: calc( ((30*2)/9) * 118px);
        height: calc( ((45)/9) * 118px);
        margin: 0 auto; 
    
    }

    .editor{
        width: 960px;
        margin: 0 auto;
    }
    .layout1{
        width: calc(100% - 2px);
        height: 100%;
        border: 1px solid;
       float: left;
    }
    .layout2{
        width: calc(50% - 2px);
        height: 100%;
        border: 1px solid;
        float: left;
    }
    .zoomlayout1{
        width: calc(20% - 2px);
        
    }
    .zoomlayout2{
        width: calc(20% - 2px);
        
    }
    
    .laminasExistentes{
        
        margin-right: 20px;
        width: 50px;
    }
    
    #uploadAlbum{
        display: none;
    }
    .uploadedImg{
        width: 150px; 
        padding: 0!important;
        margin-left: 15px;
    }
    .imagensProjeto{
        background-color: #ccc;
        padding: 30px;
    }
    #lam1{
        background-repeat: no-repeat;
        
    }
    #lam2{
        background-repeat: no-repeat;
        
    }
    .active{
        border: 3px solid;
        border-color: blue;
    }
    #my-icon-select-box-scroll{
        z-index: 999;
    }
</style>
 <link rel="stylesheet" type="text/css" href="/css/lib/control/iconselect.css" >
        <script type="text/javascript" src="/lib/control/iconselect.js"></script>
        
        <script type="text/javascript" src="/lib/iscroll.js"></script>


    <div class="md-card uk-margin-large-bottom">

        <div class="md-card-content">
            <h3 class="uk-text-center uk-heading-line"><span>Projeto {{ $Album[0]->nomeAlbum }}</span></h3>
            <div class="editor uk-grid-divider uk-form-stacked" uk-grid>
                <div>
                </div>
                 <div>
                </div>
                
                 <div >
                <label class="uk-form-label" for="form-stacked-select">Layout</label>
                    <div id="my-icon-select"></div>
                </div>
                <div>
                <label class="uk-form-label" for="form-stacked-select">Lâminas</label>
                    <select class="laminasExistentes uk-select" onchange="location = this.value;">
                        @foreach ($totalLaminas as $lamina)
                            <option value="/projeto/{{$Album[0]->hash}}/{{$lamina->lamina}}" {{ $lamina->lamina == $Lamina ? "selected" : "" }}>{{$lamina->lamina}}</option>
                        @endforeach
                    </select>
                </div>
                 
               
                <div>
                    <label class="uk-form-label" for="form-stacked-select"></label>
                    <form method="post" action="/novaLamina/{{$Album[0]->id}}/{{$Lamina}}">
                        {{ csrf_field() }}
                        <button type="submit" class="uk-button uk-button-primary uk-button-default newPage">Nova Lâmina</button>
                    </form>
                </div>
                <div>
                <label class="uk-form-label" for="form-stacked-select"></label>
                 <form method="post" action="/finalizarAlbum/{{$Album[0]->id}}">
                        {{ csrf_field() }}
                        <button type="submit" class="uk-button uk-button-default newPage" style="background-color: #47b940; color: #fff;">Finalizar</button>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div id="editorL" class="l{{$tamanhoAlbum->tamanho}}">
         
             @foreach ($layout as $image)
                    @if($image->pos==1)
                <?php if($image->zoomAtual){
                    $zoomt = $image->zoomAtual;
                    }else{
                    $zoomt = "100% 100%";
                    } ?>
                <div id="lam1" onclick="laminaEscolhida(1)" class="lam1 layout{{$layoutAtual->layout}}" style="background-image: url(/{{$image->url}}); background-position: {{$image->bk_position}}; background-size: {{$zoomt}}" >
                </div>
                <?php $zoomLam1 = $image->zoomAtual; ?>
                     @endif
                @endforeach

                
                
                @if(($layoutAtual->layout>1)and($layoutAtual->layout=2))
                     @foreach ($layout as $image)
                            @if($image->pos==2)
                     <div id="lam2" onclick="laminaEscolhida(2)" class="lam2 layout{{$layoutAtual->layout}}" style="background-image: url(/{{$image->url}}); background-position: {{$image->bk_position}}; background-size: {{$image->zoomAtual}};">
                     <?php $zoomLam2 = $image->zoomAtual; ?>
                            @endif
                        @endforeach
                    </div>
                    
                @else
                    <div id="lam2" onclick="laminaEscolhida(2)" class="lam2 uk-hidden" style="background-size: {{$zoomt}}">
                    </div>
                    
                @endif
            </div>
            <div class="zl10x15" style="padding-top:10px">
                @if($layoutAtual->layout==1)
                <div id="zoomLam1" class="zoomlayout{{$layoutAtual->layout}}" style="position: absolute; left: 600px;"></div>
                @endif
                @if($layoutAtual->layout==2)
                <div id="zoomLam1" class="zoomlayout{{$layoutAtual->layout}}" style="position: absolute; left: 300px;"></div>
                <div id="zoomLam2" class="zoomlayout{{$layoutAtual->layout}}" style="position: absolute; right: 300px;"></div>
                @endif
            </div>
            <h6 class="uk-text-center">Lâmina {{$Lamina}}</h6>
            <hr>
            <div class="uploadimagem">
            <form role="uploadimage" id="uploadimage" method="post" enctype="multipart/form-data" id="uploadimage">
            {{ csrf_field() }}
                <input type="file" name="imagensAlbum[]" id="uploadAlbum" multiple>
                <input type="hidden" name="idUsuario" value="{{Auth::user()->id}}">
                <input type="hidden" name="idPedido" value="{{$Album[0]->id}}">
                <button id="buttonUpload" type="button" class="uk-button uk-button-primary uk-button-large">Importar Imagens</button>

            </form>
                <hr>
                <div class="imagensProjeto">
                 <div id="uploadLoading" style="display: none;">
                        Carregando Imagens...
                        <progress id="loading" class="uk-progress" value="0" max="100"></progress>
                    </div>
                    <div id="carregadas" class="uk-grid-small" uk-grid>
                   
                        @foreach ($imagensProjeto as $img)
                            <div>
                                <img id="imgAlb{{$img->id}}" onclick="imgSelecionada({{$img->id}})" src="/{{$img->url}}" class="uk-card uk-card-default uk-card-body uploadedImg">
                            </div>
                        @endforeach
                    </div>
                    
                </div>

            </div>
        </div>
        <br/>

@endsection
@section("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="/lib/draggable_background.js"></script>
<script>
    $(function() {
      $('#lam1').backgroundDraggable({
        disabled: true,
        bound: false,
        done: function() {
            bk_position = $('#lam1').css('background-position');
            var lamAtual={!! json_encode($laminaAtual->id) !!};
            var idPedido = {!! json_encode($Album[0]->id) !!};
            var pos=1;
            $.ajax({
                method: "POST",
                url: "/atualizaBackgroundPosition",
                data: {id_pedido: idPedido, lamAtual: lamAtual, pos: pos, bk_position: bk_position}
            }).done(function( msg ) {
                            
            });
        }
      });
      $('#lam2').backgroundDraggable({
        disabled: true,
        bound: false,
        done: function() {
            bk_position = $('#lam2').css('background-position');
            var lamAtual={!! json_encode($laminaAtual->id) !!};
            var idPedido = {!! json_encode($Album[0]->id) !!};
            var pos=2;
            $.ajax({
                method: "POST",
                url: "/atualizaBackgroundPosition",
                data: {id_pedido: idPedido, lamAtual: lamAtual, pos: pos, bk_position: bk_position}
            }).done(function( msg ) {
                            
            });
        }
      });
      
    });
  </script>
  <script>
            
        var iconSelect;
        var selected=({!! json_encode($layoutAtual->layout) !!}-1);
        window.onload = function(){

            iconSelect = new IconSelect("my-icon-select", 
                {'selectedIconWidth':48,
                'selectedIconHeight':48,
                'selectedBoxPadding':1,
                'iconsWidth':48,
                'iconsHeight':48,
                'boxIconSpace':1,
                'vectoralIconNumber':4,
                'horizontalIconNumber':4});

            var icons = [];
             icons.push({'iconFilePath':'/images/icon1.png', 'iconValue':'1'});
            icons.push({'iconFilePath':'/images/icon2.png', 'iconValue':'2'});

            iconSelect.refresh(icons, selected);

        };
            
        $(document).ready(function () {
         //jQuery("#editorL .lam1 img").draggable().parent("img").resizable();
            
           // $("#editorL .lam1 img").resizable({ containment: ".lam1" });
           // $("#editorL .lam1 img").draggable({ containment: ".lam1" });
            //$("#editorL .lam2 img").draggable({ containment: ".lam2" }).resizable({
            //    containment: ".lam2"
           // });

        var zoomLam1={!! json_encode($zoomLam1) !!};
        var zoomLam2={!! json_encode($zoomLam2) !!};
        if(zoomLam1){
             var zoomLam1=zoomLam1.replace("%","").replace("%","").split(" ");
        }else{
           zoomLam1 = new Array();
           zoomLam1[0]=100;
        }
        if(zoomLam2){
             var zoomLam2=zoomLam2.replace("%","").replace("%","").split(" ");
        }else{
           zoomLam2 = new Array();
           zoomLam2[0]=100;
        }


            $( "#zoomLam1" ).slider({range: "min",
      min: 100,
      max: 500,
      value: zoomLam1[0],
      slide: function( event, ui ) {
       // console.log(ui.value);
        var zoom=new Array();
        zoom[0]=ui.value;
        zoom[1]=ui.value;
        zoom[0]=zoom[0].toString();
        zoom[1]=zoom[1].toString();
        zoom[0]+="%";
        zoom[1]+="%";
        $('#lam1').css('background-size', zoom.join(" "));
      },
       change: function( event, ui ) {
            var zoomAtual = $('#lam1').css('background-size');
            var lamAtual={!! json_encode($laminaAtual->id) !!};
            var idPedido = {!! json_encode($Album[0]->id) !!};
            var pos=1;
            $.ajax({
                method: "POST",
                url: "/atualizaZoom",
                data: {id_pedido: idPedido, lamAtual: lamAtual, pos: pos, zoomAtual: zoomAtual}
           }).done(function( msg ) {                    
          });
       }
  });


            
            $( "#zoomLam2" ).slider({range: "min",
      min: 100,
      max: 500,
      value: zoomLam2[0],
      slide: function( event, ui ) {
        var zoom=new Array();
        zoom[0]=ui.value;
        zoom[1]=ui.value;
        zoom[0]=zoom[0].toString();
        zoom[1]=zoom[1].toString();
        zoom[0]+="%";
        zoom[1]+="%";
        $('#lam2').css('background-size', zoom.join(" "));
      },
       change: function( event, ui ) {
            var zoomAtual = $('#lam2').css('background-size');
            var lamAtual={!! json_encode($laminaAtual->id) !!};
            var idPedido = {!! json_encode($Album[0]->id) !!};
            var pos=2;
            $.ajax({
                method: "POST",
                url: "/atualizaZoom",
                data: {id_pedido: idPedido, lamAtual: lamAtual, pos: pos, zoomAtual: zoomAtual}
           }).done(function( msg ) {                    
          });
       }
  });
            $(document).on('click', '.block-add', function () {
                var a = $(this);
                var src = a.find('img:first').attr('src');
                var elem = $('<div class="container"><img src="' + src + '" class="blocks" /></div>');
                $('.block').append(elem);
                elem.draggable();
                elem.find('.blocks:first').resizable();
                return false;
            });
        });


        </script>


    <script type="text/javascript">
    var layoutAtual={!! json_encode($layoutAtual->layout) !!};
    document.getElementById('buttonUpload').onclick = function() {
        document.getElementById('uploadAlbum').click();
    };
    $('#uploadAlbum').change(function() {
        $('#uploadimage').submit();
    });
    function habilitarPosition(){
       // if(editorPosicao==0){
       //     $('#lam1').backgroundDraggable('init');
       //     $('#lam2').backgroundDraggable('init');
       //     editorPosicao=1;
       // }else if(editorPosicao==1){
       //     $('#lam1').backgroundDraggable('disable');
       //     $('#lam2').backgroundDraggable('disable');
       //     editorPosicao=0;
       // }
            
    }

    function habilitarZoom(){

        var zoom=$('#lam1').css('background-size');
        var zoomIn=zoom.replace("%","").replace("%","").split(" ");
        zoomIn[0]=parseInt(zoomIn[0]);
        zoomIn[1]=parseInt(zoomIn[1]);
        zoomIn[0]+=100;
        zoomIn[1]+=100;
        zoomIn[0]=zoomIn[0].toString();
        zoomIn[1]=zoomIn[1].toString();
        zoomIn[0]+="%";
        zoomIn[1]+="%";
        $('#lam1').css('background-size', zoomIn.join(" "));
    }
    function atualizaValor(value){
        layoutAtual=value;
        var idPedido = {!! json_encode($Album[0]->id) !!};
        var lamAtual={!! json_encode($laminaAtual->id) !!};
        var layout=value;
        $("#editorL div").removeClass("");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
            }
        });

        $.ajax({
            method: "POST",
            url: "/atualizaLayout",
            data: {id_pedido: idPedido, lamAtual: lamAtual, layout: layout}});

        if(layout==1){
            $("#lam1").removeClass("layout2");
            $("#lam2").removeClass("layout2");
            $("#lam1").addClass("layout1");
            $("#lam2").addClass("uk-hidden");
            $("#zoomLam2").addClass("uk-hidden");
            
        }

        if(layout==2){
            $("#lam2").removeClass("layout1");
            $("#lam1").removeClass("layout1");
            $("#lam2").addClass("layout2");
            $("#lam1").addClass("layout2");
            $("#lam2").removeClass("uk-hidden");
            $("#zoomLam2").removeClass("uk-hidden");
            $("#zoomLam1").removeClass("uk-hidden");
            
        }

    }

    function laminaEscolhida(id){
        var imgEscolhida = $( "img.active" ).find("img");
        if(imgEscolhida.prevObject.length>0){
            var idAlb=imgEscolhida.prevObject[0].attributes[0].nodeValue;
            var trata=$('#'+idAlb).attr("onclick");
            var idFotoAlbum=trata.replace("imgSelecionada", "").replace("(", "").replace(")", "");
            var mini=imgEscolhida.prevObject[0].currentSrc;
            var lamAtual={!! json_encode($laminaAtual->id) !!};
            var idPedido = {!! json_encode($Album[0]->id) !!};
            $(".lam"+id).css("background-image", "url("+mini+")");
            $("#carregadas div").parent().find("img").removeClass("active");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        }
    });

                         $.ajax({
                          method: "POST",
                          url: "/atualizaLamina",
                          data: {id_pedido: idPedido, laminaLayout: id, lamAtual: lamAtual, idFoto: idFotoAlbum}
                         }).done(function( msg ) {
                            
                         });
        }else{
            //document.getElementById("lam1").style.backgroundSize = "50%";
            //var total=document.getElementById("lam1").style.backgroundSize;
            //console.log(total);
        }

    }
    function imgSelecionada(id){
        $("#carregadas div").parent().find("img").removeClass("active");
        $("#imgAlb"+id).addClass("active");
    }

    </script>
    <script type="text/javascript">
            $(document).ready(function (e) {
                    $("#uploadimage").on('submit',(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "/uploadImagem", // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false,        // To send DOMDocument or non processed data file it is set to false
                        success: function(data)   // A function to be called if request succeeds
                        {
                            var dados = JSON.parse(data);
                            for (var i = 0, len = dados.length; i < len; i++) {
                               
                               $("#carregadas").append("<div><img id='imgAlb"+dados[i].id+"' onclick='imgSelecionada("+dados[i].id+")' src='/"+dados[i].url+"' class='uk-card uk-card-default uk-card-body uploadedImg'></div>");
                            }
                           // 
                        },
                        
                        xhr: function(){
        // get the native XmlHttpRequest object
        var xhr = $.ajaxSettings.xhr() ;
        // set the onprogress event handler
        xhr.upload.onprogress = function(evt){ 
            
        //$(".out"+laminan).hide();
        $("#uploadLoading").fadeIn();
        var bar = document.getElementById('loading');

         

        var animate = setInterval(function () {

            bar.value += evt.loaded/evt.total*100;

            if (bar.value >= bar.max) {
                clearInterval(animate);
            }

        }, 1000);

    

       
     } ;
        // set the onload event handler
        xhr.upload.onload = function(){ 
            
            $("#uploadLoading").fadeOut();
             var bar = document.getElementById('loading');
              var animate = setInterval(function () {

            bar.value -= 100;

            if (bar.value >= 0) {
                clearInterval(animate);
            }

        }, 1000);
         } ;
        // return the customized object
        return xhr ;
    }
                        
                    });
                }));
                });
                function readURL(input) {

                if (input.files && input.files[0]) {
                   // var reader = new FileReader();

                 reader.onload = function (e) {
                  ///      $('#blah').attr('src', e.target.result);
                 //       $('#cp').attr('src', e.target.result);
                 //       $('#outer-box1').fadeIn();
                 //       $('#outer-box').fadeIn();
                 ///       $("#complete").fadeOut();
                 //       $('#sbimg').fadeIn();
                    }
               //     reader.readAsDataURL(input.files[0]);
                }
            }

           // $("#imgInp").change(function(){
            //    readURL(this);
           // });
            </script>
 	<script>
   
    </script>




@endsection