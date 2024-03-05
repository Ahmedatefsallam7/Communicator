<?php

namespace Modules\Communicator\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {

        return [
            'template_id' => 'required|integer|exists:templates,id,deleted_at,NULL',
            'user_id' => 'required|integer|exists:users,id',
            'app' => 'required|string|unique:messages,app',
            'message_data' => 'required',
            'status' => 'nullable|string|in:sent,,draft,failed,successful',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
