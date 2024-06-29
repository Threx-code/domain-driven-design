<?php declare(strict_types=1);

namespace Domains\Network\Aggregates;

use Domains\Network\Entities\CompanyEntity;
use Domains\Network\Entities\ContactEntity;

final readonly class ContactAggregate
{
    public function __construct(
        private ContactEntity $contact,
        private null|CompanyEntity $company
    ){}

    public function contact(): ContactEntity
    {
        return $this->contact;
    }

    public function company(): null|CompanyEntity
    {
        return $this->company;
    }

}
