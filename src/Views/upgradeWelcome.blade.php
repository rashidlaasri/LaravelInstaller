@extends('vendor.installer.layouts.master')

@section('container')
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="glyphicon glyphicon-home"></i>
                {{ trans('messages.welcome.title') }}
            </h3>
        </div>
        <div class="panel-body">
            <p>
                {{ trans('messages.upgrade.welcome', ['current' => $currentVersion, 'latest' => config('installer.last_version')]) }}
            </p>
            <a class="btn btn-success" href="{{ route('LaravelInstaller::process') }}">
                {{ trans('messages.upgrade.button') }}
            </a>
        </div>
    </div>
@stop