<?php

declare(strict_types=1);

namespace BFender\ArticleExtendedBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use BFender\ArticleExtendedBundle\ArticleExtendedBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ArticleExtendedBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
