@extends('vendor.installer.layouts.master')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
@section('title', trans('messages.environment.title'))
@section('container')
    @if (isset($message))
    <p class="alert">{{ $message }}</p>
    @endif
    <form method="post" action="{{ route('LaravelInstaller::environmentSave') }}">
       

        <div class="form-group">
            <label for="APP_ENV">APP_ENV</label>
            <input type="text" class="form-control" name="APP_ENV" value="{{$APP_ENV}}">
        </div>
          
        <div class="form-group">
            <label for="APP_DEBUG">APP_DEBUG</label>
            <input type="text" class="form-control" name="APP_DEBUG" value="{{$APP_DEBUG}}">
        </div>

        <div class="form-group">
            <label for="APP_KEY">APP_KEY</label>
            <input type="text" class="form-control" name="APP_KEY" value="{{$APP_KEY}}">
        </div>
        <hr></hr>
        <div class="form-group">
            <label for="DB_HOST">DB_HOST</label>
            <input type="text" class="form-control" name="DB_HOST" value="{{$DB_HOST}}">
        </div>

        <div class="form-group">
            <label for="DB_DATABASE">DB_DATABASE</label>
            <input type="text" class="form-control" name="DB_DATABASE" value="{{$DB_DATABASE}}">
        </div>

        <div class="form-group">
            <label for="DB_USERNAME">DB_USERNAME</label>
            <input type="text" class="form-control" name="DB_USERNAME" value="{{$DB_USERNAME}}">
        </div>

        <div class="form-group">
            <label for="DB_PASSWORD">DB_PASSWORD</label>
            <input type="text" class="form-control" name="DB_PASSWORD" value="{{$DB_PASSWORD}}">
        </div>
        <hr></hr>
        <div class="form-group">
            <label for="CACHE_DRIVER">CACHE_DRIVER</label>
            <input type="text" class="form-control" name="CACHE_DRIVER" value="{{$CACHE_DRIVER}}">
        </div>

        <div class="form-group">
            <label for="SESSION_DRIVER">SESSION_DRIVER</label>
            <input type="text" class="form-control" name="SESSION_DRIVER" value="{{$SESSION_DRIVER}}">
        </div>

        <div class="form-group">
            <label for="QUEUE_DRIVER">QUEUE_DRIVER</label>
            <input type="text" class="form-control" name="QUEUE_DRIVER" value="{{$QUEUE_DRIVER}}">
        </div>
        <hr></hr>
        <div class="form-group">
            <label for="MAIL_DRIVER">MAIL_DRIVER</label>
            <input type="text" class="form-control" name="MAIL_DRIVER" value="{{$MAIL_DRIVER}}">
        </div>

        <div class="form-group">
            <label for="MAIL_HOST">MAIL_HOST</label>
            <input type="text" class="form-control" name="MAIL_HOST" value="{{$MAIL_HOST}}">
        </div>

        <div class="form-group">
            <label for="MAIL_PORT">MAIL_PORT</label>
            <input type="text" class="form-control" name="MAIL_PORT" value="{{$MAIL_PORT}}">
        </div>

        <div class="form-group">
            <label for="MAIL_USERNAME">MAIL_USERNAME</label>
            <input type="text" class="form-control" name="MAIL_USERNAME" value="{{$MAIL_USERNAME}}">
        </div>

        <div class="form-group">
            <label for="MAIL_PASSWORD">MAIL_PASSWORD</label>
            <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{$MAIL_PASSWORD}}">
        </div>

        <div class="form-group">
            <label for="MAIL_ENCRYPTION">MAIL_ENCRYPTION</label>
            <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{$MAIL_ENCRYPTION}}">
        </div>


       


        {!! csrf_field() !!}
        <div class="buttons buttons--right">
             <button class="button button--light" type="submit">{{ trans('messages.environment.save') }}</button>
        </div>
    </form>
    @if(isset($saved))
    @if($saved == true)
    <div class="buttons">
        <a class="button" href="{{ route('LaravelInstaller::requirements') }}">
            {{ trans('messages.next') }}
        </a>
    </div>
    @endif
    @endif
@stop