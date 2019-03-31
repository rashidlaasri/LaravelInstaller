@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.final.templateTitle') }}
@endsection

@section('icon')
	{{ asset('installer/img/icons/finished.svg') }}
@endsection

@section('title')
    {{ trans('installer_messages.final.title') }}
@endsection

@section('main')

	<div class="step-illustration">
		<img src="{{ asset('installer/img/illustrations/finished.svg') }}" alt="">
	</div>

	<div class="spacer-40"></div>
	
	<div class="form-controllers">
		@if(session('message')['dbOutputLog'])
			<div class="form-controller is-editor">
				<label class="form-label">{{ trans('installer_messages.final.migration') }}</label>
				<input type="text" class="form-input" value="{{ session('message')['dbOutputLog'] }}" readonly>
			</div>
		@endif

		<div class="form-controller is-editor">
			<label class="form-label">{{ trans('installer_messages.final.console') }}</label>
			<input type="text" class="form-input" value="{{ $finalMessages }}" readonly>
		</div>

		<div class="form-controller is-editor">
			<label class="form-label">{{ trans('installer_messages.final.log') }}</label>
			<input type="text" class="form-input" value="{{ $finalStatusMessage }}" readonly>
		</div>
	</div>

@endsection

@section('actions')
	<a href="{{ url('/') }}" class="button is-primary">
		<i class="ion ion-ios-checkmark-circle"></i>
		<span>{{ trans('installer_messages.final.exit') }}</span>
	</a>
@endsection

@section('progress')
  <div class="step-progress is-success" style="width: 100%"></div>
@endsection
