<?php


namespace App\Support\Concerns;


use Illuminate\Support\Str;

/**
 * Generates unique key.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
trait GeneratesUniqueKey
{
    /**
     * Generate unique key.
     *
     * @param int $length
     *
     * @return string
     */
    public static function generateKey(int $length = 16): string
    {
        $key = Str::random($length);

        while (self::where(['key' => $key])->exists()) {
            $key = Str::random($length);
        }

        return $key;
    }
}
