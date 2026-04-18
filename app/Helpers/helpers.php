<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('api_trans')) {
    /**
     * Translate the given message from the API language file.
     *
     * @return string|array|null
     */
    function api_trans(string $key, array $replace = [], ?string $locale = null)
    {
        return __('api.'.$key, $replace, $locale);
    }
}

if (! function_exists('generateSlug')) {
    function generateSlug(string $text, string $tableName, string $column = 'slug', ?int $id = null): string
    {
        $slug = Str::slug($text);
        $count = 1;
        while (DB::table($tableName)->where($column, $slug)->where('id', '!=', $id)->exists()) {
            $slug = $slug.'-'.$count;
            $count++;
        }

        return $slug;
    }

    function file_url($path)
    {
        return Storage::disk('public_uploads')->url($path);
    }
}
