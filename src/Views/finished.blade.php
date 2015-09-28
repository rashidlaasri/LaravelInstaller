@extends('vendor.installer.layouts.master')

@section('container')
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="glyphicon glyphicon-home"></i>
                {{ trans('messages.final.title') }}
            </h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-{{ session('message')['status'] }}">
                {{ session('message')['message'] }}
            </div>
            <a class="btn btn-success" href="/">
                {{ trans('messages.final.exit') }}
            </a>
        </div>
    </div>
@stop