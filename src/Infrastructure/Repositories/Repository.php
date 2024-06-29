<?php declare(strict_types=1);

namespace Infrastructure\Repositories;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Entities\DomainEntity;
use Throwable;

abstract class Repository implements RepositoryInterface
{
    /**
     * @param Builder $query
     * @param DatabaseManager $database
     */
    public function __construct(
        private readonly Builder $query,
        private readonly DatabaseManager $database
    ){}

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->query->get();
    }

    /**
     *
     * @param string $id
     * @param array $with
     * @return object|null
     */
    public function find(string $id, array $with = []): null|object
    {
        return $this->query->with(
            relations: $with
        )->findOrFail(
            id: $id
        );
    }

    /**
     * @param DomainEntity $entity
     * @return void
     * @throws Throwable
     */
    public function create(DomainEntity $entity): void
    {
        $this->database->transaction(
            callback: fn () => $this->query->create(
                attributes: $entity->toArray()
            ),
            attempts: 3
        );
    }

    /**
     * @param string $id
     * @param DomainEntity $entity
     * @return void
     * @throws Throwable
     */
    public function update(string $id, DomainEntity $entity): void
    {
        $this->database->transaction(
            callback: fn () => $this->query->where(
                column: 'id',
                operator: '=',
                value: $id
            )->update(
                values: $entity->toArray()
            ),
            attempts: 3
        );
    }

    /**
     * @param string $id
     * @return void
     * @throws Throwable
     */
    public function delete(string $id): void
    {
        $this->database->transaction(
            callback: fn () => $this->query->where(
                column: 'id',
                operator: '=',
                value: $id
            ),
            attempts: 3
        );
    }
}
