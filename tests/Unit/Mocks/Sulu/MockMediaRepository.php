<?php

declare(strict_types=1);
use Sulu\Bundle\MediaBundle\Entity\MediaRepositoryInterface;
use Sulu\Component\Security\Authentication\UserInterface;

class MockMediaRepository implements MediaRepositoryInterface
{
    public function findMediaById($id)
    {
    }

    public function findMediaByIdForRendering($id, $formatKey)
    {
    }

    public function findMedia($filter = [], $limit = null, $offset = null, ?UserInterface $user = null, $permission = null)
    {
    }

    public function findMediaDisplayInfo($ids, $locale)
    {
    }

    public function findMediaWithFilenameInCollectionWithId($filename, $collectionId)
    {
    }

    public function findMediaByCollectionId($collectionId, $limit, $offset)
    {
    }

    public function count(array $filter)
    {
    }

    public function findMediaResourcesByCollection(int $collectionId, bool $includeDescendantCollections = true): array
    {
    }

    public function find($id)
    {
    }

    public function findAll()
    {
    }

    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null)
    {
    }

    public function findOneBy(array $criteria)
    {
    }

    public function getClassName()
    {
    }

    public function createNew()
    {
    }
}
