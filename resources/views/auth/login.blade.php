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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.1/css/uikit.min.css" />
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="assets/css/login_page.min.css" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <style>
        body {
            font-family: 'Lato';
            background-color: #142C3E!important;  
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            background: url('https://jobzi.com/assets/img/page/js-invite/9a4a86b9.particle.png') no-repeat center center fixed;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='https://jobzi.com/assets/img/page/js-invite/9a4a86b9.particle.png', sizingMethod='scale');
            -ms-filter "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='https://jobzi.com/assets/img/page/js-invite/9a4a86b9.particle.png', sizingMethod='scale');
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
    </style>   
</head>
<body id="app-layout">
<div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"><h1>Best Lab</h1></div>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                    <div class="uk-form-row">
                        <label for="login_username">Email</label>
                        <input class="md-input" type="text" id="email" name="email" value="{{ old('email') }}"/>
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" id="login_password" type="password" name="password"/>
                    </div>
                    <div class="uk-margin-medium-top">
                        <button class="md-btn md-btn-primary md-btn-block md-btn-large">Login</button>
                    </div>
                </form>
            </div>
            <div class="uk-margin-top uk-text-center">
                <a href="/register" id="signup_form_show">Cadastrar-se</a>
            </div>
        </div>
    <footer style="color: #a9b1b7; text-align: center; margin: 0 auto;">
        Desenvolvido por <a href="http://atadesign.com.br" target="_blank">ATA Design</a>.
    </footer>
</div>
   

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.1/js/uikit.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
