<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Laratrust\Models\LaratrustRole;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static Builder|Role filter($frd)
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereDescription($value)
 * @method static Builder|Role whereDisplayName($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Role extends LaratrustRole
{
    public $guarded = [];

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
                                ->orWhere('name', 'like', '%' . $value . '%')
                                ->orWhere('display_name', 'like', '%' . $value . '%');
                        });
                    }
                    break;
            }
        }
        return $query;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->display_name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }


}
