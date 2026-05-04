<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Media;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\MediaRepositoryInterface;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;
use Sulu\Bundle\MediaBundle\Media\Manager\MediaManagerInterface;

final readonly class MediaManager implements MediaRepositoryInterface
{

    public function __construct(private MediaManagerInterface $mediaManager) {}

    public function getAllMedia(string $locale = 'de'): array
    {
        if($this->mediaManager instanceof MediaManagerInterface === false) {
            return [];
        }
        $result = $this->mediaManager->get($locale); //TODO
        $medias = [];
        foreach($result as $item) {
            $medias[] = new Media(
                $item->getId(),
                $item->getTitle(),
                $item->getCopyright(),
                $item->getCredits()
            );
        }
        return $medias;
    }
}