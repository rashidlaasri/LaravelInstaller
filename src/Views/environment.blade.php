@extends('vendor.installer.layouts.master')

@section('container')
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="glyphicon glyphicon-file"></i>
                {{ trans('messages.environment.title') }}
            </h3>
        </div>
        <div class="panel-body">
            @if (session('message'))
                <div class="alert alert-warning">
                    {{ session('message') }}
                </div>
            @endif
            <form method="post" action="{{ route('LaravelInstaller::environmentSave') }}">
                <div class="bs-component">
                    <ul class="list-group">
                        <textarea name="envConfig" rows="10">{{ $envConfig }}</textarea>
                    </ul>
                </div>
                @if(!isset($environment['errors']))
                    <a class="btn btn-success" href="{{ route('LaravelInstaller::requirements') }}">
                        {{ trans('messages.next') }}
                    </a>
                @endif
                {!! csrf_field() !!}
                <input type="submit" class="btn btn-info" style="float: right;" value="{{ trans('messages.environment.save') }}">
            </form>
        </div>
    </div>
@stop