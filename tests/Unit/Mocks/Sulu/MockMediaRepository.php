<?php

declare(strict_types=1);

class MockMediaRepository implements \Sulu\Bundle\MediaBundle\Entity\MediaRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function findMediaById($id)
    {

    }

    /**
     * @inheritDoc
     */
    public function findMediaByIdForRendering($id, $formatKey)
    {

    }

    /**
     * @inheritDoc
     */
    public function findMedia($filter = [], $limit = null, $offset = null, ?\Sulu\Component\Security\Authentication\UserInterface $user = null, $permission = null)
    {

    }

    /**
     * @inheritDoc
     */
    public function findMediaDisplayInfo($ids, $locale)
    {

    }

    /**
     * @inheritDoc
     */
    public function findMediaWithFilenameInCollectionWithId($filename, $collectionId)
    {

    }

    /**
     * @inheritDoc
     */
    public function findMediaByCollectionId($collectionId, $limit, $offset)
    {

    }

    /**
     * @inheritDoc
     */
    public function count(array $filter)
    {

    }

    /**
     * @inheritDoc
     */
    public function findMediaResourcesByCollection(int $collectionId, bool $includeDescendantCollections = true): array
    {

    }

    /**
     * @inheritDoc
     */
    public function find($id)
    {

    }

    /**
     * @inheritDoc
     */
    public function findAll()
    {

    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null)
    {

    }

    /**
     * @inheritDoc
     */
    public function findOneBy(array $criteria)
    {

    }

    /**
     * @inheritDoc
     */
    public function getClassName()
    {

    }

    /**
     * @inheritDoc
     */
    public function createNew()
    {

    }
}