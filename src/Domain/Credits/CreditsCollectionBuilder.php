<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Credits;

final readonly class CreditsCollectionBuilder implements CreditsCollectionBuilderInterface
{
    public function __construct(
        private MediaRepositoryInterface                 $mediaRepository,
        private MediaReferenceCollectionBuilderInterface $referenceCollectionBuilder,
    )
    {
    }

    public function build(string $locale = 'de'): CreditsCollection {
        $credits = new CreditsCollection();
        $medias = $this->mediaRepository->getAllMedia($locale);
        foreach ($medias as $media) {
            if (empty($media->credit) && empty($media->copyright)) {
                continue;
            }

            $credits->add(new Credits(
                $media->id,
                $media->title,
                $media->copyright,
                $media->credit,
                $this->referenceCollectionBuilder->build($media)
            ));
        }
        return $credits;
    }


}
