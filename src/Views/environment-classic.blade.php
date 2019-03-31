@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.menu.templateTitle') }}
@endsection

@section('icon')
    {{ asset('installer/img/icons/environment.svg') }}
@endsection

@section('title')
    {{ trans('installer_messages.environment.menu.title') }}
@endsection

@section('main')

    <form class="form" method="post" action="{{ route('LaravelInstaller::environmentSaveClassic') }}">
        {!! csrf_field() !!}

        <div class="form-controllers">
            <div class="form-controller is-editor">
                <textarea class="form-textarea" name="envConfig">{{ $envConfig }}</textarea>
            </div>
        </div>

    </form>

@endsection
    
@section('actions')
    <a class="button is-primary {{ isset($environment['errors']) ? 'is-disabled' : '' }}" href="{{ route('LaravelInstaller::database') }}">
        <span>{!! trans('installer_messages.environment.classic.install') !!}</span>
        <i class="ion ion-ios-arrow-forward"></i>
    </a>
@endsection

@section('progress')
  <div class="step-progress" style="width: 80%"></div>
@endsection
