@extends('vendor.installer.layouts.master-update')

@section('title', trans('messages.updater.final.title'))
@section('container')
    <p class="paragraph">{{ session('message')['message'] }}</p>
    <div class="buttons">
        <a href="{{ url('/') }}" class="button">{{ trans('messages.updater.final.exit') }}</a>
    </div>
@stop
