<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu;

use Sulu\Component\DocumentManager\DocumentManagerInterface;

final class MockDocumentManager implements DocumentManagerInterface
{
    public ?object $documentToReturn = null;
    public ?string $requestedId = null;
    public ?string $requestedLocale = null;
    public ?\Exception $exceptionToThrow = null;

    public function find($identifier, $locale = null, array $options = [])
    {
        if ($this->exceptionToThrow) {
            throw $this->exceptionToThrow;
        }
        $this->requestedId = $identifier;
        $this->requestedLocale = $locale;
        return $this->documentToReturn;
    }

    public function create($alias) { return new \stdClass(); }
    public function persist($document, $locale = null, array $options = []) {}
    public function remove($document) {}
    public function removeLocale($document, $locale) {}
    public function move($document, $destId) {}
    public function copy($document, $destPath) { return null; }
    public function copyLocale($document, $srcLocale, $destLocale) {}
    public function reorder($document, $destId) {}
    public function publish($document, $locale = null, array $options = []) {}
    public function unpublish($document, $locale) {}
    public function removeDraft($document, $locale) {}
    public function restore($document, $locale, $version, array $options = []) {}
    public function refresh($document) {}
    public function flush() {}
    public function clear() {}
    public function createQuery($query, $locale = null, array $options = [])
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
