<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Adapter\Sulu\Url;

use PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Url\PageUrlRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockRouteGenerator;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockRouteRepository;
use PHPUnit\Framework\TestCase;
use Sulu\Page\Domain\Model\PageInterface;
use Sulu\Route\Domain\Model\Route;

final class PageUrlRepositoryTest extends TestCase
{
    private PageUrlRepository $repository;
    private MockRouteGenerator $routeGenerator;
    private MockRouteRepository $routeRepository;

    protected function setUp(): void
    {
        $this->routeGenerator = new MockRouteGenerator();
        $this->routeRepository = new MockRouteRepository();
        $this->repository = new PageUrlRepository(
            $this->routeGenerator,
            $this->routeRepository,
        );
    }

    public function testIsResponsible(): void
    {
        self::assertTrue($this->repository->isResponsible('pages'));
        self::assertFalse($this->repository->isResponsible('articles'));
    }

    public function testFindReturnsUrl(): void
    {
        $id = 'uuid';
        $locale = 'de';
        $path = '/path';
        $expectedUrl = 'https://generated.de/path';

        $this->routeRepository->result = new Route(
            resourceKey: PageInterface::RESOURCE_KEY,
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

    public function testFindReturnsNullOnRouteNotFound(): void
    {
        $this->routeRepository->result = null;
        self::assertNull($this->repository->find('id', 'de'));
    }

    public function testFindReturnsNullOnGenerateThrowsException(): void
    {
        $id = 'uuid';
        $locale = 'de';
        $path = '/path';
        $expectedUrl = 'https://generated.de/path';

        $this->routeRepository->result = new Route(
            resourceKey: PageInterface::RESOURCE_KEY,
            resourceId: $id,
            locale: $locale,
            slug: $path,
            webspace: 'default',
        );

        $this->routeGenerator->throwException = true;
        self::assertNull($this->repository->find('id', 'de'));
    }
}
