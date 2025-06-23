<?php

namespace App\Http\Requests;

use App\Models\Status;
use App\Models\User;
use App\Models\UserType;
use App\Models\Zone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
{
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
        return [
           'name'          => [
                'sometimes',
                Rule::unique(User::class)->ignore($this->user)
            ],
            'email'          => [
                'sometimes',
                Rule::unique(User::class)->ignore($this->user)
            ],
            'user_type_id'  => [
                'sometimes',
                Rule::exists(UserType::class, 'id'),
            ],
            'status_id'  => [
                'sometimes',
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
