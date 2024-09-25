<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectImageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file_name' => ['sometimes','image','max:10240'],
            'title' => ['nullable', 'string', 'max:255'],
            'alt_tag_description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
