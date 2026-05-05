<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Url;

use Exception;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\UrlRepositoryInterface;

readonly class UrlRepository implements UrlRepositoryInterface
{
    /**
     * @param iterable<UrlRepositoryByTypeInterface> $urlRepositories
     * @throws Exception
     */
    public function __construct(
        private iterable $urlRepositories
    )
    {
        foreach ($this->urlRepositories as $urlRepository) {
            if ($urlRepository instanceof UrlRepositoryByTypeInterface === true) {
                continue;
            }
            throw new Exception('All url repositories must implement UrlRepositoryByTypeInterface');
        }
    }

    public function find(string $id, string $type, string $locale): ?string
    {
        foreach($this->urlRepositories as $urlRepository) {
            if($urlRepository->isResponsible($type) === false) {
                continue;
            }
            return $urlRepository->find($id, $locale);
        }
        return null;
    }
}
