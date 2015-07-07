@extends('LaravelInstaller::layouts.master')

@section('container')
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="glyphicon glyphicon-folder-close"></i>
                {{ trans('LaravelInstaller::messages.database.title') }}
            </h3>
        </div>
        <div class="panel-body">
            @if(isset($respond['errors']))
                <div class="alert alert-danger">
                    {{ $respond['errors']['message'] }}
                </div>
            @else
                <p>
                    {{ trans('LaravelInstaller::messages.database.success') }}
                </p>
            @endif
            @if(!isset($respond['errors']))
                <a class="btn btn-success" href="/">
                    {{ trans('LaravelInstaller::messages.database.final') }}
                </a>
            @endif
        </div>
    </div>
@stop