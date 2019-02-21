<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class User extends Authenticatable
{
    use EntrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

//    public function roles()
//    {
//        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
//    }
//
//    public function hasAnyRole($roles)
//    {
//        if (is_array($roles)) {
//            foreach ($roles as $role) {
//                if ($this->hasRole($role)) {
//                    return true;
//                }
//            }
//        } elseif ($this->hasRole($roles)) {
//            return true;
//        }
//        return false;
//    }
//
//    public function hasRole($role)
//    {
//        if ($this->roles()->where('name', $role)->first()) {
//            return true;
//        }
//        return false;
//    }

}
