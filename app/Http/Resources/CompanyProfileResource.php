<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Assuming the 'users' relationship is loaded (taking the first user)
        $owner = $this->users->first();

        return [
            // بيانات حساب الدخول
            'owner' => [
                'name' => $owner->name ?? null,
                'username' => $owner->username ?? null,
                'email' => $owner->email ?? null,
                'phone' => $owner->phone_number ?? null, // Mapping phone_number from DB to 'phone'
            ],

            // Step 1: بيانات الشركة الأساسية
            'basic_info' => [
                'commercial_name' => $this->commercial_name,
                'commercial_registration_number' => $this->commercial_registration_number,
                'tax_number' => $this->tax_number,
                'establishment_date' => $this->establishment_date,
                'company_type_id' => $this->company_type_id,
                'company_type_name' => $this->type->name,
                'company_size' => $this->company_size,
                'legal_representative_name' => $this->legal_representative_name,
                'representative_national_id' => $this->representative_national_id,
                'representative_nationality' => $this->representative_nationality,
                'status' => $this->status,
                'status_label' => $this->status->label(),
            ],

            // Step 2: بيانات الاتصال والموقع
            'contacts_info' => [
                'primary_phone' => $this->primary_phone,
                'secondary_phone' => $this->secondary_phone,
                'official_email' => $this->official_email,
                'website' => $this->website,
            ],

            'location_info' => [
                'governorate_id' => $this->governorate_id,
                'city_id' => $this->city_id,
                'governorate_name' => $this->governorate->name,
                'city_name' => $this->city->name,
                'address' => $this->address,
                'postal_code' => $this->postal_code,
            ],

            // Step 3: الوثائق الرسمية
            'documents' => DocumentResource::collection($this->whenLoaded('documents')),

            // Step 4: التخصصات
            'activities' => ActivityResource::collection($this->whenLoaded('activities')),

            // المعلومات المالية
            'financial_info' => [
                'paid_capital' => $this->paid_capital,
                'annual_sales' => $this->annual_sales,
                'company_brief' => $this->company_brief,
            ],
        ];
    }
}
