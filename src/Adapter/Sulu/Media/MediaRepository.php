<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Media;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Result;
use Doctrine\ORM\EntityManagerInterface;
use Generator;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\MediaRepositoryInterface;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;

/**
 * @codeCoverageIgnore
 */
final readonly class MediaRepository implements MediaRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @throws Exception
     */
    public function getAllMedia(string $locale = 'de'): Generator
    {
        $result = $this->loadMediaWithCredits($locale);
        while ($row = $result->fetchAssociative()) {
            yield $this->buildMedia($row);
        }
    }

    /**
     * @throws Exception
     */
    private function loadMediaWithCredits(string $locale): Result
    {
        $sql = <<<SQL
            SELECT DISTINCT media.id, meta.title, meta.copyright, meta.credits
            FROM me_media media
            
            JOIN me_files files
                ON files.idMedia = media.id
                AND files.id = (
                    SELECT MAX(f2.id)
                    FROM me_files f2
                    WHERE f2.idMedia = media.id
                )
            
            JOIN me_file_versions version
                ON version.idFiles = files.id
                AND version.id = (
                    SELECT MAX(v2.id)
                    FROM me_file_versions v2
                    WHERE v2.idFiles = files.id
                )
            
            JOIN me_file_version_meta meta
                ON meta.idFileVersions = version.id
            
            WHERE meta.locale = :locale
            AND (
                (meta.copyright IS NOT NULL AND meta.copyright != '')
                OR
                (meta.credits IS NOT NULL AND meta.credits != '')
            )
SQL;

        return $this->entityManager->getConnection()->executeQuery($sql, [
            'locale' => $locale,
        ]);
    }

    private function buildMedia(array $row): Media
    {
        return new Media(
            $row['id'],
            $row['title'],
            $row['copyright'],
            $row['credits'],
        );
    }
}
