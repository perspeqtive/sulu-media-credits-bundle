<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Twig;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\CreditsCollection;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\CreditsCollectionBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class MediaCreditsExtension extends AbstractExtension
{
    public function __construct(
        private readonly CreditsCollectionBuilderInterface $creditsListBuilder,
        private readonly RequestStack $requestStack
    )
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('media_credits', [$this, 'getMediaCredits']),
        ];
    }

    /**
     * @return CreditsCollection
     */
    public function getMediaCredits(): CreditsCollection
    {
        $request = $this->requestStack->getCurrentRequest();
        $locale = $request?->attributes->get('_sulu')?->getAttribute('locale') ?? 'de';
        return $this->creditsListBuilder->build($locale);
    }
}