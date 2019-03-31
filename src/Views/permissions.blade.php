@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.permissions.templateTitle') }}
@endsection

@section('icon')
    {{ asset('installer/img/icons/permissions.svg') }}
@endsection

@section('title')
    {{ trans('installer_messages.permissions.title') }}
@endsection

@section('main')

    <ul class="alerts-list">
        @foreach($permissions['permissions'] as $permission)
        <li class="alert-item is-{{ $permission['isSet'] ? 'success' : 'warning' }}">
            <span class="alert-text">{{ $permission['folder'] }}</span>
            
            <b class="alert-details">
                {{ $permission['permission'] }}
            </b>
            
            <i class="alert-icon ion-ios-{{ $permission['isSet'] ? 'checkmark-circle' : 'alert' }}"></i>
        </li>
        @endforeach
    </ul>

@endsection

@section('actions')
    <a href="{{ route('LaravelInstaller::environmentClassic') }}" class="button is-primary {{ isset($permissions['errors']) ? 'is-disabled' : '' }}">
        <span>{{ trans('installer_messages.permissions.next') }}</span>
        <i class="ion ion-ios-arrow-forward"></i>
    </a>
@endsection


@section('progress')
<div class="step-progress" style="width: 60%"></div>
@endsection
