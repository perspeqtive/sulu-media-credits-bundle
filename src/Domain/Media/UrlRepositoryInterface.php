<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Media;

interface UrlRepositoryInterface
{
    public function find(string $id, string $type, string $locale): ?string;
}
