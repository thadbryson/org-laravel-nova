<?php

declare(strict_types = 1);

namespace App\Models\User;

use Carbon\Carbon;
use Data\BaseModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Tool\Str;

/**
 * Class User
 *
 * @property string                                                                                                         $name
 * @property string                                                                                                         $email
 * @property string                                                                                                         $password
 * @property Carbon                                                                                                         $email_verified_at
 * @property int                                                                                                            $id
 * @property string|null                                                                                                    $remember_token
 * @property string                                                                                                         $theme
 * @property string                                                                                                         $api_token
 * @property \Illuminate\Support\Carbon|null                                                                                $created_at
 * @property \Illuminate\Support\Carbon|null                                                                                $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsernewModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsernewQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Userpermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Userquery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Userrole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserwhereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserwhereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserwhereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserwhereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserwhereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserwherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserwhereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserwhereUpdatedAt($value)
 * @method static self create(array $attributes)
 * @mixin \Eloquent
 *
 * @method static User\Repository repository()
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable,
        Authorizable,
        CanResetPassword,
        MustVerifyEmail,
        Notifiable;

    protected $attributes = [
        'name'  => '',
        'email' => '',
        'theme' => 'Default'
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        'email_verified_at'
    ];

    private $guard_name = 'web';

    /**
     * Change and set User's api_token.
     *
     * @return string
     */
    public function formSetToken(): string
    {
        $this->api_token = hash('sha256', Str::random(60)->get());

        return $this->saveThis()->api_token;
    }

    /**
     * Is $token the current User's api_token?
     *
     * @param string $token
     * @return bool
     */
    public function isToken(string $token): bool
    {
        return $this->api_token === $token;
    }
}
