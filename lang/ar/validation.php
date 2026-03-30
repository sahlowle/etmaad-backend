<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted'             => 'يجب قبول حقل :attribute.',
    'accepted_if'          => 'يجب قبول حقل :attribute عندما يكون :other هو :value.',
    'active_url'           => 'يجب أن يكون حقل :attribute رابطاً صالحاً.',
    'after'                => 'يجب أن يكون حقل :attribute تاريخاً بعد :date.',
    'after_or_equal'       => 'يجب أن يكون حقل :attribute تاريخاً بعد أو يساوي :date.',
    'alpha'                => 'يجب أن يحتوي حقل :attribute على أحرف فقط.',
    'alpha_dash'           => 'يجب أن يحتوي حقل :attribute على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num'            => 'يجب أن يحتوي حقل :attribute على أحرف وأرقام فقط.',
    'any_of'               => 'حقل :attribute غير صالح.',
    'array'                => 'يجب أن يكون حقل :attribute مصفوفة.',
    'ascii'                => 'يجب أن يحتوي حقل :attribute على أحرف أحادية البايت ورموز فقط.',
    'before'               => 'يجب أن يكون حقل :attribute تاريخاً قبل :date.',
    'before_or_equal'      => 'يجب أن يكون حقل :attribute تاريخاً قبل أو يساوي :date.',
    'between'              => [
        'array'   => 'يجب أن يحتوي حقل :attribute على ما بين :min و :max عناصر.',
        'file'    => 'يجب أن يكون حجم ملف :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'string'  => 'يجب أن يكون طول :attribute بين :min و :max أحرف.',
    ],
    'boolean'              => 'يجب أن تكون قيمة حقل :attribute صحيحة أو خاطئة.',
    'can'                  => 'يحتوي حقل :attribute على قيمة غير مصرح بها.',
    'confirmed'            => 'تأكيد حقل :attribute غير متطابق.',
    'contains'             => 'حقل :attribute يفتقر إلى قيمة مطلوبة.',
    'current_password'     => 'كلمة المرور غير صحيحة.',
    'date'                 => 'يجب أن يكون حقل :attribute تاريخاً صالحاً.',
    'date_equals'          => 'يجب أن يكون حقل :attribute تاريخاً مساوياً لـ :date.',
    'date_format'          => 'يجب أن يتطابق حقل :attribute مع الصيغة :format.',
    'decimal'              => 'يجب أن يحتوي حقل :attribute على :decimal خانة عشرية.',
    'declined'             => 'يجب رفض حقل :attribute.',
    'declined_if'          => 'يجب رفض حقل :attribute عندما يكون :other هو :value.',
    'different'            => 'يجب أن يكون حقل :attribute مختلفاً عن :other.',
    'digits'               => 'يجب أن يتكون حقل :attribute من :digits أرقام.',
    'digits_between'       => 'يجب أن يتكون حقل :attribute من بين :min و :max أرقام.',
    'dimensions'           => 'أبعاد الصورة في حقل :attribute غير صالحة.',
    'distinct'             => 'يحتوي حقل :attribute على قيمة مكررة.',
    'doesnt_contain'       => 'يجب ألا يحتوي حقل :attribute على أي مما يلي: :values.',
    'doesnt_end_with'      => 'يجب ألا ينتهي حقل :attribute بأحد القيم التالية: :values.',
    'doesnt_start_with'    => 'يجب ألا يبدأ حقل :attribute بأحد القيم التالية: :values.',
    'email'                => 'يجب أن يكون حقل :attribute عنوان بريد إلكتروني صالحاً.',
    'encoding'             => 'يجب أن يكون حقل :attribute مشفراً بـ :encoding.',
    'ends_with'            => 'يجب أن ينتهي حقل :attribute بأحد القيم التالية: :values.',
    'enum'                 => 'القيمة المحددة لـ :attribute غير صالحة.',
    'exists'               => 'القيمة المحددة لـ :attribute غير صالحة.',
    'extensions'           => 'يجب أن يكون لملف :attribute أحد الامتدادات التالية: :values.',
    'file'                 => 'يجب أن يكون حقل :attribute ملفاً.',
    'filled'               => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'gt'                   => [
        'array'   => 'يجب أن يحتوي حقل :attribute على أكثر من :value عناصر.',
        'file'    => 'يجب أن يكون حجم ملف :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'string'  => 'يجب أن يكون طول :attribute أكبر من :value أحرف.',
    ],
    'gte'                  => [
        'array'   => 'يجب أن يحتوي حقل :attribute على :value عناصر أو أكثر.',
        'file'    => 'يجب أن يكون حجم ملف :attribute أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من أو تساوي :value.',
        'string'  => 'يجب أن يكون طول :attribute أكبر من أو يساوي :value أحرف.',
    ],
    'hex_color'            => 'يجب أن يكون حقل :attribute لوناً سداسياً عشرياً صالحاً.',
    'image'                => 'يجب أن يكون حقل :attribute صورة.',
    'in'                   => 'القيمة المحددة لـ :attribute غير صالحة.',
    'in_array'             => 'يجب أن توجد قيمة حقل :attribute ضمن :other.',
    'in_array_keys'        => 'يجب أن يحتوي حقل :attribute على مفتاح واحد على الأقل من التالية: :values.',
    'integer'              => 'يجب أن يكون حقل :attribute عدداً صحيحاً.',
    'ip'                   => 'يجب أن يكون حقل :attribute عنوان IP صالحاً.',
    'ipv4'                 => 'يجب أن يكون حقل :attribute عنوان IPv4 صالحاً.',
    'ipv6'                 => 'يجب أن يكون حقل :attribute عنوان IPv6 صالحاً.',
    'json'                 => 'يجب أن يكون حقل :attribute نصاً بصيغة JSON صالحة.',
    'list'                 => 'يجب أن يكون حقل :attribute قائمة.',
    'lowercase'            => 'يجب أن يكون حقل :attribute بأحرف صغيرة.',
    'lt'                   => [
        'array'   => 'يجب أن يحتوي حقل :attribute على أقل من :value عناصر.',
        'file'    => 'يجب أن يكون حجم ملف :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أقل من :value.',
        'string'  => 'يجب أن يكون طول :attribute أقل من :value أحرف.',
    ],
    'lte'                  => [
        'array'   => 'يجب ألا يحتوي حقل :attribute على أكثر من :value عناصر.',
        'file'    => 'يجب أن يكون حجم ملف :attribute أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أقل من أو تساوي :value.',
        'string'  => 'يجب أن يكون طول :attribute أقل من أو يساوي :value أحرف.',
    ],
    'mac_address'          => 'يجب أن يكون حقل :attribute عنوان MAC صالحاً.',
    'max'                  => [
        'array'   => 'يجب ألا يحتوي حقل :attribute على أكثر من :max عناصر.',
        'file'    => 'يجب ألا يتجاوز حجم ملف :attribute :max كيلوبايت.',
        'numeric' => 'يجب ألا تتجاوز قيمة :attribute :max.',
        'string'  => 'يجب ألا يتجاوز طول :attribute :max أحرف.',
    ],
    'max_digits'           => 'يجب ألا يحتوي حقل :attribute على أكثر من :max أرقام.',
    'mimes'                => 'يجب أن يكون حقل :attribute ملفاً من النوع: :values.',
    'mimetypes'            => 'يجب أن يكون حقل :attribute ملفاً من النوع: :values.',
    'min'                  => [
        'array'   => 'يجب أن يحتوي حقل :attribute على :min عناصر على الأقل.',
        'file'    => 'يجب ألا يقل حجم ملف :attribute عن :min كيلوبايت.',
        'numeric' => 'يجب ألا تقل قيمة :attribute عن :min.',
        'string'  => 'يجب ألا يقل طول :attribute عن :min أحرف.',
    ],
    'min_digits'           => 'يجب أن يحتوي حقل :attribute على :min أرقام على الأقل.',
    'missing'              => 'يجب أن يكون حقل :attribute غائباً.',
    'missing_if'           => 'يجب أن يكون حقل :attribute غائباً عندما يكون :other هو :value.',
    'missing_unless'       => 'يجب أن يكون حقل :attribute غائباً ما لم يكن :other هو :value.',
    'missing_with'         => 'يجب أن يكون حقل :attribute غائباً عند وجود :values.',
    'missing_with_all'     => 'يجب أن يكون حقل :attribute غائباً عند وجود :values.',
    'multiple_of'          => 'يجب أن تكون قيمة حقل :attribute من مضاعفات :value.',
    'not_in'               => 'القيمة المحددة لـ :attribute غير صالحة.',
    'not_regex'            => 'صيغة حقل :attribute غير صالحة.',
    'numeric'              => 'يجب أن يكون حقل :attribute رقماً.',
    'password'             => [
        'letters'       => 'يجب أن يحتوي حقل :attribute على حرف واحد على الأقل.',
        'mixed'         => 'يجب أن يحتوي حقل :attribute على حرف كبير وحرف صغير على الأقل.',
        'numbers'       => 'يجب أن يحتوي حقل :attribute على رقم واحد على الأقل.',
        'symbols'       => 'يجب أن يحتوي حقل :attribute على رمز واحد على الأقل.',
        'uncompromised' => 'ظهر حقل :attribute المُدخَل في تسريب بيانات. يرجى اختيار قيمة مختلفة.',
    ],
    'present'              => 'يجب أن يكون حقل :attribute موجوداً.',
    'present_if'           => 'يجب أن يكون حقل :attribute موجوداً عندما يكون :other هو :value.',
    'present_unless'       => 'يجب أن يكون حقل :attribute موجوداً ما لم يكن :other هو :value.',
    'present_with'         => 'يجب أن يكون حقل :attribute موجوداً عند وجود :values.',
    'present_with_all'     => 'يجب أن يكون حقل :attribute موجوداً عند وجود :values.',
    'prohibited'           => 'حقل :attribute محظور.',
    'prohibited_if'        => 'حقل :attribute محظور عندما يكون :other هو :value.',
    'prohibited_if_accepted' => 'حقل :attribute محظور عند قبول :other.',
    'prohibited_if_declined' => 'حقل :attribute محظور عند رفض :other.',
    'prohibited_unless'    => 'حقل :attribute محظور ما لم يكن :other ضمن :values.',
    'prohibits'            => 'حقل :attribute يمنع وجود :other.',
    'regex'                => 'صيغة حقل :attribute غير صالحة.',
    'required'             => 'حقل :attribute مطلوب.',
    'required_array_keys'  => 'يجب أن يحتوي حقل :attribute على مدخلات لـ: :values.',
    'required_if'          => 'حقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_if_accepted' => 'حقل :attribute مطلوب عند قبول :other.',
    'required_if_declined' => 'حقل :attribute مطلوب عند رفض :other.',
    'required_unless'      => 'حقل :attribute مطلوب ما لم يكن :other ضمن :values.',
    'required_with'        => 'حقل :attribute مطلوب عند وجود :values.',
    'required_with_all'    => 'حقل :attribute مطلوب عند وجود :values.',
    'required_without'     => 'حقل :attribute مطلوب عند غياب :values.',
    'required_without_all' => 'حقل :attribute مطلوب عند غياب جميع :values.',
    'same'                 => 'يجب أن يتطابق حقل :attribute مع :other.',
    'size'                 => [
        'array'   => 'يجب أن يحتوي حقل :attribute على :size عناصر.',
        'file'    => 'يجب أن يكون حجم ملف :attribute :size كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute :size.',
        'string'  => 'يجب أن يكون طول :attribute :size أحرف.',
    ],
    'starts_with'          => 'يجب أن يبدأ حقل :attribute بأحد القيم التالية: :values.',
    'string'               => 'يجب أن يكون حقل :attribute نصاً.',
    'timezone'             => 'يجب أن يكون حقل :attribute منطقة زمنية صالحة.',
    'unique'               => 'قيمة :attribute مستخدمة مسبقاً.',
    'uploaded'             => 'فشل رفع :attribute.',
    'uppercase'            => 'يجب أن يكون حقل :attribute بأحرف كبيرة.',
    'url'                  => 'يجب أن يكون حقل :attribute رابطاً صالحاً.',
    'ulid'                 => 'يجب أن يكون حقل :attribute ULID صالحاً.',
    'uuid'                 => 'يجب أن يكون حقل :attribute UUID صالحاً.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [],

];