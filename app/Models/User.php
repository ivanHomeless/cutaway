<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;
use Eloquent;

/**
 * Class User
 * @property  integer $id
 * @property  string $username
 * @property  string $password
 * @property  string $email
 * @property  string $hash
 * @property  integer $status
 * @property  integer $role
 * @property  integer $remember_token
 * @property  integer $created_at
 * @property  integer $updated_at
 * @property  integer $deleted_at
 * @property  integer $isAdmin
 *
 * @property  Profile $profile
 * @package App\Models
 * @mixin Eloquent
 *
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     *  Users roles
     */
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    /**
     * Users statuses
     */
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'hash',
        'username',
        'role',
        'status',
    ];

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check admin role
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return static::ROLE_ADMIN == $this->role;
    }

    /**
     * Get user roles
     *
     * @return array
     */
    public static function getUserRoles()
    {
        return [
            User::ROLE_ADMIN => 'Администратор',
            User::ROLE_USER => 'Пользователь',
        ];
    }

    /**
     * Get user statuses
     *
     * @return array
     */
    public static function getUserStatuses()
    {
        return [
            User::STATUS_INACTIVE => 'Неактивен',
            User::STATUS_ACTIVE => 'Активен',
        ];
    }

    /**
     * Find user by hash
     * @param string $hash
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|User
     */

    public static function findByHash($hash) {
        return User::select()->where(['hash' => $hash])->first();
    }

    /**
     * Find user by username
     *
     * @param string $username
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|User
     */
    public static function findByUsername($username) {
        return User::select()->where(['username' => $username])->first();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
