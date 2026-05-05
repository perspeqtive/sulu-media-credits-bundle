<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Url;

use Exception;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Url\UrlRepositoryByTypeInterface;
use Sulu\Bundle\PageBundle\Document\BasePageDocument;
use Sulu\Component\DocumentManager\DocumentManagerInterface;
use Sulu\Component\Webspace\Manager\WebspaceManagerInterface;

readonly class PageUrlRepository implements UrlRepositoryByTypeInterface
{
    public function __construct(
        private DocumentManagerInterface $documentManager,
        private WebspaceManagerInterface $webspaceManager,
    ) {
    }

    public function find(string $id, string $locale): ?string
    {
        try {
            /** @var BasePageDocument $document */
            $document = $this->documentManager->find($id, $locale);

            return $this->webspaceManager->findUrlByResourceLocator($document->getResourceSegment(), null, $locale);
        } catch (Exception) {
        }

        return null;
    }

    public function isResponsible(string $type): bool
    {
        return BasePageDocument::RESOURCE_KEY === $type;
    }
}
