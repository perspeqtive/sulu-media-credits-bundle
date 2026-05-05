<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Url;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Url\UrlRepositoryByTypeInterface;

class MockUrlRepositoryByType implements UrlRepositoryByTypeInterface
{

    public function __construct(public array $urlsToReturn = [], public bool $isResponsible = true) {}

    public function find(string $id, string $locale): ?string
    {
        return $this->urlsToReturn[$id] ?? null;
    }

    public function isResponsible(string $type): bool
    {
        return $this->isResponsible;
    }
}