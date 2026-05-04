<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu;

use Sulu\Bundle\MediaBundle\Api\Media;

final class MockApiMedia extends Media
{
    public $id;
    public $title;
    public $copyright;
    public $credits;

    public function __construct()
    {
        // Wir rufen den Parent-Constructor nicht auf, da er eine Entity erwartet
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCopyright()
    {
        return $this->copyright;
    }

    public function getCredits()
    {
        return $this->credits;
    }
}
