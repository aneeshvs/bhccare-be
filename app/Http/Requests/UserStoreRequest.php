<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\TRequestHelper;
use App\Models\Department;
use App\Models\JcomTable;
use App\Models\Status;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;
class UserStoreRequest extends FormRequest
{
    use TRequestHelper;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //$this->setI
        return [
            'name'          => [
                'required',
                Rule::unique(User::class)
            ],
            'email'          => [
                'required',
                'email',
                Rule::unique(User::class)
            ],
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
                'confirmed',
            ],
            'user_type_id' =>[
                'required',
                Rule::exists(UserType::class, 'id'),
            ],
            'jcom_table_id' =>[
                'sometimes',
                Rule::exists(JcomTable::class, 'id'),
            ],



            'status_id'  => [
                'required',
                Rule::exists(Status::class, 'id'),
            ],
        ];
    }

    /**
    * Handle a failed validation attempt.
    *
    * @param  \Illuminate\Contracts\Validation\Validator $validator
    * @return void
    *
    * @throws \Illuminate\Validation\ValidationException
    */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(['success' => false, 'status' => 400, 'message' => 'Invalid Format', 'data' => $errors, 'alert' =>true], 200)
        );
    }
}
