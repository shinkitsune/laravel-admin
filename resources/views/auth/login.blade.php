@extends('layouts.auth')

@section('content')

<div class="page-login">
    <main>
        <div>
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-3 center">
                        <div class="login-box">
                            
                            @if ($alert = Session::get('flash_error'))
                              <div class="alert alert-danger text-center">
                                  {{ $alert }}
                              </div>
                            @endif

                            @if ($alert = Session::get('flash_success'))
                              <div class="alert alert-success text-center">
                                  {{ $alert }}
                              </div>
                            @endif
                            
                            <a href="{{ URL('/') }}" class="logo-name text-lg text-center">{{ config('app.name', 'Laravel') }}</a>
                            <p class="text-center m-t-md">Faça login na sua conta.</p>
                            <form class="m-t-md" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Senha" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Login</button>

                                <a href="{{ url('/password/reset') }}" class="display-block text-center m-t-md text-sm">Esqueceu a senha?</a>
                                <p class="text-center m-t-xs text-sm">Não tem uma conta?</p>
                                <a href="{{ url('/register') }}" class="btn btn-info btn-block m-t-md">Criar uma conta</a>
                            </form>
                            <p class="text-center m-t-xs text-sm">2018 &copy; Rizer.com.br</p>
                        </div>
                    </div>
                </div><!-- Row -->
            </div><!-- Main Wrapper -->
        </div><!-- Page Inner -->
    </main><!-- Page Content -->
</div>

@endsection
