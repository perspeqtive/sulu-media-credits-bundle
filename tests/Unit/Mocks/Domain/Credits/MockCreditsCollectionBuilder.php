<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Credits;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\CreditsCollection;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\CreditsCollectionBuilderInterface;

final class MockCreditsCollectionBuilder implements CreditsCollectionBuilderInterface
{
    public string $requestedLocale;

    public function __construct(public CreditsCollection $collectionToReturn = new CreditsCollection())
    {
    }

    public function build(string $locale = 'de'): CreditsCollection
    {
        $this->requestedLocale = $locale;

        return $this->collectionToReturn;
    }
}
