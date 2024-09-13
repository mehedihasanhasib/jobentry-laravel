<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Front\EducationInformation;
use App\Models\Front\EmploymentInformation;
use App\Models\Front\PersonalInformation;
use App\Models\Front\TrainingInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function personalInfo()
    {
        return $this->hasOne(PersonalInformation::class);
    }
    public function educationInfo()
    {
        return $this->hasMany(EducationInformation::class);
    }
    public function trainingInfo()
    {
        return $this->hasMany(TrainingInformation::class);
    }
    public function employmentInfo()
    {
        return $this->hasMany(EmploymentInformation::class);
    }

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
