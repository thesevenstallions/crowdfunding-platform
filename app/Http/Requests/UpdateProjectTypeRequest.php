<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectTypeRequest extends FormRequest
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
                Rule::unique('project_types', 'name')->ignore($this->project_type),
                'max:50'],
            'status' => ['required', Rule::enum(Status::class)],
        ];
    }
}
