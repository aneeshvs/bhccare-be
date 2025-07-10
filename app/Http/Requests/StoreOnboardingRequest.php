<?php //store full form request validation
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreOnboardingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // or implement your auth logic
    }
    public function rules()
    {
        return array_merge(
            $this->InitialenquiryRules(),


        );
    }

    private function InitialenquiryRules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'preferred_name' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string|max:20',
            'mobile_number' => 'required|string|max:20',
            'email' => 'nullable|email',
            'need_support_person' => 'required|boolean',
            'support_person_details' => 'nullable|string'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(['success' => false, 'status' => 400, 'message' => 'Invalid Format', 'data' => $errors, 'alert' => true], 200)
        );
    }
}
