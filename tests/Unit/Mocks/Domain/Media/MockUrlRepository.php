<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Media;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\UrlRepositoryInterface;

final class MockUrlRepository implements UrlRepositoryInterface
{
    public ?string $requestedId = null;
    public ?string $requestedType = null;
    public ?string $requestedLocale = null;
    public function __construct(public ?string $urlToReturn = null) {}

    public function find(string $id, string $type, string $locale): ?string
    {
        $this->requestedId = $id;
        $this->requestedType = $type;
        $this->requestedLocale = $locale;

        return $this->urlToReturn;
    }
}
