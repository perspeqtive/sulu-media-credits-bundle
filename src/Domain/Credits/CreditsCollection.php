<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Credits;

use Traversable;

class CreditsCollection implements \Countable, \IteratorAggregate
{

    private array $credits = [];

    public function add(Credits $credit): void
    {
        $this->credits[] = $credit;
    }

    /**
     * @return \ArrayIterator<Credits>
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->credits);
    }

    public function count(): int
    {
        return count($this->credits);
    }

    public function hasCredits(): bool
    {
        return !empty($this->credits);
    }
}