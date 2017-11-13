<?php

namespace laboratorio;

use Illuminate\Database\Eloquent\Model;

class EstojoNapaPedido extends Model
{
   	protected $table = 'album_pedido_personaliza_estojo_napa';
    public $timestamps = false;
	protected $fillable = array("id_usuario", "id_pedido", "id_napa");
	protected $guarded = ["id"];
}
