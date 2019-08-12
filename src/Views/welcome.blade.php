@extends('vendor.installer.layouts.master')

@section('template_title')
	{{ trans('installer_messages.welcome.templateTitle') }}
@endsection

@section('icon')
	{{ asset('installer/img/icons/welcome.svg') }}
@endsection

@section('title')
	{{ trans('installer_messages.welcome.title') }}
@endsection

@section('main')

	<div class="step-illustration">
		<img src="{{ asset('installer/img/illustrations/welcome.svg') }}" alt="">
	</div>

@endsection

@section('actions')
	<a href="{{ route('LaravelInstaller::requirements') }}" class="button is-primary">
		<span>{{ trans('installer_messages.welcome.next') }}</span>
		<i class="ion ion-ios-arrow-forward"></i>
	</a>
@endsection

@section('progress')
	<div class="step-progress" style="width: 20%"></div>
@endsection
