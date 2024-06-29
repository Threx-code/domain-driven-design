<?php declare(strict_types=1);

namespace Domains\Network\Services;

use App\Models\Contact;
use Domains\Network\Aggregates\ContactAggregate;
use Domains\Network\Entities\CompanyEntity;
use Domains\Network\Entities\ContactEntity;
use Domains\Network\Repositories\ContactRepository;
use Illuminate\Support\Collection;
use Throwable;

final readonly class ContactService
{

    public function __construct(
        private ContactRepository $repository
    ){}

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repository->all()->map(
            callback: fn (Contact $contact): ContactEntity => ContactEntity::fromEloquent(
                contact: $contact
            )
        );
    }

    /**
     * @param ContactEntity $contact
     * @return void
     * @throws Throwable
     */
    public function create(ContactEntity $contact): void
    {
         $this->repository->create(entity: $contact);
    }

    /**
     * @param ContactEntity $contact
     * @param string $id
     * @return void
     * @throws Throwable
     */
    public function update(ContactEntity $contact, string $id): void
    {
        $this->repository->update(id: $id, entity: $contact);
    }


    public function aggregate(string $id): ContactAggregate
    {
        /**
         * @var Contact $contact
         */
        $contact = $this->repository->find(
            id: $id,
            with: ['company']
        );
        return new ContactAggregate(
            contact: ContactEntity::fromEloquent(
                contact: $contact
            ),
            company: CompanyEntity::fromEloquent(
                company: $contact->company
            )
        );
    }
}
