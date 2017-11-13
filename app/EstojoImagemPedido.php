<?php

namespace laboratorio;

use Illuminate\Database\Eloquent\Model;

class EstojoImagemPedido extends Model
{
    protected $table = 'album_pedido_personaliza_estojo_imagem';
    public $timestamps = false;
	protected $fillable = array("id_usuario", "id_pedido", "url");
	protected $guarded = ["id"];
}
