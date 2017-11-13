<?php

namespace laboratorio;

use Illuminate\Database\Eloquent\Model;

class CapaNapaPedido extends Model
{
   	protected $table = 'album_pedido_personaliza_capa_napa';
    public $timestamps = false;
	protected $fillable = array("id_usuario", "id_pedido", "id_napa");
	protected $guarded = ["id"];
}
