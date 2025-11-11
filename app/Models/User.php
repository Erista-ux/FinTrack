<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'username', 'password', 'type',
        'phone', 'address', 'profile_image',
        'monthly_income', 'monthly_expense', 'total_balance', 'savings_target',
        'business_name', 'business_type', 'business_address', 'tax_id',
        'is_active', 'email_verified_at', 'last_login_at'
    ];

    protected $hidden = ['password'];
}
