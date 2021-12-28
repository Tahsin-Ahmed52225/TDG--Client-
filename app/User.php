<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'number', 'position', 'role', 'stage', 'verification_code', 'verified'
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
    /**
     * This functions checks the roles of the user
     * @return Boolean
     */
    public function isManager()
    {
        if ($this->role == 'employee' && $this->position == 'Manager') {
            return true;
        } else {
            return false;
        }
    }
    public function isEmployee()
    {
        if ($this->role == 'employee' && $this->position != 'Manager') {
            return true;
        } else {
            return false;
        }
    }
    public function isAdmin()
    {
        if ($this->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }
    public function isClient()
    {
        if ($this->role == 'client') {
            return true;
        } else {
            return false;
        }
    }
}
