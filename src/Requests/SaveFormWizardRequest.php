<?php

namespace RachidLaasri\LaravelInstaller\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFormWizardRequest extends FormRequest
{
    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'LaravelInstaller::environmentWizard';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return config('installer.environment.form.rules');
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'environment_custom.required_if' => trans('installer_messages.environment.wizard.form.name_required')
        ];
    }
}
