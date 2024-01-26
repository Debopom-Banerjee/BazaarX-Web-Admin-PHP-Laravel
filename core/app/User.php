<?php
/**
 *
 * @category zStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use App\Models\UserInviter;
use App\Models\BankDetail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    public const KYC_PENDING = 0;
    public const KYC_APPROVED = 1;
    public const KYC_REJECTED = 2;


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

    // public function getTableColumns() {
    //     return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    // }

    public function get_roles(){
        $roles = [];
        foreach ($this->getRoleNames() as $key => $role) {
            $roles[$key] = $role;
        }

        return $roles;
    }

    public function scopeNotRole(Builder $query, $roles, $guard = null): Builder
    {
         if ($roles instanceof Collection) {
             $roles = $roles->all();
         }

         if (! is_array($roles)) {
             $roles = [$roles];
         }

         $roles = array_map(function ($role) use ($guard) {
             if ($role instanceof Role) {
                 return $role;
             }

             $method = is_numeric($role) ? 'findById' : 'findByName';
             $guard = $guard ?: $this->getDefaultGuardName();

             return $this->getRoleClass()->{$method}($role, $guard);
         }, $roles);

         return $query->whereHas('roles', function ($query) use ($roles) {
             $query->where(function ($query) use ($roles) {
                 foreach ($roles as $role) {
                     $query->where(config('permission.table_names.roles').'.id', '!=' , $role->id);
                 }
             });
         });
    }
    /**
     * Get avatar attribute with full path
     *
     * @param $value
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        $avatar = is_null($value) ? 'https://ui-avatars.com/api/?name='.$this->name.'&background=05B190&color=ffffff' : $value;
        if (Str::contains(request()->url(), '/api/v1')) {
            return asset('storage/backend/users/'.$value);
        }
        return $avatar;
    }
    public function userInviter(){
        return $this->hasOne(UserInviter::class)->latest();
    }
    public function bankDetail(){
        return $this->hasOne(BankDetail::class)->latest();
    }

    public function scopeRole(Builder $query, $roles, $guard = null): Builder
    {
        if ($roles instanceof Collection) {
            $roles = $roles->all();
        }

         if (! is_array($roles)) {
             $roles = [$roles];
         }

         $roles = array_map(function ($role) use ($guard) {
            if ($role instanceof Role) {
                return $role;
            }

            $method = is_numeric($role) ? 'findById' : 'findByName';
            $guard = $guard ?: $this->getDefaultGuardName();

            return $this->getRoleClass()->{$method}($role, $guard);
         }, $roles);

        return $query->whereHas('roles', function ($query) use ($roles) {
            $query->where(function ($query) use ($roles) {
                foreach ($roles as $role) {
                    $query->where(config('permission.table_names.roles').'.id', '=' , $role->id);
                }
            });
        });
    }

}
