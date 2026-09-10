<?php

declare(strict_types=1);

namespace PedroGo\ArticleExtendedBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ArticleExtendedBundle extends Bundle
{
    /**
     * Ohne diese Überschreibung liefert Bundle::getPath() das Verzeichnis
     * dieser Klasse (also "src/") zurück. Contao sucht Ressourcen wie
     * contao/dca/*.php, templates/* und config/* aber im PAKET-
     * Wurzelverzeichnis (eine Ebene über src/) – deshalb wurden bislang
     * weder die DCA-Erweiterungen noch das Backend-Modul gefunden.
     */
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
