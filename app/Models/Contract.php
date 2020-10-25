<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Contract
 *
 * @property int $id
 * @property int $car_id
 * @property string $date
 * @property int $customer_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Car $car
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\User $user
 * @method static Builder|Contract filter($frd)
 * @method static Builder|Contract newModelQuery()
 * @method static Builder|Contract newQuery()
 * @method static Builder|Contract query()
 * @method static Builder|Contract whereCarId($value)
 * @method static Builder|Contract whereCreatedAt($value)
 * @method static Builder|Contract whereCustomerId($value)
 * @method static Builder|Contract whereDate($value)
 * @method static Builder|Contract whereId($value)
 * @method static Builder|Contract whereUpdatedAt($value)
 * @method static Builder|Contract whereUserId($value)
 * @mixin \Eloquent
 */
class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'date', 'customer_id', 'user_id'];

    public function scopeFilter(Builder $query, $frd)
    {
        foreach ($frd as $key => $value) {
            if (null === $value) {
                continue;
            }
            switch ($key) {

                case 'search':
                {
                    $query->where(function (Builder $query) use ($value): Builder {
                        return $query
                            ->whereHas('car', static function (Builder $query) use ($value): Builder {
                                return $query->where('id', $value)
                                    ->orWhere('registration_number', $value)
                                    ->orWhere('brand', 'like', '%' . $value . '%')
                                    ->orWhere('model', 'like', '%' . $value . '%')
                                    ->orWhere('year', $value)
                                    ->orWhere('price', $value);
                            })
                            ->orWhereHas('customer', static function (Builder $query) use ($value): Builder {
                                return $query->where('id', $value)
                                    ->orWhere('f_name', 'like', '%' . $value . '%')
                                    ->orWhere('l_name', 'like', '%' . $value . '%')
                                    ->orWhere('m_name', 'like', '%' . $value . '%')
                                    ->orWhere('phone', 'like', '%' . $value . '%')
                                    ->orWhere('inn', 'like', '%' . $value . '%')
                                    ->orWhere('adress', 'like', '%' . $value . '%');
                            })
                            ->orWhereHas('user', static function (Builder $query) use ($value): Builder {
                                return $query->where('id', $value)
                                    ->orWhere('f_name', 'like', '%' . $value . '%')
                                    ->orWhere('l_name', 'like', '%' . $value . '%')
                                    ->orWhere('m_name', 'like', '%' . $value . '%')
                                    ->orWhere('phone', 'like', '%' . $value . '%')
                                    ->orWhere('inn', 'like', '%' . $value . '%')
                                    ->orWhere('adress', 'like', '%' . $value . '%');
                            });
                    });
                }
            }
        }
    }

    /**
     * @return BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return int
     */
    public function getCarId(): int
    {
        return $this->car_id;
    }

    /**
     * @param int $car_id
     */
    public function setCarId(int $car_id): void
    {
        $this->car_id = $car_id;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId(int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return Car
     */
    public function getCar(): Car
    {
        return $this->car;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }


}
