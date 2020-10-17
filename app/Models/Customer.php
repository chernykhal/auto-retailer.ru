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
}
