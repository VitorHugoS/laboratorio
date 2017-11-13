<?php

namespace laboratorio;

use Illuminate\Database\Eloquent\Model;

class CapaImagemPedido extends Model
{
    protected $table = 'album_pedido_personaliza_capa_imagem';
    public $timestamps = false;
	protected $fillable = array("id_usuario", "id_pedido", "url", "papel");
	protected $guarded = ["id"];
}
