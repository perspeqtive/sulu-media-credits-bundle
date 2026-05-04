<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Adapter\Sulu\Url;

use PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Url\UrlRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockBasePageDocument;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockDocumentManager;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockWebspaceManager;
use PHPUnit\Framework\TestCase;
use Sulu\Bundle\PageBundle\Document\BasePageDocument;

final class UrlRepositoryTest extends TestCase
{
    private UrlRepository $repository;
    private MockDocumentManager $documentManager;
    private MockWebspaceManager $webspaceManager;

    protected function setUp(): void
    {
        $this->documentManager = new MockDocumentManager();
        $this->webspaceManager = new MockWebspaceManager();
        $this->repository = new UrlRepository(
            $this->documentManager,
            $this->webspaceManager
        );
    }

    public function testFindReturnsUrlFromWebspaceManager(): void
    {
        $id = 'some-uuid';
        $locale = 'en';
        $resourceSegment = '/some-path';
        $expectedUrl = 'https://example.com/en/some-path';

        $document = new BasePageDocument();
        $document->setResourceSegment($resourceSegment);

        $this->documentManager->documentToReturn = $document;
        $this->webspaceManager->urlToReturn = $expectedUrl;

        $result = $this->repository->find($id, $locale);

        self::assertSame($expectedUrl, $result);
        self::assertSame($id, $this->documentManager->requestedId);
        self::assertSame($locale, $this->documentManager->requestedLocale);
        self::assertSame($resourceSegment, $this->webspaceManager->requestedResourceLocator);
        self::assertSame($locale, $this->webspaceManager->requestedLocale);
    }

    public function testFindReturnsNullOnException(): void
    {
        $this->documentManager->exceptionToThrow = new \Exception();

        $result = $this->repository->find('id', 'de');

        self::assertNull($result);
    }
}
