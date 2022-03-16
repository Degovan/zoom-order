<?php

namespace App\Service;

use App\Models\User;

class AccountService
{
    public static function isComplete(User $user): bool
    {
        return static::check(
            $user->name,
            $user->email,
            $user->province,
            $user->district,
            $user->sub_district,
            $user->institution,
            $user->phone,
        );
    }

    private static function check(...$params): bool
    {
        $result = [];

        foreach($params as $param) {
            $result[] = match(gettype($param)) {
                'string' => strlen($param) > 1 ? true : false,
                'NULL' => false
            };
        }

        return in_array(false, $result) ? false : true;
    }
}
