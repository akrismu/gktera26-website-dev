<?php

namespace App\Http\Helpers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Helper
{
    public static function trans_json($key, $locale = null, $default = null)
        {
            $locale = $locale ?? app()->getLocale();

            $translations = Cache::rememberForever("lang_json_{$locale}", function () use ($locale) {
                $path = lang_path("{$locale}.json");

                if (! file_exists($path)) {
                    return [];
                }

                return json_decode(file_get_contents($path), true);
            });

            return Arr::get($translations, $key, $default ?? $key);
        }
}
