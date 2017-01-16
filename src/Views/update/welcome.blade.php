@extends('vendor.installer.layouts.master-update')

@section('title', trans('messages.updater.welcome.title'))
@section('container')
    <p class="paragraph">{{ trans('messages.updater.welcome.message') }}</p>
    <div class="buttons">
        <a href="{{ route('LaravelUpdater::overview') }}" class="button">{{ trans('messages.next') }}</a>
    </div>
@stop
