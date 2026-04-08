<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreNewCompanyRequest extends BaseApiFormRequest
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
            // Step 1: بيانات الشركة الأساسية
            'basic_info' => ['required', 'array'],
            'basic_info.commercial_name' => ['required', 'string', 'max:255'],
            'basic_info.commercial_registration_number' => ['required', 'string', 'unique:companies,commercial_registration_number'],
            'basic_info.tax_number' => ['required', 'string', 'unique:companies,tax_number'],
            'basic_info.establishment_date' => ['required', 'date'],
            'basic_info.company_type_id' => ['required', 'exists:company_types,id'],
            'basic_info.company_size' => ['required', 'string'],
            'basic_info.legal_representative_name' => ['required', 'string'],
            'basic_info.representative_national_id' => ['required', 'string', 'size:14'],
            'basic_info.representative_nationality' => ['required', 'string'],

            // Step 2: بيانات الاتصال والموقع
            'contacts_info' => ['required', 'array'],
            'contacts_info.primary_phone' => ['required', 'string'],
            'contacts_info.secondary_phone' => ['nullable', 'string'],
            'contacts_info.official_email' => ['required', 'email', 'unique:companies,official_email'],
            'contacts_info.website' => ['nullable', 'url'],

            'location_info' => ['required', 'array'],
            'location_info.governorate_id' => ['required', 'exists:governorates,id'],
            'location_info.city_id' => ['required', 'exists:cities,id'],
            'location_info.address' => ['required', 'string'],
            'location_info.postal_code' => ['nullable', 'string'],

            // Step 3: الوثائق الرسمية
            'documents' => ['required', 'array'],
            'documents.*.file' => ['required', Rule::file()->types('pdf')->max(2048)],
            'documents.*.file_name' => ['required', 'string'],
            'documents.*.issue_date' => ['required', 'date'],
            'documents.*.expiry_date' => ['required', 'date', 'after:documents.*.issue_date'],

            // Step 4: التخصصات والنشاط التجاري
            'activities_ids' => ['required', 'array'],
            'activities_ids.*' => ['exists:activities,id'],

            'financial_info' => ['required', 'array'],
            'financial_info.paid_capital' => ['nullable', 'numeric'],
            'financial_info.annual_sales' => ['nullable', 'numeric'],
            'financial_info.company_brief' => ['nullable', 'string'],

            'user' => ['required', 'array'],
            'user.name' => ['required', 'string', 'max:100'],
            'user.username' => ['required', 'string', 'max:100', 'unique:users,username'],
            'user.email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'user.phone' => ['required', 'string', 'max:30', 'unique:users,phone'],
            'user.password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'basic_info.commercial_name.required' => 'اسم الشركة التجاري مطلوب',
            'basic_info.commercial_name.string' => 'اسم الشركة التجاري يجب أن يكون نصاً',
            'basic_info.commercial_name.max' => 'اسم الشركة التجاري يجب أن يكون 255 حرفاً كحد أقصى',
            'basic_info.commercial_registration_number.required' => 'رقم السجل التجاري مطلوب',
            'basic_info.commercial_registration_number.string' => 'رقم السجل التجاري يجب أن يكون نصاً',
            'basic_info.commercial_registration_number.unique' => 'رقم السجل التجاري موجود بالفعل',
            'basic_info.tax_number.required' => 'رقم الضريبة مطلوب',
            'basic_info.tax_number.string' => 'رقم الضريبة يجب أن يكون نصاً',
            'basic_info.tax_number.unique' => 'رقم الضريبة موجود بالفعل',
            'basic_info.establishment_date.required' => 'تاريخ التأسيس مطلوب',
            'basic_info.establishment_date.date' => 'تاريخ التأسيس يجب أن يكون تاريخاً',
            'basic_info.company_type_id.required' => 'نوع الشركة مطلوب',
            'basic_info.company_type_id.exists' => 'نوع الشركة غير موجود',
            'basic_info.company_size.required' => 'حجم الشركة مطلوب',
            'basic_info.company_size.string' => 'حجم الشركة يجب أن يكون نصاً',
            'basic_info.legal_representative_name.required' => 'اسم الممثل القانوني مطلوب',
            'basic_info.legal_representative_name.string' => 'اسم الممثل القانوني يجب أن يكون نصاً',
            'basic_info.representative_national_id.required' => 'رقم الهوية الوطنية للممثل مطلوب',
            'basic_info.representative_national_id.string' => 'رقم الهوية الوطنية للممثل يجب أن يكون نصاً',
            'basic_info.representative_national_id.size' => 'رقم الهوية الوطنية للممثل يجب أن يكون 14 رقماً',
            'basic_info.representative_nationality.required' => 'جنسية الممثل مطلوبة',
            'basic_info.representative_nationality.string' => 'جنسية الممثل يجب أن تكون نصاً',
            'contacts_info.primary_phone.required' => 'رقم الهاتف الأساسي مطلوب',
            'contacts_info.primary_phone.string' => 'رقم الهاتف الأساسي يجب أن يكون نصاً',
            'contacts_info.secondary_phone.required' => 'رقم الهاتف الثانوي مطلوب',
            'contacts_info.secondary_phone.string' => 'رقم الهاتف الثانوي يجب أن يكون نصاً',
            'contacts_info.official_email.required' => 'البريد الإلكتروني الرسمي مطلوب',
            'contacts_info.official_email.email' => 'البريد الإلكتروني الرسمي يجب أن يكون بريداً إلكترونياً صحيحاً',
            'contacts_info.official_email.unique' => 'البريد الإلكتروني الرسمي موجود بالفعل',
            'contacts_info.website.required' => 'الموقع الإلكتروني مطلوب',
            'contacts_info.website.url' => 'الموقع الإلكتروني يجب أن يكون رابطاً صحيحاً',
            'location_info.governorate_id.required' => 'المحافظة مطلوبة',
            'location_info.governorate_id.exists' => 'المحافظة غير موجودة',
            'location_info.city_id.required' => 'المدينة مطلوبة',
            'location_info.city_id.exists' => 'المدينة غير موجودة',
            'location_info.address.required' => 'العنوان مطلوب',
            'location_info.address.string' => 'العنوان يجب أن يكون نصاً',
            'location_info.postal_code.required' => 'الرمز البريدي مطلوب',
            'location_info.postal_code.string' => 'الرمز البريدي يجب أن يكون نصاً',
            'documents.*.file.required' => 'الملف مطلوب',
            'documents.*.file.file' => 'الملف يجب أن يكون ملفاً',
            'documents.*.file.types' => 'الملف يجب أن يكون من نوع PDF',
            'documents.*.file.max' => 'الملف يجب أن يكون 2 ميجابايت كحد أقصى',
            'documents.*.file_name.required' => 'اسم الملف مطلوب',
            'documents.*.file_name.string' => 'اسم الملف يجب أن يكون نصاً',
            'documents.*.issue_date.required' => 'تاريخ الإصدار مطلوب',
            'documents.*.issue_date.date' => 'تاريخ الإصدار يجب أن يكون تاريخاً',
            'documents.*.expiry_date.required' => 'تاريخ الانتهاء مطلوب',
            'documents.*.expiry_date.date' => 'تاريخ الانتهاء يجب أن يكون تاريخاً',
            'documents.*.expiry_date.after' => 'تاريخ الانتهاء يجب أن يكون بعد تاريخ الإصدار',
            'activities_ids.required' => 'الأنشطة مطلوبة',
            'activities_ids.array' => 'الأنشطة يجب أن تكون مصفوفة',
            'activities_ids.*.exists' => 'النشاط غير موجود',
            'financial_info.paid_capital.required' => 'رأس المال المدفوع مطلوب',
            'financial_info.paid_capital.numeric' => 'رأس المال المدفوع يجب أن يكون رقماً',
            'financial_info.annual_sales.required' => 'المبيعات السنوية مطلوبة',
            'financial_info.annual_sales.numeric' => 'المبيعات السنوية يجب أن تكون رقماً',
            'financial_info.company_brief.required' => 'نبذة عن الشركة مطلوبة',
            'financial_info.company_brief.string' => 'نبذة عن الشركة يجب أن تكون نصاً',
            'user.name.required' => 'اسم المستخدم مطلوب',
            'user.name.string' => 'اسم المستخدم يجب أن يكون نصاً',
            'user.name.max' => 'اسم المستخدم يجب أن يكون 100 حرف كحد أقصى',
            'user.username.required' => 'اسم المستخدم مطلوب',
            'user.username.string' => 'اسم المستخدم يجب أن يكون نصاً',
            'user.username.max' => 'اسم المستخدم يجب أن يكون 100 حرف كحد أقصى',
            'user.username.unique' => 'اسم المستخدم موجود بالفعل',
            'user.email.required' => 'البريد الإلكتروني مطلوب',
            'user.email.string' => 'البريد الإلكتروني يجب أن يكون نصاً',
            'user.email.email' => 'البريد الإلكتروني يجب أن يكون بريداً إلكترونياً صحيحاً',
            'user.email.max' => 'البريد الإلكتروني يجب أن يكون 100 حرف كحد أقصى',
            'user.email.unique' => 'البريد الإلكتروني موجود بالفعل',
            'user.phone.required' => 'رقم الهاتف مطلوب',
            'user.phone.string' => 'رقم الهاتف يجب أن يكون نصاً',
            'user.phone.max' => 'رقم الهاتف يجب أن يكون 30 حرفاً كحد أقصى',
            'user.phone.unique' => 'رقم الهاتف موجود بالفعل',
            'user.password.required' => 'كلمة المرور مطلوبة',
            'user.password.string' => 'كلمة المرور يجب أن تكون نصاً',
            'user.password.min' => 'كلمة المرور يجب أن تكون 8 أحرف كحد أدنى',
            'user.password.mixed_case' => 'كلمة المرور يجب أن تحتوي على أحرف كبيرة وصغيرة',
            'user.password.letters' => 'كلمة المرور يجب أن تحتوي على أحرف',
            'user.password.numbers' => 'كلمة المرور يجب أن تحتوي على أرقام',
            'user.password.symbols' => 'كلمة المرور يجب أن تحتوي على رموز',
        ];
    }
}
