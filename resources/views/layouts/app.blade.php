<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BestLab</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

     <!-- Compiled and minified CSS -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/css/uikit.min.css" />
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>



    <link rel="stylesheet" href="/custom.css"/>
    <!-- altair admin login page -->
    <link rel="stylesheet" href="/assets/css/main.min.css" media="all">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <style>
        body {
            font-family: 'Lato';
            background-color: #fff!important;  
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .fa-btn {
            margin-right: 6px;
        }
        main {
            flex: 1 0 auto;
        }
        nav ul a{
             font-size: 1.2rem!important;
        }  
        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
        }   
    </style>  
</head>
<body id="sidebar_main_open sidebar_main_swipe">
     <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                      
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image">Bem vindo, {{ Auth::user()->name }} </a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="/logout">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header><!-- main header end -->
<div id="top_bar">
    <div class="md-top-bar">
        <ul id="menu_top" class="uk-clearfix">
            <li><a href="/"><i class="material-icons md-24">&#xE88A;</i></a></li>
            <li>
                <a href="#">Álbum</a>
                <div uk-dropdown>
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="forms_regular.html">Novo Projeto de Álbum</a></li>
                        <li><a href="forms_advanced.html">Projetos de Álbum em Andamento</a></li>
                    </ul>
                </div>
            </li>
            <!-- <li>
                <a href="#">Fotos</a>
                <div uk-dropdown>
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="components_accordion.html">Novo Envio de Fotos</a></li>
                        <li><a href="components_buttons.html">Envio de Fotos em Andamento</a></li>
                    </ul>
                </div>
            </li> -->
        </ul>
    </div>
</div>
<div id="page_content">
    <div id="page_content_inner">
    @yield('content')
    </div>
</div>
<footer class="header_main uk-text-center" style="background: #000; color: #fff!important;">
        <h4 style="color: #fff;">Desenvolvido por ATA Design.</h3>
    </footer>
    <!-- JavaScripts -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/js/uikit-icons.min.js"></script>
   
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield("js")
</body>
</html>
