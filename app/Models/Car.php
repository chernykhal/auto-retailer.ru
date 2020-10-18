<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable=[
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
                                ->orWhere('year', $value )
                                ->orWhere('price', $value);
                        });
                    }
                    break;
            }
        }
        return $query;
    }
}
