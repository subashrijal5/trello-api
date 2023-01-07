<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request('type') == 'statusupdate') {
            return ['task_group_id' => 'required|integer'];
        }
        return [
            'title' => 'required|string|max:255',
            'task_group_id' => 'required|integer',
            'description'=> 'nullable|string|max:1000'
        ];
    }
}
