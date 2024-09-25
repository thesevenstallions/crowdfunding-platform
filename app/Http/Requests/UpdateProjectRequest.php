<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'string',
                Rule::unique('projects', 'name')->ignore($this->project),
                'max:50'],
            'description' => ['required','string'],
            'is_special' => ['boolean'],
            'is_urgent' => ['boolean'],
            'budget' => ['integer', 'required'],
            'organizer_name' => ['string', 'required', 'max:50'],
            'organizer_position' => ['string', 'required', 'max:50'],
            'organizer_company_name' => ['string', 'required', 'max:100'],
            'project_type_id' => ['exists:project_types,id', 'required'],
            'status' => ['required', Rule::enum(Status::class)],
        ];
    }
}
