<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Tender;

use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

final class DeleteTenderAttachmentsRequest extends BaseApiFormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'attachments_ids' => ['required', 'array'],
            'attachments_ids.*' => ['required', 'integer', 'exists:tender_attachments,id'],
        ];
    }
}
