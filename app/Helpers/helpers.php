<?php

declare(strict_types=1);

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
