<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Adapter\Sulu\Url;

use Exception;
use PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Url\ArticleUrlRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockDocumentManager;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockWebspaceManager;
use PHPUnit\Framework\TestCase;
use Sulu\Bundle\ArticleBundle\Document\ArticleDocument;

final class ArticleUrlRepositoryTest extends TestCase
{
    private ArticleUrlRepository $repository;
    private MockDocumentManager $documentManager;
    private MockWebspaceManager $webspaceManager;

    protected function setUp(): void
    {
        $this->documentManager = new MockDocumentManager();
        $this->webspaceManager = new MockWebspaceManager();
        $this->repository = new ArticleUrlRepository(
            $this->documentManager,
            $this->webspaceManager,
        );
    }

    public function testIsResponsible(): void
    {
        self::assertTrue($this->repository->isResponsible('articles'));
        self::assertFalse($this->repository->isResponsible('pages'));
    }

    public function testFindReturnsUrl(): void
    {
        $id = 'uuid';
        $locale = 'de';
        $path = '/path';
        $expectedUrl = 'https://example.com/de/path';

        $document = new ArticleDocument();
        $document->setRoutePath($path);

        $this->documentManager->documentToReturn = $document;
        $this->webspaceManager->urlToReturn = $expectedUrl;

        $result = $this->repository->find($id, $locale);

        self::assertSame($expectedUrl, $result);
        self::assertSame($id, $this->documentManager->requestedId);
        self::assertSame($path, $this->webspaceManager->requestedResourceLocator);
    }

    public function testFindReturnsNullOnException(): void
    {
        $this->documentManager->exceptionToThrow = new Exception();
        self::assertNull($this->repository->find('id', 'de'));
    }
}
