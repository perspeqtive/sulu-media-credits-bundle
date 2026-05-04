<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Credits;

interface CreditsCollectionBuilderInterface
{
    public function build(string $locale = 'de'): CreditsCollection;
}
