@extends('installer.layouts.master')

@section('container')
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="glyphicon glyphicon-file"></i>
                {{ trans('LaravelInstaller::messages.permissions.title') }}
            </h3>
        </div>
        <div class="panel-body">
            <div class="bs-component">
                <ul class="list-group">
                    @foreach($permissions['permissions'] as $permission)
                        <li class="list-group-item">
                            @if($permission['isSet'])
                                <span class="badge badge-success">
                                    {{ $permission['permission'] }}
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    {{ $permission['permission'] }}
                                </span>
                            @endif
                            {{ $permission['folder'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @if(!isset($permissions['errors']))
                <a class="btn btn-success" href="{{ route('LaravelInstaller::database') }}">
                    {{ trans('LaravelInstaller::messages.next') }}
                </a>
            @endif
        </div>
    </div>
@stop