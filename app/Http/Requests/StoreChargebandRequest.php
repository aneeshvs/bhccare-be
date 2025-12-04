<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChargebandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'chargeband_name' => 'required|string|max:100',
            'categoryid'      => 'required|integer',
            'fundtypeid'      => 'required|integer',
            'serviceid'       => 'required|string|max:50',
            'color'           => 'nullable|string|max:10',
            'status'          => 'required|integer',
            'companyid'       => 'required|integer',
        ];
    }
}
