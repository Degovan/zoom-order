<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Support\Attribute\Address;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'province',
        'district',
        'sub_district',
        'institution',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function fullAddress(): Attribute
    {
        return new Attribute(
            get: fn($value, $attr) => (string)(new Address($attr))
        );
    }

    public function sendPasswordResetNotification($token)
    {
        $email = $this->getAttribute('email');
        $this->notify(new ResetPasswordNotification($token, $email));
    }
}
