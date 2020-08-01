@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.final.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.final.title') }}
@endsection

@section('container')

	@if(session('databaseMessage'))
		@if( session('databaseMessage')['dbOutputLog'])
			<p><strong><small>{{ trans('installer_messages.final.migration') }}</small></strong></p>
			@if(session('databaseMessage')['status'] == 'error')
				<strong><small>{{ trans('installer_messages.final.error') }}</small></strong>
				<pre>{{ session('databaseMessage')['message'] }}</pre>
			@else
				<pre><code>{{ session('databaseMessage')['dbOutputLog'] }}</code></pre>
			@endif
		@endif
	@endif

	@if(session('commandMessage'))
		<p><strong><small>{{ trans('installer_messages.final.command') }}</small></strong></p>
		@foreach (session('commandMessage') as $message)
			<p><strong><small>{{ $message['command'] }}</small></strong></p>
			@if($message['status'] == 'error')
				<strong><small>{{ trans('installer_messages.final.error') }}</small></strong>
				<pre>{{ $message['message'] }}</pre>
			@else
				<pre><code>{{ $message['outputLog'] }}</code></pre>
			@endif
		@endif
	@endif

	<p><strong><small>{{ trans('installer_messages.final.console') }}</small></strong></p>
	<pre><code>{{ $finalMessages }}</code></pre>

	<p><strong><small>{{ trans('installer_messages.final.log') }}</small></strong></p>
	<pre><code>{{ $finalStatusMessage }}</code></pre>

	<p><strong><small>{{ trans('installer_messages.final.env') }}</small></strong></p>
	<pre><code>{{ $finalEnvFile }}</code></pre>

    <div class="buttons">
        <a href="{{ url('/') }}" class="button">{{ trans('installer_messages.final.exit') }}</a>
    </div>

@endsection
