<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.es.gov.br/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <script src="https://www.google.com/recaptcha/api.js"></script>

    <link rel="shortcut icon" href="img/favicon.png" />

    <link href="css/login.css" rel="stylesheet">

    <title>E2 - Serviços</title>

</head>

<body style="background-color: #ececec;">



<!------ Include the above in your HEAD tag ---------->



<div class="container login-container" style="background-color:rgb(255, 255, 255)">

            <div class="row">

                <div class="col-md-6 login-form-1">

                    <h3>Entrar no sistema</h3>

                    

                    <form id="form_login" method="POST" action="{{ route('login') }}">

                        @csrf

                        @if($errors->all())

                            @foreach($errors->all() as $error)

                                <div class="alert alert-danger" role="alert">

                                    {{ $error }}

                                </div>

                            @endforeach

                        @endif

                        <div class="form-group row">

                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>



                            <div class="col-md-8">

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>



                                @error('email')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>



                        <div class="form-group row">

                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>



                            <div class="col-md-8">

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">



                                @error('password')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>



                        <div class="form-group row">

                            <div class="col-md-6 offset-md-4">

                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>



                                    <label class="form-check-label" for="remember">

                                        {{ __('Lembrar de mim') }}

                                    </label>

                                </div>

                            </div>

                        </div>



                        <div class="form-group row mb-0">

                            <div class="col-md-8 offset-md-4">

                                <button type="submit" class="btn btn-primary" 

                                

                                data-action='submit' >

                                    {{ __('Entrar') }}

                                </button>



                                @if (Route::has('password.request'))

                                    <a class="btn btn-link" href="{{ route('password.request') }}">

                                        {{ __('Esqueceu a senha?') }}

                                    </a>

                                @endif

                            </div>

                        </div>

                    </form>

                </div>

                <div class="col-md-6 login-form-2" style="text-align: center;">

                    <img src="{{asset('img/logo_login.png')}}">

                    <p><h4 style="color:white;">Sistema de controle</h4></p>

                    <div class="col-md-8" style="text-align: left;">

                        <ul style="color:white;">

                            <li>Comunicados de tratamento</li>
                            <li>Certificados de tratamento</li>
                          
                        </ul>

                    </div>

                    <p><h6 style="color:white;">Desenvolvido por BiosWeb (Lúcio Adriano)</h6></p>

                </div>

            </div>

        </div>

</body>

</html>

<script>

    /*function onSubmit(token) {

      document.getElementById("form_login").submit();

    }*/

  </script>