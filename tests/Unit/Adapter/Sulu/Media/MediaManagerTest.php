<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Adapter\Sulu\Media;
 
use PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Media\MediaManager;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockApiMedia;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockMediaManager as MockSuluMediaManager;
use PHPUnit\Framework\TestCase;
 
final class MediaManagerTest extends TestCase
{
    private MediaManager $mediaManager;
    private MockSuluMediaManager $suluMediaManager;
 
    protected function setUp(): void
    {
        $this->suluMediaManager = new MockSuluMediaManager();
        $this->mediaManager = new MediaManager($this->suluMediaManager);
    }
 
    public function testGetAllMediaReturnsDomainMediaArray(): void
    {
        $apiMedia = new MockApiMedia();
        $apiMedia->id = 1;
        $apiMedia->title = 'Title';
        $apiMedia->copyright = 'Copyright';
        $apiMedia->credits = 'Credits';
 
        $this->suluMediaManager->mediaToReturn = [$apiMedia];
 
        $result = $this->mediaManager->getAllMedia('de');
 
        self::assertCount(1, $result);
        self::assertSame(1, $result[0]->id);
        self::assertSame('Title', $result[0]->title);
        self::assertSame('Copyright', $result[0]->copyright);
        self::assertSame('Credits', $result[0]->credit);
        self::assertSame('de', $this->suluMediaManager->requestedLocale);
    }

}
