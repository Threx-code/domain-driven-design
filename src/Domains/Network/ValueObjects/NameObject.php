<?php declare(strict_types=1);

namespace Domains\Network\ValueObjects;

final readonly class NameObject
{
    public function __construct(
        public string $name
    ){}

    public function __toString(): string
    {
        return $this->name ?? '';
    }

}
