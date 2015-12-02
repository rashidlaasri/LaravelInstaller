@extends('vendor.installer.layouts.master')

@section('title', trans('messages.environment.title'))
@section('container')
    @if (session('message'))
    <p class="alert">{{ session('message') }}</p>
    @endif
    <form method="post" action="{{ route('LaravelInstaller::environmentSave') }}">
        <textarea class="textarea" name="envConfig">{{ $envConfig }}</textarea>
        {!! csrf_field() !!}
        <div class="buttons buttons--right">
             <button class="button button--light" type="submit">{{ trans('messages.environment.save') }}</button>
        </div>
    </form>
    @if(!isset($environment['errors']))
    <div class="buttons">
        <a class="button" href="{{ route('LaravelInstaller::requirements') }}">
            {{ trans('messages.next') }}
        </a>
    </div>
    @endif
@stop