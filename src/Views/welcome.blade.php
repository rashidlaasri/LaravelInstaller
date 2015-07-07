@extends('LaravelInstaller::layouts.master')

@section('container')
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="glyphicon glyphicon-home"></i>
                {{ trans('LaravelInstaller::messages.welcome.title') }}
            </h3>
        </div>
        <div class="panel-body">
            <p>
                {{ trans('LaravelInstaller::messages.welcome.message') }}
            </p>
            <a class="btn btn-success" href="{{ route('LaravelInstaller::requirements') }}">
                {{ trans('LaravelInstaller::messages.next') }}
            </a>
        </div>
    </div>
@stop