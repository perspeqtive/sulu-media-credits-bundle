<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Media;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\UrlRepositoryInterface;

final class MockUrlRepository implements UrlRepositoryInterface
{
    public ?string $urlToReturn = null;
    public ?string $requestedId = null;
    public ?string $requestedLocale = null;

    public function find(string $id, string $locale): ?string
    {
        $this->requestedId = $id;
        $this->requestedLocale = $locale;

        return $this->urlToReturn;
    }
}
