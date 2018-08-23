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
                            
                            <a href="{{ URL('/') }}" class="logo-name text-lg text-center">{{ config('app.name', 'Laravel') }}</a>
                            
                            <p class="text-center m-t-md">Cadastre-se</p>
                            
                            <form class="m-t-md" role="form" method="POST" action="{{ url('/register') }}">
                                
                                {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nome" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="E-mail" required>
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

                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmação de senha" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-info btn-block">Criar conta</button>

                                <p class="display-block text-center m-t-md text-sm">Já tem uma conta? <a href="{{ url('/') }}">Clique para acessar</a></p>

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
