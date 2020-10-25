<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Car
 *
 * @property int $id
 * @property int $registration_number
 * @property string $brand
 * @property string $model
 * @property string $year
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Contract|null $contract
 * @method static Builder|Car filter($frd)
 * @method static Builder|Car newModelQuery()
 * @method static Builder|Car newQuery()
 * @method static Builder|Car query()
 * @method static Builder|Car whereBrand($value)
 * @method static Builder|Car whereCreatedAt($value)
 * @method static Builder|Car whereId($value)
 * @method static Builder|Car whereModel($value)
 * @method static Builder|Car wherePrice($value)
 * @method static Builder|Car whereRegistrationNumber($value)
 * @method static Builder|Car whereUpdatedAt($value)
 * @method static Builder|Car whereYear($value)
 * @mixin \Eloquent
 */
class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'brand',
        'model',
        'year',
        'price',
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
                                ->orWhere('registration_number', $value)
                                ->orWhere('brand', 'like', '%' . $value . '%')
                                ->orWhere('model', 'like', '%' . $value . '%')
                                ->orWhere('year', $value)
                                ->orWhere('price', $value);
                        });
                    }
                    break;
            }
        }
        return $query;
    }

    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class);
    }

    public static function getList()
    {
        return self::select('brand', 'model', 'id')
            ->orderbyDesc('id')
            ->pluck('model', 'id')
            ->toArray();
    }

    /**
     * @return int
     */
    public function getRegistrationNumber(): int
    {
        return $this->registration_number;
    }

    /**
     * @param int $registration_number
     */
    public function setRegistrationNumber(int $registration_number): void
    {
        $this->registration_number = $registration_number;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }


}
