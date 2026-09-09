<?php

declare(strict_types=1);

namespace BFender\ArticleExtendedBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Ohne diese Klasse wird config/services.yaml NICHT geladen – Symfony
 * erkennt Extension-Klassen nur über die Namenskonvention
 * "<BundleNameOhneBundle>Extension" im Namespace "<Bundle>\DependencyInjection".
 * Deshalb wurde die Migration (SeedDefaultOptionsMigration) bislang nie als
 * Service registriert und tauchte nicht unter contao.migration auf.
 */
class ArticleExtendedExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');
    }
}
