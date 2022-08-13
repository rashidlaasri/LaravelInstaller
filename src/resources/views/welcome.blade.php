@extends('installer::layouts.master')

@section('template_title')
    {{ trans('installer::installer_messages.welcome.templateTitle') }}
@endsection

@section('title')
    {{ trans('installer::installer_messages.welcome.title') }}
@endsection

@section('container')
    <form method="post" action="{{ route('LaravelInstaller::saveInstallation') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
            <label for="app_name">
                {{ trans('installer::installer_messages.environment.wizard.form.app_name_label') }}
            </label>
            <input type="text" name="app_name" id="app_name" value="{{ old('app_name', config('app.name')) }}"
                   placeholder="{{ trans('installer::installer_messages.environment.wizard.form.app_name_placeholder') }}"/>
            @if ($errors->has('app_name'))
                <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_name') }}
                        </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
            <label for="app_url">
                {{ trans('installer::installer_messages.environment.wizard.form.app_url_label') }}
            </label>
            <input type="url" name="app_url" id="app_url" value="{{ old('app_url', url('/')) }}"
                   placeholder="{{ trans('installer::installer_messages.environment.wizard.form.app_url_placeholder') }}"/>
            @if ($errors->has('app_url'))
                <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_url') }}
                        </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('admin_email') ? ' has-error ' : '' }}">
            <label for="admin_email">
                {{ trans('installer::installer_messages.environment.wizard.form.admin_email_label') }}
            </label>
            <input type="text" name="admin_email" id="admin_email" value="{{ old('admin_email') }}"
                   placeholder="{{ trans('installer::installer_messages.environment.wizard.form.admin_email_label') }}"/>
            @if ($errors->has('admin_email'))
                <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('admin_email') }}
                        </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('admin_password') ? ' has-error ' : '' }}">
            <label for="admin_password">
                {{ trans('installer::installer_messages.environment.wizard.form.admin_password_label') }}
            </label>
            <input type="password" name="admin_password" id="admin_password" value="{{ old('admin_password') }}"
                   placeholder="{{ trans('installer::installer_messages.environment.wizard.form.admin_password_label') }}"/>
            @if ($errors->has('admin_password'))
                <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('admin_password') }}
                        </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
            <label for="database_hostname">
                {{ trans('installer::installer_messages.environment.wizard.form.db_host_label') }}
            </label>
            <input type="text" name="database_hostname" id="database_hostname"
                   value="{{ old('database_hostname', '127.0.0.1') }}"
                   placeholder="{{ trans('installer::installer_messages.environment.wizard.form.db_host_placeholder') }}"/>
            @if ($errors->has('database_hostname'))
                <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_hostname') }}
                        </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
            <label for="database_port">
                {{ trans('installer::installer_messages.environment.wizard.form.db_port_label') }}
            </label>
            <input type="number" name="database_port" id="database_port" value="{{ old('database_port', '3306') }}"
                   placeholder="{{ trans('installer::installer_messages.environment.wizard.form.db_port_placeholder') }}"/>
            @if ($errors->has('database_port'))
                <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_port') }}
                        </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
            <label for="database_name">
                {{ trans('installer::installer_messages.environment.wizard.form.db_name_label') }}
            </label>
            <input type="text" name="database_name" id="database_name" value="{{ old('database_name') }}"
                   placeholder="{{ trans('installer::installer_messages.environment.wizard.form.db_name_placeholder') }}"/>
            @if ($errors->has('database_name'))
                <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_name') }}
                        </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
            <label for="database_username">
                {{ trans('installer::installer_messages.environment.wizard.form.db_username_label') }}
            </label>
            <input type="text" name="database_username" id="database_username" value="{{ old('database_username') }}"
                   placeholder="{{ trans('installer::installer_messages.environment.wizard.form.db_username_placeholder') }}"/>
            @if ($errors->has('database_username'))
                <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_username') }}
                        </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
            <label for="database_password">
                {{ trans('installer::installer_messages.environment.wizard.form.db_password_label') }}
            </label>
            <input type="password" name="database_password" id="database_password"
                   value="{{ old('database_password') }}"
                   placeholder="{{ trans('installer::installer_messages.environment.wizard.form.db_password_placeholder') }}"/>
            @if ($errors->has('database_password'))
                <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_password') }}
                        </span>
            @endif
        </div>
        <div class="buttons">
            <button class="button" type="submit">
                {{ trans('installer::installer_messages.environment.wizard.form.buttons.install') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </form>
@endsection
