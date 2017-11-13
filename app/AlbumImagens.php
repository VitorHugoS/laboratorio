<?php

namespace laboratorio;

use Illuminate\Database\Eloquent\Model;

class AlbumImagens extends Model
{
    protected $table = 'album_imagens';
    public $timestamps = false;
	protected $fillable = array("id_pedido", "url");
	protected $guarded = ["id"];
}
