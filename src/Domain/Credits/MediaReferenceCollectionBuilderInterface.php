<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Credits;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollection;

interface MediaReferenceCollectionBuilderInterface
{
    public function build($media): MediaReferenceCollection;
}