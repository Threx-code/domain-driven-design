<?php declare(strict_types=1);

namespace Infrastructure\Repositories;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Entities\DomainEntity;


/**
 * @property-read DatabaseManager $databaseManager
 * @property-read Builder $query
 */
interface RepositoryInterface
{
    public function all(): Collection;
    public function find(string $id, array $with = []): ?object;
    public function create(DomainEntity $entity): void;
    public function update(string $id, DomainEntity $entity): void;
    public function delete(string $id): void;
}
