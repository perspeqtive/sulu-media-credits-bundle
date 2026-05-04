<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Credits;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\MediaRepositoryInterface;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;

final class MockMediaRepository implements MediaRepositoryInterface
{
    /** @var Media[] */
    public array $mediaToReturn = [];

    public ?string $requestedLocale = null;

    public function getAllMedia(string $locale = 'de'): array
    {
        $this->requestedLocale = $locale;
        return $this->mediaToReturn;
    }
}
