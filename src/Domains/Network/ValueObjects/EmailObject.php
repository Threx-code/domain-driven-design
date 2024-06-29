<?php declare(strict_types=1);

namespace Domains\Network\ValueObjects;

use App\Casts\Email;

final readonly class EmailObject
{
    public null|string $email;
    public function __construct(null|string $email)
    {
        if(null === $email) {
            $this->email = $email;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email = $email;
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }
}
