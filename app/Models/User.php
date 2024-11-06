<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_number',
        'profile_image',
        'role', // Add the 'role' attribute
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
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 0;
    }

    /**
     * Check if the user is a moderator.
     *
     * @return bool
     */
    public function isModerator()
    {
        return $this->role === 1;
    }

    /**
     * Check if the user is a normal user.
     *
     * @return bool
     */
    public function isNormalUser()
    {
        return $this->role === 2;
    }
}
