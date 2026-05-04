<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu;

use Sulu\Bundle\MediaBundle\Api\Media;
use Sulu\Bundle\MediaBundle\Media\Manager\MediaManagerInterface;

final class MockMediaManager implements MediaManagerInterface
{
    /** @var mixed[] */
    public array $mediaToReturn = [];
    public ?string $requestedLocale = null;

    public function get($locale, $filter = [], $limit = null, $offset = null)
    {
        $this->requestedLocale = $locale;

        return $this->mediaToReturn;
    }

    public function getById($id, $locale)
    {
        return null;
    }

    public function save($uploadedFile, $data, $userId)
    {
        return null;
    }

    public function delete($id, $checkSecurity = false)
    {
    }

    public function move($id, $locale, $destCollection)
    {
        return null;
    }

    public function increaseDownloadCounter($fileVersionId)
    {
    }

    public function addFormatsAndUrl(Media $media)
    {
        return $media;
    }

    public function getByIds(array $ids, $locale)
    {
        return [];
    }

    public function getUrl($id, $fileName, $version)
    {
        return '';
    }

    public function getCount()
    {
        return 0;
    }

    public function getEntityById($id)
    {
        return null;
    }

    public function getFormatUrls($ids, $locale)
    {
        return [];
    }

    public function removeFileVersion(int $mediaId, int $version): void
    {
    }
}
