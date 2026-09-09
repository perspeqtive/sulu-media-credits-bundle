<?php

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu;

use Sulu\Route\Domain\Model\Route;
use Sulu\Route\Domain\Repository\RouteRepositoryInterface;

class MockRouteRepository implements RouteRepositoryInterface
{

    public function __construct(public ?Route $result = null) {}

    public function add(Route $route): void
    {
        // TODO: Implement add() method.
    }

    public function remove(Route $route): void
    {
        // TODO: Implement remove() method.
    }

    public function findOneBy(array $filters): ?Route
    {
        return $this->result;
    }

    public function getOneBy(array $filters): Route
    {
        // TODO: Implement getOneBy() method.
    }

    public function findFirstBy(array $filters, array $sortBys = []): ?Route
    {
        // TODO: Implement findFirstBy() method.
    }

    public function existBy(array $filters): bool
    {
        // TODO: Implement existBy() method.
    }

    public function findBy(array $filters, array $sortBys = []): iterable
    {
        // TODO: Implement findBy() method.
    }
}