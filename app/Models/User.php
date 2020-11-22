<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'activate',
        'surname',
        'password',
        'image_path',
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be extra added
     * @var array
     */
    protected $appends = [
        'fullName'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeQ($query, string $q)
    {
        return $query->where(function (Builder $query) use ($q) {
            $term = "%$q%";
            return $query->orWhere('name', 'like', $term);
        });
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->surname . " " . $this->name;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @param $value
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    public function setActivateAttribute($value)
    {
        if ($value === 'on') {
            $this->attributes['activate'] = true;
        } elseif ($value === true) {
            $this->attributes['activate'] = true;
        } elseif ($value === false) {
            $this->attributes['activate'] = false;
        }
    }

}
