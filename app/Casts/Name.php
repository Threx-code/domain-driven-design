<?php declare(strict_types=1);

namespace App\Casts;

use Domains\Network\ValueObjects\NameObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Name implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return NameObject
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): NameObject
    {
        return new NameObject(
            name: $value
        );
    }

    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return (string)$value;
    }
}
