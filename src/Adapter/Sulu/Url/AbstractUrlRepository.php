<?php

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Url;

use Sulu\Content\Domain\Model\ContentRichEntityInterface;
use Sulu\Page\Domain\Model\PageInterface;
use Sulu\Route\Application\Routing\Generator\RouteGeneratorInterface;
use Sulu\Route\Domain\Model\Route;
use Sulu\Route\Domain\Repository\RouteRepositoryInterface;

abstract readonly class AbstractUrlRepository
{

    public function __construct(
        private RouteGeneratorInterface $routeGenerator,
        private RouteRepositoryInterface $routeRepository
    ) {
    }

    abstract protected function getResourceKey(): string;

    public function find(string $uuid, string $locale): ?string
    {
        $route = $this->getRoute($uuid, $locale);

        if ($route === null) {
            return null;
        }

        return $this->routeGenerator->generate(
            slug: $route->getSlug(),
            locale: $locale,
            webspace: $route->getWebspace(),
        );
    }

    private function getRoute(string $uuid, string $locale): ?Route
    {
        return $this->routeRepository->findOneBy([
            'resourceKey' => $this->getResourceKey(),
            'resourceId' => $uuid,
            'locale' => $locale,
        ]);
    }

    public function isResponsible(string $type): bool
    {
        return $this->getResourceKey() === $type;
    }

}