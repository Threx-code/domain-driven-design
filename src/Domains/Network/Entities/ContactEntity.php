<?php declare(strict_types=1);

namespace Domains\Network\Entities;

use App\Models\Contact;
use DateTimeInterface;
use Domains\Network\ValueObjects\EmailObject;
use Domains\Network\ValueObjects\NameObject;
use Infrastructure\Entities\DomainEntity;

final class ContactEntity extends DomainEntity
{
    public function __construct(
        public NameObject $firstName,
        public NameObject $lastName,
        public NameObject $middleName,
        public EmailObject $email,
        public null|string $phone
    ){}

    public static function fromEloquent(Contact $contact): ContactEntity
    {
        return new ContactEntity(
            firstName:  $contact->first_name,
            lastName:   $contact->last_name,
            middleName:  $contact->middle_name,
            email: $contact->email,
            phone: $contact->phone
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'middle_name' => $this->middleName,
            'email' => $this->email,
            'phone' => $this->phone
        ];
    }
}
