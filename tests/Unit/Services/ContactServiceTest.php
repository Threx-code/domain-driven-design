<?php declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\Contact;
use Domains\Network\Entities\ContactEntity;
use Domains\Network\Repositories\ContactRepository;
use Domains\Network\Services\ContactService;
use Domains\Network\ValueObjects\EmailObject;
use Domains\Network\ValueObjects\NameObject;
use Illuminate\Database\DatabaseManager;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Throwable;

final class ContactServiceTest extends TestCase
{
    #[Test]
    public function it_can_get_all_contacts(): void
    {
        Contact::factory()->count(10)->create();
        $contacts = $this->service()->all();

        $this->assertCount(
            expectedCount: 10,
            haystack: $contacts
        );

        foreach ($contacts as $contact) {
            $this->assertInstanceOf(
                expected: ContactEntity::class,
                actual: $contact
            );
        }

    }


    /**
     * @throws Throwable
     */
    #[Test]
    public function it_can_create_a_contact(): void
    {
        $contact = Contact::factory()->make();
        $entity = new ContactEntity(
            firstName: new NameObject(name: 'Oluwatosin'),
            lastName: new NameObject(name: 'Ola'),
            middleName: new NameObject(name:'Jayden'),
            email: new EmailObject(email: 'oluwatosin@gmail.com'),
            phone: $contact->phone
        );

        $this->service()->create(
            contact: $entity
        );

        $this->assertDatabaseHas(
            table: 'contacts',
            data: $entity->toArray()
        );
    }

    /**
     * @throws Throwable
     */
    #[Test]
    public function it_can_update_a_contact(): void
    {
        $contact = Contact::factory()->create([
            'email' => 'another@gmail.com'
        ]);

        $entity = ContactEntity::fromEloquent(contact: $contact);
        $entity->email = new EmailObject(email: 'bode.john@gmail.com');

        $this->service()->update(
            contact: $entity,
            id: (string) $contact->id
        );

        $this->assertDatabaseHas(
            table: 'contacts',
            data: $entity->toArray()
        );

        $this->assertEquals(
            expected: $entity->email,
            actual: $contact->refresh()->email
        )
        ;
    }

    protected function service(): ContactService
    {
        return new ContactService(
            repository: new ContactRepository(
                query: Contact::query(),
                database: resolve(DatabaseManager::class)
            )
        );
    }
}
