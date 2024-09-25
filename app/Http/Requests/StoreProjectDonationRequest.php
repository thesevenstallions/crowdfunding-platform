<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectDonationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'donor' => [
                'required', 'string',
                'max:50'],
            'donation_amount' => ['integer', 'required'],
            'donation_date' => ['required', 'date'],
        ];
    }
}
