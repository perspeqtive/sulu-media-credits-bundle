<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu;

use BadMethodCallException;
use Sulu\Bundle\ReferenceBundle\Domain\Model\ReferenceInterface;
use Sulu\Bundle\ReferenceBundle\Domain\Repository\ReferenceRepositoryInterface;

final class MockReferenceRepository implements ReferenceRepositoryInterface
{
    /** @var iterable<array<string, mixed>> */
    public iterable $flatResultsToReturn = [];
    public ?array $requestedFilters = null;

    public function create(
        string $resourceKey,
        string $resourceId,
        string $referenceResourceKey,
        string $referenceResourceId,
        string $referenceLocale,
        string $referenceTitle,
        string $referenceContext,
        string $referenceProperty,
        array $referenceRouterAttributes = [],
    ): ReferenceInterface {
        throw new BadMethodCallException('Not implemented');
    }

    public function getOneBy(array $filters): ReferenceInterface
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function findOneBy(array $filters): ?ReferenceInterface
    {
        return null;
    }

    public function findFlatBy(array $filters = [], array $sortBys = [], array $fields = [], bool $distinct = false): iterable
    {
        $this->requestedFilters = $filters;

        return $this->flatResultsToReturn;
    }

    public function count(array $filters = [], array $distinctFields = []): int
    {
        return 0;
    }

    public function add(ReferenceInterface $reference): void
    {
    }

    public function remove(ReferenceInterface $reference): void
    {
    }

    public function removeBy(array $filters): void
    {
    }

    public function flush(): void
    {
    }
}
