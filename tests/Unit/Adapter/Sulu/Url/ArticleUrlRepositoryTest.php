<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Adapter\Sulu\Url;

use PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Url\ArticleUrlRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockRouteGenerator;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockRouteRepository;
use PHPUnit\Framework\TestCase;
use Sulu\Article\Domain\Model\ArticleInterface;
use Sulu\Route\Domain\Model\Route;

final class ArticleUrlRepositoryTest extends TestCase
{
    private ArticleUrlRepository $repository;
    private MockRouteGenerator $routeGenerator;
    private MockRouteRepository $routeRepository;

    protected function setUp(): void
    {
        $this->routeGenerator = new MockRouteGenerator();
        $this->routeRepository = new MockRouteRepository();
        $this->repository = new ArticleUrlRepository(
            $this->routeGenerator,
            $this->routeRepository
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
        $expectedUrl = 'https://generated.de/path';

        $this->routeRepository->result = new Route(
            resourceKey: ArticleInterface::RESOURCE_KEY,
            resourceId: $id,
            locale: $locale,
            slug: $path,
            webspace: 'default',
        );

        $result = $this->repository->find($id, $locale);

        self::assertSame($expectedUrl, $result);
        self::assertSame('default', $this->routeGenerator->webspace);
        self::assertSame('de', $this->routeGenerator->locale);

    }

    public function testFindReturnsNullRouteNotFound(): void
    {
        $this->routeRepository->result = null;
        self::assertNull($this->repository->find('id', 'de'));
    }

    public function testFindReturnsNullOnGenerateThrowsException(): void
    {
        $this->routeGenerator->throwException = true;
        self::assertNull($this->repository->find('id', 'de'));
    }
}
