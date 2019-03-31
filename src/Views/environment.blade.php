@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.menu.templateTitle') }}
@endsection

@section('icon')
    {{ asset('installer/img/icons/environment.svg') }}
@endsection

@section('title')
    <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.menu.title') !!}
@endsection

@section('main')
    <p>
        {!! trans('installer_messages.environment.menu.desc') !!}
    </p>
@endsection

@section('actions')
    <a href="{{ route('LaravelInstaller::environmentWizard') }}" class="button is-primary button-wizard">
        <i class="ion ion-ios-help-buoy"></i>
        <span>{{ trans('installer_messages.environment.menu.wizard-button') }}</span>
    </a>
    <a href="{{ route('LaravelInstaller::environmentClassic') }}" class="button is-primary button-classic">
        <i class="ion ion-ios-code"></i>
        <span>{{ trans('installer_messages.environment.menu.classic-button') }}</span>
    </a>
@endsection

@section('progress')
  <div class="step-progress" style="width: 80%"></div>
@endsection
