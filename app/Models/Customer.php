<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property int $inn
 * @property string $f_name
 * @property string $l_name
 * @property string $m_name
 * @property string|null $adress
 * @property string $phone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer query()
 * @method static Builder|Customer whereAdress($value)
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereFName($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereInn($value)
 * @method static Builder|Customer whereLName($value)
 * @method static Builder|Customer whereMName($value)
 * @method static Builder|Customer wherePhone($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static Builder|Customer filter($frd)
 */
class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'f_name',
        'l_name',
        'm_name',
        'inn',
        'adress',
        'phone'
    ];

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
     * @return int
     */
    public function getInn(): int
    {
        return $this->inn;
    }

    /**
     * @return string
     */
    public function getFName(): string
    {
        return $this->f_name;
    }

    /**
     * @return string
     */
    public function getLName(): string
    {
        return $this->l_name;
    }

    /**
     * @return string
     */
    public function getMName(): string
    {
        return $this->m_name;
    }

    /**
     * @return string|null
     */
    public function getAdress(): ?string
    {
        return $this->adress;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }



}
