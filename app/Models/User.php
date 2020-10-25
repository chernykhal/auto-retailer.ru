<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
 * @method static Builder|User filter($frd)
 * @property-read \App\Models\WorkDays|null $workDays
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

    /**
     * @param Builder $query
     * @param array $frd
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $frd): Builder
    {
        foreach ($frd as $key => $value) {
            if (null === $value) {
                continue;
            }
            switch ($key) {
                case 'search':
                    {
                        $query->where(function (Builder $query) use ($value): Builder {
                            return $query->orWhere('id', $value)
                                ->orWhere('f_name', 'like', '%' . $value . '%')
                                ->orWhere('l_name', 'like', '%' . $value . '%')
                                ->orWhere('m_name', 'like', '%' . $value . '%')
                                ->orWhere('phone', 'like', '%' . $value . '%')
                                ->orWhere('inn', 'like', '%' . $value . '%')
                                ->orWhere('adress', 'like', '%' . $value . '%');
                        });
                    }
                    break;
            }
        }
        return $query;
    }

    /**
     * @return HasOne
     */
    public function workDays(): HasOne
    {
        return $this->hasOne(WorkDays::class);
    }

    public static function getList()
    {
        return self::select('f_name', 'l_name', 'm_name', 'id')
            ->orderbyDesc('id')
            ->pluck('l_name', 'id')
            ->toArray();
    }

    /**
     * @return int
     */
    public function getInn(): int
    {
        return $this->inn;
    }

    /**
     * @param int $inn
     */
    public function setInn(int $inn): void
    {
        $this->inn = $inn;
    }

    /**
     * @return string
     */
    public function getFName(): string
    {
        return $this->f_name;
    }

    /**
     * @param string $f_name
     */
    public function setFName(string $f_name): void
    {
        $this->f_name = $f_name;
    }

    /**
     * @return string
     */
    public function getLName(): string
    {
        return $this->l_name;
    }

    /**
     * @param string $l_name
     */
    public function setLName(string $l_name): void
    {
        $this->l_name = $l_name;
    }

    /**
     * @return string
     */
    public function getMName(): string
    {
        return $this->m_name;
    }

    /**
     * @param string $m_name
     */
    public function setMName(string $m_name): void
    {
        $this->m_name = $m_name;
    }

    /**
     * @return string|null
     */
    public function getEmployDate(): ?string
    {
        return $this->employ_date;
    }

    /**
     * @param string|null $employ_date
     */
    public function setEmployDate(?string $employ_date): void
    {
        $this->employ_date = $employ_date;
    }

    /**
     * @return string|null
     */
    public function getEmployDocumentDate(): ?string
    {
        return $this->employ_document_date;
    }

    /**
     * @param string|null $employ_document_date
     */
    public function setEmployDocumentDate(?string $employ_document_date): void
    {
        $this->employ_document_date = $employ_document_date;
    }

    /**
     * @return int|null
     */
    public function getEmployDocumentNumber(): ?int
    {
        return $this->employ_document_number;
    }

    /**
     * @param int|null $employ_document_number
     */
    public function setEmployDocumentNumber(?int $employ_document_number): void
    {
        $this->employ_document_number = $employ_document_number;
    }

    /**
     * @return int|null
     */
    public function getDepartmentId(): ?int
    {
        return $this->department_id;
    }

    /**
     * @param int|null $department_id
     */
    public function setDepartmentId(?int $department_id): void
    {
        $this->department_id = $department_id;
    }

    /**
     * @return int|null
     */
    public function getSalary(): ?int
    {
        return $this->salary;
    }

    /**
     * @param int|null $salary
     */
    public function setSalary(?int $salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return string|null
     */
    public function getAdress(): ?string
    {
        return $this->adress;
    }

    /**
     * @param string|null $adress
     */
    public function setAdress(?string $adress): void
    {
        $this->adress = $adress;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }


}
