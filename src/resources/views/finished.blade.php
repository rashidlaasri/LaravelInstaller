@extends('installer::layouts.master')

@section('template_title')
    {{ trans('installer::installer_messages.final.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('installer::installer_messages.final.title') }}
@endsection

@section('container')

    <p><strong><small></small></strong></p>

    <p>{{ config('app.name') }} has been installed. Thank you, and enjoy!</p>

    <table class="form-table install-success">
        <tbody>
        <tr>
            <th>Email</th>
            <td>{{$admin->email}}</td>
        </tr>
        <tr>
            <th>Password</th>
            <td>
                <p><em>Your chosen password.</em></p>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="buttons">
        <a href="{{ url('/ch-admin') }}" class="button">{{ trans('installer::installer_messages.final.exit') }}</a>
    </div>
@endsection
