<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Adapter\Twig;

use PERSPEQTIVE\MediaCreditsBundle\Adapter\Twig\MediaCreditsExtension;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Credits\MockCreditsCollectionBuilder;
use PHPUnit\Framework\TestCase;
use Sulu\Component\Webspace\Analyzer\Attributes\RequestAttributes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\TwigFunction;

final class MediaCreditsExtensionTest extends TestCase
{
    private MediaCreditsExtension $extension;
    private MockCreditsCollectionBuilder $creditsCollectionBuilder;
    private RequestStack $requestStack;

    protected function setUp(): void
    {
        $this->creditsCollectionBuilder = new MockCreditsCollectionBuilder();
        $this->requestStack = new RequestStack();

        $this->extension = new MediaCreditsExtension(
            $this->creditsCollectionBuilder,
            $this->requestStack,
        );
    }

    public function testGetFunctionsReturnsMediaCreditsFunction(): void
    {
        $functions = $this->extension->getFunctions();

        self::assertCount(1, $functions);
        self::assertInstanceOf(TwigFunction::class, $functions[0]);
        self::assertSame('media_credits', $functions[0]->getName());
    }

    public function testGetMediaCreditsReturnsCollectionFromBuilderWithDefaultLocale(): void
    {
        $request = new Request();
        $this->requestStack->push($request);

        $result = $this->extension->getMediaCredits();

        self::assertSame($this->creditsCollectionBuilder->collectionToReturn, $result);
        self::assertSame('de', $this->creditsCollectionBuilder->requestedLocale);
    }

    public function testGetMediaCreditsReturnsCollectionFromBuilderWithLocaleFromSuluAttribute(): void
    {
        $request = new Request();
        $request->attributes->set('_sulu', new RequestAttributes(['locale' => 'en']));
        $this->requestStack->push($request);

        $result = $this->extension->getMediaCredits();

        self::assertSame($this->creditsCollectionBuilder->collectionToReturn, $result);
        self::assertSame('en', $this->creditsCollectionBuilder->requestedLocale);
    }
}
