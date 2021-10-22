<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Compain;

class CompainRepository
{
    Const CACHE_KEY = "COMPAINS";

    public static function all($orderBy = 'created_at')
    {
        $key = "all.{$orderBy}";
        $cacheKey = self::getCacheKey($key);

        return cache()->remember($cacheKey, Carbon::now()->addMinutes(5), function() use($orderBy) {
            return Compain::orderBy($orderBy)->get();
        });
    }

    public static function getCacheKey($key)
    {
        $key = strtoupper($key);
        return self::CACHE_KEY .".$key";
    }
}
