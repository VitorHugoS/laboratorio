@extends('layouts.app')
<img src="http://clicpro.ind.br/wp-content/uploads/2015/07/BANNER-CLIC-PRO-41.jpg" style="width: 100%;">
@section('content')

<div  class="uk-grid-divider" uk-grid>
    <div class="uk-width-1-5@m uk-width-1-3@l uk-hidden-@s">
        <ul class="md-list">
            <li><a href="/projetos"><button class="md-btn md-btn-block md-btn-black">Álbuns em Andamento</button></a></li>
          <!-- <li><a href="/criarprojeto"><button class="md-btn md-btn-block md-btn-black">Envio de Fotos em Andamento</button></a></li> -->
        </ul>
    </div>

    <div class="uk-width-3-5@m uk-width-2-3@l uk-hidden-@s">
    <ul class="md-list">
    <li>
        <div>
            <div class="uk-width-1-1 uk-text-center">
                <a href="/criarprojeto"><button class="md-btn md-btn-block md-btn-black">Crie um novo álbum</button></a>
            </div>
        </div>
    </li>
    <!-- <li>
        <div>
            <div class="uk-width-1-1 uk-text-center">
                <button class="md-btn md-btn-block md-btn-black">Envio de Fotos</button>
            </div>
        </div>
    </li> -->
    </ul>
    </div>
</div>
@endsection
