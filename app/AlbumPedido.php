<?php

namespace laboratorio;

use Illuminate\Database\Eloquent\Model;

class AlbumPedido extends Model
{
    //tabela banco
    protected $table = 'album_pedido';
    public $timestamps = false;
	protected $fillable = array("id_modelo", "id_tamanho", "tipoCapa", "id_papelAlbum", "id_laminacaoPapel", "id_lateral","tipoEstojo", "tipoPersoEstojo", "tipoFecho", "corFecho", "id_usuario", "data_criacao", "data_atualizacao", "status", "nomeAlbum", "hash");
	protected $guarded = ["id"];

}
