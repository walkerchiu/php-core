<?php

namespace WalkerChiu\Core\Models\Forms;

use Illuminate\Foundation\Http\FormRequest as LaravelRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class FormRequest extends LaravelRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return Bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return Array
     */
    public function rules()
    {
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return Array
     */
    public function messages()
    {
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
    }

    /**
     * @Override Illuminate\Foundation\Http\FormRequest::getValidatorInstance
     */
    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance();
    }

    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return String
     */
    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();

        if ($this->redirect) {
            return $url->to($this->redirect);
        } elseif ($this->redirectRoute) {
            return $url->route($this->redirectRoute);
        } elseif ($this->redirectAction) {
            return $url->action($this->redirectAction);
        }

        return $url->previous();
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param Array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            if (config('wk-core.formRequest.returnType') == 2) {
                return new JsonResponse($errors, 422);
            } elseif (config('wk-core.formRequest.returnType') == 3) {
                return response()->json([
                        'success' => false,
                        'data'    => null,
                        'error'   => $errors
                    ], 422, [
                        'Content-Type' => 'application/json',
                        'Charset'      => 'utf-8'
                    ], JSON_UNESCAPED_UNICODE);
            }
        }

        return $this->redirector->to($this->getRedirectUrl())
                                ->withInput($this->except($this->dontFlash))
                                ->withErrors($errors, $this->errorBag);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation($validator)
    {
        if (config('wk-core.formRequest.returnType') == 1) {
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        } else {
            throw new ValidationException(
                $validator,
                $this->response( $validator->getMessageBag()->toArray() )
            );
        }
    }
}
