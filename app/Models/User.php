<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\User
 *
 * @property int $id
 * @property int $inn
 * @property string $f_name
 * @property string $l_name
 * @property string $m_name
 * @property string|null $employ_date
 * @property string|null $employ_document_date
 * @property int|null $employ_document_number
 * @property int|null $department_id
 * @property int|null $salary
 * @property string|null $adress
 * @property string $phone
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Team $currentTeam
 * @property-read string $profile_photo_url
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Team[] $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @property-read Collection|Team[] $teams
 * @property-read int|null $teams_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User orWherePermissionIs($permission = '')
 * @method static Builder|User orWhereRoleIs($role = '', $team = null)
 * @method static Builder|User query()
 * @method static Builder|User whereAdress($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDepartmentId($value)
 * @method static Builder|User whereDoesntHavePermission()
 * @method static Builder|User whereDoesntHaveRole()
 * @method static Builder|User whereEmployDate($value)
 * @method static Builder|User whereEmployDocumentDate($value)
 * @method static Builder|User whereEmployDocumentNumber($value)
 * @method static Builder|User whereFName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereInn($value)
 * @method static Builder|User whereLName($value)
 * @method static Builder|User whereMName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePermissionIs($permission = '', $boolean = 'and')
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRoleIs($role = '', $team = null, $boolean = 'and')
 * @method static Builder|User whereSalary($value)
 * @method static Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static Builder|User whereTwoFactorSecret($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'm_name',
        'password',
        'inn',
        'phone',
        'employ_date',
        'employ_document_date',
        'employ_document_number',
        'department_id',
        'salary',
        'adress',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
