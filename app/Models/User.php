<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    /**
     * Get the user's level.
     *
     * @return int
     */
    public function getLevelAttribute()
    {
        return $this->getLowestRoleLevel();
    }

    /**
     * Returns the user's minimum role level.
     *
     * @return int
     */
    public function getLowestRoleLevel()
    {
        $roles = $this->roles;

        if ($roles->isEmpty()) {
            return 32767;
        }

        return $roles->min('level');
    }

    /**
     * Check if the user is superadmin.
     *
     * @return boolean
     */
    public function isSuperAdmin(): bool
    {
        return $this->getLevelAttribute() <= Role::SUPER_ADMIN_LEVEL;
    }

    /**
     * Check if the user is admin.
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->getLevelAttribute() <= Role::ADMINISTRADOR_LEVEL;
    }
}
