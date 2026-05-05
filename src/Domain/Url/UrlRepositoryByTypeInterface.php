<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Url;

interface UrlRepositoryByTypeInterface
{
    public function find(string $id, string $locale): ?string;

    public function isResponsible(string $type): bool;
}
