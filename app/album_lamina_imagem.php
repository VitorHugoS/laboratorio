<?php

namespace laboratorio;

use Illuminate\Database\Eloquent\Model;

class album_lamina_imagem extends Model
{
    protected $table = 'album_lamina_imagem';
    public $timestamps = false;
	protected $fillable = array("id_pedido", "id_lamina", "id_imagem", "pos", "bk_position", "zoomAtual");
	protected $guarded = ["id"];
}
