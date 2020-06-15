<?php

namespace Modules\Lecturer\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'department_id',
        'admin_id',
        'staffID',
        'staff_type_id',
        'staff_category_id',
        'employed_at',
        'real_pass'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function admin()
    {
        return $this->belongsTo('Modules\Admin\Entities\Admin');
    }
    public function staffCategory()
    {
    	return $this->belongsTo(StaffCategory::class);
    }

    public function staffType()
    {
        return $this->belongsTo(StaffType::class);
    }

    public function profile()
    {
    	return $this->hasOne(Profile::class);
    }

    public function staffPositions()
    {
        return $this->hasMany(StaffPosition::class);
    }

    public function lecturer()
    {
        return $this->hasOne(Lecturer::class);
    }
}

    