@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.requirements.templateTitle') }}
@endsection

@section('icon')
    {{ asset('installer/img/icons/requirements.svg') }}
@endsection

@section('title')
    {{ trans('installer_messages.requirements.title') }}
@endsection

@section('main')

    @foreach($requirements['requirements'] as $type => $requirement)
    <ul class="alerts-list">
        <li class="alert-item is-{{ $phpSupportInfo['supported'] ? 'success' : 'warning' }}">
            <span class="alert-text">{{ ucfirst($type) }}</span>
            @if($type == 'php')
            <b class="alert-details">
                {{ $phpSupportInfo['current'] }} (version {{ $phpSupportInfo['minimum'] }} required)
            </b>
            
            <i class="alert-icon ion-ios-{{ $phpSupportInfo['supported'] ? 'checkmark-circle' : 'alert' }}"></i>
            @endif
        </li>
        @foreach($requirements['requirements'][$type] as $extention => $enabled)
        <li class="alert-item is-{{ $enabled ? 'success' : 'warning' }}">
            <span class="alert-text">{{ $extention }}</span>
            <i class="alert-icon ion-ios-{{ $enabled ? 'checkmark-circle' : 'alert' }}"></i>
        </li>
        @endforeach
    </ul>
    @endforeach

@endsection

@section('actions')
    <a href="{{ route('LaravelInstaller::permissions') }}" class="button is-primary {{ (isset($requirements['errors']) && !$phpSupportInfo['supported']) ? 'is-disabled' : '' }}">
        <span>{{ trans('installer_messages.requirements.next') }}</span>
        <i class="ion ion-ios-arrow-forward"></i>
    </a>
@endsection

@section('progress')
    <div class="step-progress" style="width: 40%"></div>
@endsection
