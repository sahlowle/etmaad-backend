<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Tender;

use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

final class StoreTenderRequest extends BaseApiFormRequest
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
            // Main Tender Fields
            'tender' => ['required', 'array'],
            'tender.name' => ['required', 'string', 'max:255'],
            'tender.tender_number' => ['required', 'string', 'max:255'],
            'tender.reference_number' => ['nullable', 'string', 'max:255'],
            'tender.purpose' => ['required', 'string'],
            'tender.booklet_price' => ['nullable', 'numeric', 'min:0'],
            'tender.status' => ['required', 'string', 'max:255'],
            'tender.execution_duration' => ['nullable', 'string', 'max:255'],
            'tender.requires_insurance' => ['required', 'boolean'],
            'tender.type' => ['required', 'string', 'max:255'],
            'tender.tendering_status' => ['required', 'string', 'max:255'],
            'tender.government_entity' => ['nullable', 'string', 'max:255'],
            'tender.submission_method' => ['required', 'string', 'max:255'],
            'tender.requires_initial_guarantee' => ['required', 'boolean'],
            'tender.initial_guarantee_address' => ['nullable', 'string', 'max:255'],
            'tender.final_guarantee_percentage' => ['nullable', 'string', 'max:255'],

            // Addresses & Dates (Tab 2)
            'addresses_dates' => ['required', 'array'],
            'addresses_dates.inquiries_deadline' => ['required', 'date'],
            'addresses_dates.offers_deadline' => ['required', 'date'],
            'addresses_dates.offers_opening_date' => ['required', 'date'],
            'addresses_dates.offers_examination_date' => ['nullable', 'date'],
            'addresses_dates.evaluation_duration_days' => ['nullable', 'integer', 'min:1'],
            'addresses_dates.expected_award_date' => ['nullable', 'date'],
            'addresses_dates.execution_start_date' => ['nullable', 'date'],
            'addresses_dates.qa_start_date' => ['nullable', 'date'],
            'addresses_dates.qa_response_deadline' => ['nullable', 'date'],
            'addresses_dates.offers_opening_location' => ['nullable', 'string', 'max:255'],
            'addresses_dates.opening_committee_members' => ['nullable', 'string'],

            // Classification (Tab 3)
            'classification' => ['required', 'array'],
            'classification.classification_area' => ['nullable', 'string', 'max:255'],
            'classification.execution_location' => ['nullable', 'string', 'max:255'],
            'classification.details' => ['nullable', 'string'],
            'classification.scope' => ['nullable', 'string', 'max:255'],
            'classification.includes_supply' => ['nullable', 'boolean'],
            'classification.includes_maintenance' => ['nullable', 'boolean'],

            // BOQs (Tab 4) - Array of Objects
            'boqs' => ['nullable', 'array'],
            'boqs.*.table_name' => ['nullable', 'string', 'max:255'],
            'boqs.*.serial_number' => ['required', 'integer', 'min:1'],
            'boqs.*.category' => ['required', 'string', 'max:255'],
            'boqs.*.item_name' => ['required', 'string', 'max:255'],
            'boqs.*.unit' => ['required', 'string', 'max:255'],
            'boqs.*.quantity' => ['required', 'numeric', 'min:0'],
            'boqs.*.description' => ['nullable', 'string'],
            'boqs.*.specifications' => ['nullable', 'string'],
            'boqs.*.is_mandatory_list_product' => ['boolean'],

            // Attachments (Tab 5) - Array of Objects
            'attachments' => ['nullable', 'array', 'max:3'],
            'attachments.*' => [
                'required',
                Rule::file()
                    ->types(['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'])
                    ->max(2048), // 2MB (Value is in kilobytes: 2 * 1024 = 2048)
            ],

            // News (Tab 6)
            'news' => ['nullable', 'array'],
            'news.creation_date' => ['nullable', 'date'],
            'news.updated_offers_opening_date' => ['nullable', 'date'],
            'news.extension_notes' => ['nullable', 'string'],
            'news.actual_award_date' => ['nullable', 'date'],

            // Evaluation (Tab 7)
            'evaluation' => ['required', 'array'],
            'evaluation.tech_level_1' => ['nullable', 'string', 'max:255'],
            'evaluation.tech_level_2' => ['nullable', 'string', 'max:255'],
            'evaluation.tech_level_3' => ['nullable', 'string', 'max:255'],
            'evaluation.technical_weight' => ['required', 'integer', 'min:0', 'max:100'],
            'evaluation.fin_level_1' => ['nullable', 'string', 'max:255'],
            'evaluation.fin_level_2' => ['nullable', 'string', 'max:255'],
            'evaluation.fin_level_3' => ['nullable', 'string', 'max:255'],
            'evaluation.financial_weight' => ['required', 'integer', 'min:0', 'max:100'],
        ];
    }
}
