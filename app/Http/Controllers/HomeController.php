<?php

namespace laboratorio\Http\Controllers;
use Illuminate\Support\Facades\Input;
use laboratorio\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Storage;
use Intervention\Image\Facades\Image as Image;
//carrega classes do album pedido
use laboratorio\AlbumPedido;

//trata capa album
use laboratorio\CapaImagemPedido;
use laboratorio\CapaNapaPedido;

//trata estojo album
use laboratorio\EstojoImagemPedido;
use laboratorio\EstojoNapaPedido;

//imagens album upload
use laboratorio\AlbumImagens;

//laminas / layout
use laboratorio\AlbumLamina;
use laboratorio\album_lamina_imagem;
use laboratorio\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //admin
        if(Auth::user()->role == 1){
            return view('home');
        }
        //user normal
            return view('home');
    }

    public function adminLogar()
    {   
        //admin
        if(Auth::user()->role == 1){
            return view("admin.layout.homeAdmin");
        }
        //user normal
            return redirect("/login");
    }

    //funcoes admin

    public function pedidos()
    {   
        //admin
        if(Auth::user()->role == 1){
             $pedidosCliente=AlbumPedido::where("status", 1)->orderBy("id", "desc")->get();
            $pedidos = DB::table('album_pedido')
                ->leftJoin('users', 'users.id', '=', 'album_pedido.id_usuario')
                ->where("album_pedido.status", "=", 1)->orderBy("album_pedido.id", "desc")->get();
            return view("admin.layout.pedidosAdmin", ["Projetos"=>$pedidos]);
        }

    }

    public function downloadPedido($hash){
        if(Auth::user()->role == 1){
            if(file_exists(public_path($hash.'.zip'))){
                return response()->download(public_path($hash.'.zip'));
            }else{
                return view("errors.503");
            }
        }
    }

    public function novoCliente(){
        if(Auth::user()->role == 1){
            return view("auth.register");
        }
    }

    public function clientes()
    {   
        //admin
        if(Auth::user()->role == 1){
            $clientes=User::all();
            return view("admin.layout.clientesAdmin", ["Clientes"=>$clientes]);
        }

    }

    public function registrar(){
        if(Auth::user()->role == 1){
            $nome=Input::get("name");
            $email=Input::get("email");
            $telefone=Input::get("telefone");
            $celular=Input::get("celular");
            $senha=Input::get("password");
            $tipo=Input::get("tipo");
            User::create(["name"=>$nome, "email"=>$email, "telefone"=>$telefone, "celular"=>$celular, "password"=>bcrypt($senha), "role"=>$tipo]);

            return view("auth.register");


        }
    }


    public function ordem($hash){
        if(Auth::user()->role == 1){
            if($hash){
            $album=AlbumPedido::where("hash", $hash)->first();
            if(!empty($album)){
                $modelo=DB::table('modelos_album')->where("id", "=" ,$album->id_modelo)->first();
                $tamanho=DB::table('album_tamanho')->where("id", "=" ,$album->id_tamanho)->first();
                $cliente=DB::table("users")->where("id", "=", $album->id_usuario)->first();
                $totalLaminas=AlbumLamina::where("id_pedido", $album->id)->max("lamina");
                return view("admin.layout.ordemAdmin", ["Album"=>$album, "Modelo"=>$modelo, "Tamanho"=>$tamanho, "Laminas"=>$totalLaminas, "Cliente"=>$cliente]);
            }else{
                return view("errors.503");
            }
        }else{
            return view("errors.503");
        }
        }
    }



    //funcoes usuario

    public function criarLamina(){
       
    }

    public function deletarProjeto(){
        $albumDeletar=Input::get("deletarAlbum");
        EstojoNapaPedido::where("id_pedido", "=", $albumDeletar)->delete();
        CapaNapaPedido::where("id_pedido", "=", $albumDeletar)->delete();

        EstojoImagemPedido::where("id_pedido", "=", $albumDeletar)->delete();
        CapaImagemPedido::where("id_pedido", "=", $albumDeletar)->delete();

        AlbumLamina::where("id_pedido", "=", $albumDeletar)->delete();
        album_lamina_imagem::where("id_pedido", "=", $albumDeletar)->delete();
        AlbumImagens::where("id_pedido", "=", $albumDeletar)->delete();

        AlbumPedido::find($albumDeletar)->delete();

        $directory="/assets/clientes/".Auth::user()->id."/".$albumDeletar;
        $success = Storage::deleteDirectory($directory);

        return redirect("/projetos");
    }


    public function novoprojeto(){
        $modelos = DB::table('modelos_album')->get(); 
        $texturas = DB::table('texturas_album')->get(); 
        return view('layout_projeto.criarprojeto', ["Modelos"=>$modelos, "Texturas" =>$texturas]);
    }  

    public function novaLamina($id_pedido, $laminaAtual){
        AlbumLamina::firstOrCreate(["id_pedido"=> $id_pedido, "lamina"=> $laminaAtual+1, "layout"=>1]);
        $hash=AlbumPedido::where("id", $id_pedido)->get();
        $hash=$hash[0]->hash;
        return redirect("/projeto/".$hash."/".($laminaAtual+1)); 
    }

    public function projetoContinuar($hash, $lam=1){
        $editAlbum=AlbumPedido::where("hash", $hash)->get();
        $totalLaminas=AlbumLamina::where("id_pedido", $editAlbum[0]->id)->get();
        $imagensProjeto=AlbumImagens::where("id_pedido", $editAlbum[0]->id)->get();
        $tamanhoAlbum = DB::table('album_tamanho')->where("id", "=" ,$editAlbum[0]->id_tamanho)->first();

        //checa se album existe e pertence a este usuario, se n pagina de erro
        if((count($editAlbum)==1)&&($editAlbum[0]->id_usuario==Auth::user()->id)){
            $laminaGet=AlbumLamina::where([["id_pedido", "=",$editAlbum[0]->id], ["lamina", "=",$lam]])->get();
            if(count($laminaGet)==0){
                    $layoutLamina=array();
            }else{
               $layoutLamina = DB::table('album_lamina_imagem')
                ->leftJoin('album_imagens', 'album_imagens.id', '=', 'album_lamina_imagem.id_imagem')
                ->where([["album_lamina_imagem.id_pedido", $editAlbum[0]->id],["album_lamina_imagem.id_lamina", "=",$laminaGet[0]->id]])->get();
            }

            //se lam =1 checa se ja existe e cria
            if($lam==1){
                $lamBusca=AlbumLamina::where("id_pedido", $editAlbum[0]->id)->where("lamina", 1)->first();
                if(count($lamBusca)==0){
                    $lamCriada=AlbumLamina::firstOrCreate(["id_pedido"=> $editAlbum[0]->id, "lamina"=> 1, "layout"=>1]);
                    album_lamina_imagem::firstOrCreate(["id_pedido"=> $editAlbum[0]->id, "id_lamina"=> $lamCriada->id, "id_imagem"=> 0, "pos"=>1]);
                        album_lamina_imagem::firstOrCreate(["id_pedido"=> $editAlbum[0]->id, "id_lamina"=> $lamCriada->id, "id_imagem"=> 0, "pos"=>2]);
                }else{
                    $lamCriada=$lamBusca;
                }
                $layoutAtual=AlbumLamina::where([["id_pedido", "=", $editAlbum[0]->id], ["lamina", "=", $lam]])->first(["layout"]);
                    
                    if(count($layoutLamina)==0){
                        album_lamina_imagem::firstOrCreate(["id_pedido"=> $editAlbum[0]->id, "id_lamina"=> $lamBusca->id, "id_imagem"=> 0, "pos"=>1]);
                        album_lamina_imagem::firstOrCreate(["id_pedido"=> $editAlbum[0]->id, "id_lamina"=> $lamBusca->id, "id_imagem"=> 0, "pos"=>2]);
                        return redirect("/projeto/".$hash."/".$lam);
                    }
                return view("layout_projeto.projetocriado", ["Album"=>$editAlbum, "Lamina"=>1, "totalLaminas"=>$totalLaminas,"imagensProjeto"=>$imagensProjeto, "laminaAtual"=>$lamCriada, "layout"=>$layoutLamina, "tamanhoAlbum"=>$tamanhoAlbum, "layoutAtual"=>$layoutAtual]);
            }else{
                //procura se a lamina existe
                $lamina = DB::table('album_pedido_laminas')->where([['id_pedido', '=', $editAlbum[0]->id], ['lamina', '=', $lam]])->first();
                //se lamina n existe retorna a ultima existente
                if(count($lamina)==0){
                    $ultima=DB::table("album_pedido_laminas")->where('id_pedido', $editAlbum[0]->id)->orderBy('lamina', 'desc')->take(1)->get();
                    //n encontrou nenhuma lamina cria a primeira
                    if(count($ultima)==0){
                        AlbumLamina::firstOrCreate(["id_pedido"=> $editAlbum[0]->id, "lamina"=> 1, "layout"=>1]);
                        return redirect("/projeto/".$hash."/1");
                    }else{
                        //encontrou lamina retorna lamina
                        return redirect("/projeto/".$hash."/".$ultima[0]->lamina);
                    }
                    
                }else{
                    //encontrou lamina 
                    $layoutAtual=AlbumLamina::where([["id_pedido", "=", $editAlbum[0]->id], ["lamina", "=", $lam]])->first(["layout"]);
                    
                    if(count($layoutLamina)==0){
                        album_lamina_imagem::firstOrCreate(["id_pedido"=> $editAlbum[0]->id, "id_lamina"=> $lamina->id, "id_imagem"=> 0, "pos"=>1]);
                        album_lamina_imagem::firstOrCreate(["id_pedido"=> $editAlbum[0]->id, "id_lamina"=> $lamina->id, "id_imagem"=> 0, "pos"=>2]);
                        return redirect("/projeto/".$hash."/".$lam);
                    }else{
                        return view("layout_projeto.projetocriado", ["Album"=>$editAlbum, "Lamina"=>$lam, "totalLaminas"=>$totalLaminas, "imagensProjeto"=>$imagensProjeto, "laminaAtual"=>$lamina, "layout"=>$layoutLamina, "tamanhoAlbum"=>$tamanhoAlbum, "layoutAtual"=>$layoutAtual]);
                    }
                    
                }
            }

            
        }else{
            return view("errors.503");
        }
        
    }

    public function atualizaLamina(){
        $laminaAtual=album_lamina_imagem::where([["id_lamina", "=", Input::get("lamAtual")],["pos", "=", Input::get("laminaLayout")]])->get();
        if(count($laminaAtual)==0){
            album_lamina_imagem::firstOrCreate(["id_pedido"=> Input::get("id_pedido"), "id_lamina"=> Input::get("lamAtual"), "id_imagem"=> Input::get("idFoto"), "pos"=>Input::get("laminaLayout"), "bk_position"=>"0px 0px", "zoomAtual"=>"100% 100%"]);
        }else{
            album_lamina_imagem::where([["id_lamina", "=", Input::get("lamAtual")],["pos", "=", Input::get("laminaLayout")]])->update(["id_pedido"=> Input::get("id_pedido"), "id_imagem"=>Input::get("idFoto"), "pos"=>Input::get("laminaLayout"), "bk_position"=>"0px 0px", "zoomAtual"=>"100% 100%"]);
        }
    }

    public function finalizarAlbum($id){
        $album=AlbumPedido::where([["id_usuario", "=",Auth::user()->id], ["id", "=", $id]])->get();
        if(!count($album)==0){
            $papelAlbum=array("Vazio","Silk", "Fosco", "Brilho", "Canvas");
            $laminacaoPapel=array();
            switch ($album[0]->id_papelAlbum) {
                case '2':
                    $laminacaoPapel=array("Vazio", "UV Fosco", "UV Brilho");
                break;
                case '3':
                    $laminacaoPapel=array("Vazio", "Filme Brilho");
                break;
            }
            $lateral=array("Vazio", "Prata", "Prata Holográfica", "Dourada", "Dourada Holográfica", "Preta", "Natural");
            $lateral=$lateral[$album[0]->id_lateral];
            $papelAlbum=$papelAlbum[$album[0]->id_papelAlbum];
            $laminacaoPapel=$laminacaoPapel[$album[0]->id_laminacaoPapel];
            $hash=$album[0]->hash;
            $pixel=118;
            $tamanhoAlbum = DB::table('album_tamanho')->where("id", "=" ,$album[0]->id_tamanho)->get();
            $prop=$tamanhoAlbum[0]->prop;
            $tamanho=$tamanhoAlbum[0]->tamanho;
            $tamanhoAlbum=explode("x", $tamanhoAlbum[0]->tamanho);
            $width=($tamanhoAlbum[1]*2)*$pixel;
            $height=($tamanhoAlbum[0])*$pixel;

            $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/";

            $totalLaminas=AlbumLamina::where("id_pedido", $id)->max("lamina");
            if (!file_exists($pastaPedido)) {
                mkdir($pastaPedido);
                chmod($pastaPedido, 0755);
            }

            $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash;            
            if (!file_exists($pastaPedido)) {
                mkdir($pastaPedido);
                chmod($pastaPedido, 0755);
            }

            $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/Papel ".$papelAlbum;
            
            if (!file_exists($pastaPedido)) {
                mkdir($pastaPedido);
                chmod($pastaPedido, 0755);
            }

            

            if($album[0]->id_papelAlbum==2 || $album[0]->id_papelAlbum==3){

                $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/Papel ".$papelAlbum."/Laminacao ".$laminacaoPapel;
                if (!file_exists($pastaPedido)) {
                    mkdir($pastaPedido);
                    chmod($pastaPedido, 0755);
                }


                $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/Papel ".$papelAlbum."/Laminacao ".$laminacaoPapel."/Borda ".$lateral;
                if (!file_exists($pastaPedido)) {
                    mkdir($pastaPedido);
                    chmod($pastaPedido, 0755);
                }

                $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/Papel ".$papelAlbum."/Laminacao ".$laminacaoPapel."/Borda ".$lateral."/".$tamanho;
                if (!file_exists($pastaPedido)) {
                    mkdir($pastaPedido);
                    chmod($pastaPedido, 0755);
                }

                $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/Papel ".$papelAlbum."/Laminacao ".$laminacaoPapel."/Borda ".$lateral."/".$tamanho."/laminas";
                if (!file_exists($pastaPedido)) {
                    mkdir($pastaPedido);
                    chmod($pastaPedido, 0755);
                }
            }else{
                $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/Papel ".$papelAlbum."/".$tamanho;
                if (!file_exists($pastaPedido)) {
                    mkdir($pastaPedido);
                    chmod($pastaPedido, 0755);
                }

                $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/Papel ".$papelAlbum."/Borda ".$lateral."/".$tamanho;
                if (!file_exists($pastaPedido)) {
                    mkdir($pastaPedido);
                    chmod($pastaPedido, 0755);
                }

                $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/Papel ".$papelAlbum."/Borda ".$lateral."/".$tamanho."/laminas";
                if (!file_exists($pastaPedido)) {
                    mkdir($pastaPedido);
                    chmod($pastaPedido, 0755);
                }
            }
            


            $i=$totalLaminas;
            while ($i>0) {
                $img = imagecreatetruecolor($width, $height);
                $corBackground = imagecolorallocate($img, 255, 255, 255);
                imagefill($img, 0, 0, $corBackground);
                imagejpeg($img, $pastaPedido."/".$i.".jpg");
                imagedestroy($img);
                $totalLaminas=AlbumLamina::where([["id_pedido", $id], ["lamina", $i]])->get();

                switch ($totalLaminas[0]->layout) {
                    case "1":
                       $album=album_lamina_imagem::where([["id_lamina", "=", $totalLaminas[0]->id], ["id_pedido", "=", $id], ["pos", "=", "1"]])->get();
                       if($album[0]->id_imagem==0){
                            continue;
                       }else{
                           $imagem=AlbumImagens::where([["id_pedido", "=", $id], ["id", "=", $album[0]->id_imagem]])->get();
                           $zoom = $album[0]->zoomAtual;
                           $zoom = explode("%", $zoom);
                           $x = $album[0]->bk_position;
                           $x = explode(" ", $x);
                           $y = $x[1];
                           $x = $x[0];
                           $zoom = ($zoom[0]/100);
                           $img=Image::make($pastaPedido."/".$i.".jpg");
                           $img1=Image::make($imagem[0]->url);
                           $img1->resize($width*$zoom, $height*$zoom)->crop($width, $height, intval((abs(intval($x))*$prop)), intval((abs(intval($y))*$prop)));
                           $img->fill($img1);
                           $img->save($pastaPedido."/".$i.".jpg");
                       }
                    break;

                    case "2":
                        $album=album_lamina_imagem::where([["id_lamina", "=", $totalLaminas[0]->id], ["id_pedido", "=", $id]])->get();
                        $imagem1=AlbumImagens::where([["id_pedido", "=", $id], ["id", "=", $album[0]->id_imagem]])->get();
                        $imagem2=AlbumImagens::where([["id_pedido", "=", $id], ["id", "=", $album[1]->id_imagem]])->get();
                        //Imagem Esquerda
                        if($album[0]->id_imagem==0){
                        }else{
                           $zoom = $album[0]->zoomAtual;
                           $zoom = explode("%", $zoom);
                           $x = $album[0]->bk_position;
                           $x = explode(" ", $x);
                           $y = $x[1];
                           $x = $x[0];
                           $zoom = ($zoom[0]/100);
                           $img=Image::make($pastaPedido."/".$i.".jpg");
                           $img1=Image::make($imagem1[0]->url);
                           $img1->resize((($width)*$zoom)/2, ($height)*$zoom)->crop($width/2, $height, intval((abs(intval($x))*$prop)), intval((abs(intval($y))*$prop)));
                           $img->insert($img1, "left");
                           $img->save($pastaPedido."/".$i.".jpg");
                        }
                        if($album[1]->id_imagem==0){
                        }else{
                           //Imagem Direita
                           $zoom = $album[1]->zoomAtual;
                           $zoom = explode("%", $zoom);
                           $x = $album[1]->bk_position;
                           $x = explode(" ", $x);
                           $y = $x[1];
                           $x = $x[0];
                           $zoom = ($zoom[0]/100);
                           $img=Image::make($pastaPedido."/".$i.".jpg");
                           $img1=Image::make($imagem2[0]->url);
                           $img1->resize((($width)*$zoom)/2, ($height)*$zoom)->crop($width/2, $height, intval((abs(intval($x))*$prop)), intval((abs(intval($y))*$prop)));
                           $img->insert($img1, "right");
                           $img->save($pastaPedido."/".$i.".jpg");
                        }
                    break;
                    
                    default:
                    break;
                }

                $i--;
            }
            $pastaPedido="assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/capaAlbum";
            if (!file_exists($pastaPedido)) {
                    mkdir($pastaPedido);
                    chmod($pastaPedido, 0755);
            }
            if (!copy("assets/clientes/".Auth::user()->id."/".$id."/capaAlbum/capa.jpg", "assets/clientes/".Auth::user()->id."/".$id."/laminas/".$hash."/capaAlbum/capa.jpg")) {
               
            }
            
            $files = glob(public_path('assets/clientes/'.Auth::user()->id.'/'.$id.'/laminas/*'));
            \Zipper::make(public_path($hash.'.zip'))->add($files)->close();
            return redirect("/revisarPedido/".$hash);
            //return $totalLaminas;
        }else{
             return view("errors.503");
        }
    }

    public function revisarPedido($hash=0){
        if($hash){
            $album=AlbumPedido::where([["id_usuario", "=",Auth::user()->id], ["hash", "=", $hash]])->first();
            if(!empty($album)){
                $modelo=DB::table('modelos_album')->where("id", "=" ,$album->id_modelo)->first();
                $tamanho=DB::table('album_tamanho')->where("id", "=" ,$album->id_tamanho)->first();
                $totalLaminas=AlbumLamina::where("id_pedido", $album->id)->max("lamina");
                return view("layout_projeto.revisarPedido", ["Album"=>$album, "Modelo"=>$modelo, "Tamanho"=>$tamanho, "Laminas"=>$totalLaminas]);
            }else{
                return view("errors.503");
            }
        }else{
            return view("errors.503");
        }
    }
    public function atualizaBackgroundPosition(){
            album_lamina_imagem::where([["id_pedido", "=", input::get("id_pedido")],["id_lamina", "=", Input::get("lamAtual")],["pos", "=", Input::get("pos")]])->update(["bk_position"=>Input::get("bk_position")]);
    }
    public function atualizaZoom(){
            album_lamina_imagem::where([["id_pedido", "=", input::get("id_pedido")],["id_lamina", "=", Input::get("lamAtual")],["pos", "=", Input::get("pos")]])->update(["zoomAtual"=>Input::get("zoomAtual")]);
    }
    public function atualizaValor(){
            AlbumLamina::where('id_pedido', Input::get("id_pedido"))
          ->where('id', Input::get("lamAtual"))
          ->update(["layout"=>Input::get("layout")]);
    }

    public function uplodImagem(){
        //checa se cliente tem pasta e pedido tem pasta
        $upados=array();
        $pastaCliente="assets/clientes/".Input::get("idUsuario");
        if (!file_exists($pastaCliente)) {
            mkdir($pastaCliente);
            chmod($pastaCliente, 0755);
        }

        $pastaPedido="assets/clientes/".Input::get("idUsuario")."/".Input::get("idPedido");
        if (!file_exists($pastaPedido)) {
            mkdir($pastaPedido);
            chmod($pastaPedido, 0755);
        }

        $pastaUpload="assets/clientes/".Input::get("idUsuario")."/".Input::get("idPedido")."/imagens/";
        if (!file_exists($pastaUpload)) {
            mkdir($pastaUpload);
            chmod($pastaUpload, 0755);
        }
        $arquivos=Input::file('imagensAlbum');
        foreach ($arquivos as $key) {
            $extension = $key->getClientOriginalExtension();
            if(($extension == "jpg"||$extension == "JPG")||($extension == "png"||$extension == "PNG")){
                $extension=strtolower($extension);
                $key->move($pastaUpload, $key->getClientOriginalName());
                $sucess=AlbumImagens::create(array('id_pedido'=>Input::get("idPedido"), 'url'=>$pastaUpload.$key->getClientOriginalName()));
                $upados[]=array("id"=>$sucess->id,"url"=>$pastaUpload.$key->getClientOriginalName());
            }
        }
        return json_encode($upados);
    }


    public function buscaTamanhos($id){
        $id=intval($id);
        $tamanhoAlbum = DB::table('album_tamanho')->where("id_album", "=" ,$id)->get();
        return json_encode($tamanhoAlbum);
    }  

    public function buscaCapas($id){
        $id=intval($id);
        $capasAlbum = DB::table('tipos_capas_album')->where("id_album", "=" ,$id)->get();
        return json_encode($capasAlbum);
    }  

    public function projetos(){
        $pedidosCliente=AlbumPedido::where("id_usuario", Auth::user()->id)->get();
        return view("layout_projeto.projetos", ["Projetos"=>$pedidosCliente]);
    }

    public function criaProjeto(){
        //tratar atriubutos 
        $lamPapel=Input::get("lamPapelAlbum");
        if(Input::get("papelAlbum")==1){
            $lamPapel=0;
        }
        if(Input::get("papelAlbum")==4){
            $lamPapel=0;
        }

        $corFecho=Input::get("corFechoEstojo");
        if(Input::get("fechoEstojo")==1){
            $corFecho=0;
        }
        $fechoEstojo=Input::get("fechoEstojo");
        $persoEstojo=Input::get("estojoPerson");
        if(Input::get("estojoAlbum")==1){
            $fechoEstojo=0;
            $corFecho=0;
            $persoEstojo=0;
        }
        
        $hash = substr(md5(mt_rand()), 0, 5);

        //cria pedido no banco
        $idPedido=AlbumPedido::create(array('id_modelo'=>Input::get("modelo"), 'id_tamanho'=>Input::get("tamanhoAlbum"), 'tipoCapa'=>Input::get("tipoCapaEscolhida"), 'id_papelAlbum'=>Input::get("papelAlbum"), 'id_laminacaoPapel'=>$lamPapel, 'id_lateral'=>Input::get("lateralAlbum"), "tipoEstojo"=>Input::get("estojoAlbum"), "tipoPersoEstojo"=>$persoEstojo, 'tipoFecho'=>$fechoEstojo, 'corFecho'=>$corFecho, 'id_usuario'=>Input::get("idUsuario"), 'data_criacao'=>date('Y-m-d H:i:s'), 'status'=>0, 'nomeAlbum'=>Input::get("nomeProjeto"), 'hash'=>$hash));
        
        //cria pedido para capa personalizada
        if(Input::get("tipoCapaEscolhida")==1){
            //checa se cliente tem pasta e pedido tem pasta
            $pastaCliente="assets/clientes/".Input::get("idUsuario");
            if (!file_exists($pastaCliente)) {
                mkdir($pastaCliente);
                chmod($pastaCliente, 0755);
            }

            $pastaPedido="assets/clientes/".Input::get("idUsuario")."/".$idPedido->id;
            if (!file_exists($pastaPedido)) {
                mkdir($pastaPedido);
                chmod($pastaPedido, 0755);
            }

            $pastaUpload="assets/clientes/".Input::get("idUsuario")."/".$idPedido->id."/capaAlbum/";
            if (!file_exists($pastaUpload)) {
                mkdir($pastaUpload);
                chmod($pastaUpload, 0755);
            }

            $extension = Input::file('imageCapa')->getClientOriginalExtension();
            if(($extension == "jpg"||$extension == "JPG")||($extension == "png"||$extension == "PNG")){
                $extension=strtolower($extension);
                Input::file('imageCapa')->move($pastaUpload, "capa.".$extension);
            }
            CapaImagemPedido::create(array('id_usuario'=>Input::get("idUsuario"), 'id_pedido'=>$idPedido->id, 'url'=>$pastaUpload."capa.".$extension, 'papel'=>Input::get("papelCapaFoto")));

        }
        if(Input::get("tipoCapaEscolhida")==2){
            CapaNapaPedido::create(array('id_usuario'=>Input::get("idUsuario"), 'id_pedido'=>$idPedido->id, 'id_napa'=>Input::get("texturaCapa")));

        }

        //cria pedido estojo personalizado
        if(Input::get("estojoPerson")==1){
            //checa se cliente tem pasta e pedido tem pasta
            $pastaCliente="assets/clientes/".Input::get("idUsuario");
            if (!file_exists($pastaCliente)) {
                mkdir($pastaCliente);
                chmod($pastaCliente, 0755);
            }

            $pastaPedido="assets/clientes/".Input::get("idUsuario")."/".$idPedido->id;
            if (!file_exists($pastaPedido)) {
                mkdir($pastaPedido);
                chmod($pastaPedido, 0755);
            }

            $pastaUpload="assets/clientes/".Input::get("idUsuario")."/".$idPedido->id."/capaEstojo/";
            if (!file_exists($pastaUpload)) {
                mkdir($pastaUpload);
                chmod($pastaUpload, 0755);
            }

            $extension = Input::file('imageEstojo')->getClientOriginalExtension();
            if(($extension == "jpg"||$extension == "JPG")||($extension == "png"||$extension == "PNG")){
                $extension=strtolower($extension);
                Input::file('imageEstojo')->move($pastaUpload, "capaEstojo.".$extension);
            }
            EstojoImagemPedido::create(array('id_usuario'=>Input::get("idUsuario"), 'id_pedido'=>$idPedido->id, 'url'=>$pastaUpload."capaEstojo.".$extension));
        }
        if(Input::get("estojoPerson")==2){
            EstojoNapaPedido::create(array('id_usuario'=>Input::get("idUsuario"), 'id_pedido'=>$idPedido->id, 'id_napa'=>Input::get("napaEstojo")));
        }

        return redirect("/projeto/".$hash."/1");

    }    

     
}
