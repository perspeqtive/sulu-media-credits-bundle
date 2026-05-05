<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle;

use PERSPEQTIVE\MediaCreditsBundle\Domain\References\ReferenceByTypeRepositoryInterface;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Url\UrlRepositoryByTypeInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * @codeCoverageIgnore
 */
class MediaCreditsBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container)
    {
        $container->registerForAutoconfiguration(ReferenceByTypeRepositoryInterface::class)
            ->addTag('perspeqtive.media_credits.reference_finder_repository');

        $container->registerForAutoconfiguration(UrlRepositoryByTypeInterface::class)
            ->addTag('perspeqtive.media_credits.url_repository');
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import(__DIR__ . '/../config/services.yaml');
    }
}
