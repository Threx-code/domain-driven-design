<?php declare(strict_types=1);

namespace App\Casts;

use Domains\Network\ValueObjects\EmailObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

final class Email implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return EmailObject
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): EmailObject
    {
        return new EmailObject(
            email: $value
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
