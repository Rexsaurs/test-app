<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Province extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = "user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'province_name'
    ];

    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }
}
