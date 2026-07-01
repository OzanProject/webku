<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function group($group)
    {
        return self::where('group', $group)->pluck('value', 'key')->map(function ($item) {
            return $item; // Can cast JSON here if needed
        })->toArray();
    }
}
