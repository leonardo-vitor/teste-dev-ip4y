<?php

namespace App\Models;

use App\Enums\RegisterGender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    protected $casts = [
        'birth_date' => 'date:d/m/Y',
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
        'gender' => RegisterGender::class
    ];

}
