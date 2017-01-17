@extends('vendor.installer.layouts.master-update')

@section('title', trans('messages.updater.welcome.title'))
@section('container')
    <p class="paragraph">{{ trans_choice('messages.updater.overview.message', $numberOfUpdatesPending, ['number' => $numberOfUpdatesPending]) }}</p>
    <div class="buttons">
        <a href="{{ route('LaravelUpdater::database') }}" class="button">{{ trans('messages.finish') }}</a>
    </div>
@stop
