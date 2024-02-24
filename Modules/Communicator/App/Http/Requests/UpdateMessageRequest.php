<?php

namespace Modules\Communicator\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "id" => 'required|integer|exists:messages,id,deleted_at,NULL',
            "status" => 'required|string|in:sent,draft,failed,successful',
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
