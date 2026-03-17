<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Tender;

use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

final class UploadTenderAttachmentRequest extends BaseApiFormRequest
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
            'attachments' => ['required', 'array','max:3'],
            'attachments.*' => [
                'required',
                Rule::file()
                    ->types(['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'])
                    ->max(2048) // 2MB (Value is in kilobytes: 2 * 1024 = 2048)
            ],
        ];
    }
}
