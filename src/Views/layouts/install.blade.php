@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.classic.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-code fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.environment.classic.title') }}
@endsection

@section('main')
    <form method="post" action="{{ route('LaravelInstaller::environmentSaveClassic') }}">
        {!! csrf_field() !!}
        <textarea class="textarea" name="envConfig">{{ $envConfig }}</textarea>
        <div class="buttons buttons--right">
            <button class="button button--light" type="submit">
            	<i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i>
             	{!! trans('installer_messages.environment.classic.save') !!}
            </button>
        </div>
    </form>

    @if( ! isset($environment['errors']))
        <div class="buttons-container">
            <a class="button float-left" href="{{ route('LaravelInstaller::environmentWizard') }}">
                <i class="fa fa-sliders fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.environment.classic.back') !!}
            </a>
            <a class="button float-right" href="{{ route('LaravelInstaller::database') }}">
                <i class="fa fa-check fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.environment.classic.install') !!}
                <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif

@endsection





<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ trans('installer_messages.title') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-16x16.png') }}" sizes="16x16"/>
        <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-32x32.png') }}" sizes="32x32"/>
        <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-96x96.png') }}" sizes="96x96"/>
        <link href="{{ asset('installer/css/app.css') }}" rel="stylesheet"/>
        @yield('style')
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body class="app">



        @include('vendor.installer.partials.steps')



        




        <div class="master">
            <div class="box">
                <div class="header">
                    <h1 class="header__title">@yield('title')</h1>
                </div>
                



                <div class="main">
                    @if (session('message'))
                        <p class="alert text-center">
                            <strong>
                                @if(is_array(session('message')))
                                    {{ session('message')['message'] }}
                                @else
                                    {{ session('message') }}
                                @endif
                            </strong>
                        </p>
                    @endif
                    @if(session()->has('errors'))
                        <div class="alert alert-danger" id="error_alert">
                            <button type="button" class="close" id="close_alert" data-dismiss="alert" aria-hidden="true">
                                 <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                            <h4>
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ trans('installer_messages.forms.errorTitle') }}
                            </h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('container')
                </div>
            </div>
        </div>
        @yield('scripts')
        <script type="text/javascript">
            var x = document.getElementById('error_alert');
            var y = document.getElementById('close_alert');
            y.onclick = function() {
                x.style.display = "none";
            };
        </script>
    </body>
</html>
