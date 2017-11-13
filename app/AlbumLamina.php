<?php

namespace laboratorio;

use Illuminate\Database\Eloquent\Model;

class AlbumLamina extends Model
{
    protected $table = 'album_pedido_laminas';
    public $timestamps = false;
	protected $fillable = array("id_pedido", "lamina", "layout");
	protected $guarded = ["id"];
}
