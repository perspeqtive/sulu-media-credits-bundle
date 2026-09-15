<?php

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu;

use Sulu\Route\Application\Routing\Generator\RouteGeneratorInterface;
use Sulu\Route\Domain\Model\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MockRouteGenerator implements RouteGeneratorInterface
{
    public ?string $webspace = null;
    public ?string $locale = null;

    /**
     * @inheritDoc
     */
    public function generate(string $slug, ?string $locale = null, ?string $webspace = null, int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
    {
        $this->webspace = $webspace;
        $this->locale = $locale;
        return 'https://generated.de' . $slug;
    }
}