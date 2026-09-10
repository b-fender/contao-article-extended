<?php

declare(strict_types=1);

namespace PedroGo\ArticleExtendedBundle\Dca;

use Contao\Database;
use Contao\DataContainer;

/**
 * Liefert die Optionen für die Auswahlfelder von tl_article.
 *
 * Die eigentliche Werteliste (CSS-Klasse + Label je Eigenschaft) wird nicht
 * im Code gepflegt, sondern über das Backend-Modul "Artikel-Design-Optionen"
 * (Tabelle tl_ad_option) verwaltet. So lassen sich neue Abstands-, Breiten-
 * oder Farb-Klassen ergänzen, ohne den Code anzufassen.
 */
class ArticleOptions
{
    public static function getPtOptions(DataContainer $dc): array
    {
        return self::getOptions('pt', $dc);
    }

    public static function getPbOptions(DataContainer $dc): array
    {
        return self::getOptions('pb', $dc);
    }

    public static function getMtOptions(DataContainer $dc): array
    {
        return self::getOptions('mt', $dc);
    }

    public static function getMbOptions(DataContainer $dc): array
    {
        return self::getOptions('mb', $dc);
    }

    public static function getMwOptions(DataContainer $dc): array
    {
        return self::getOptions('mw', $dc);
    }

    public static function getBgcolorOptions(DataContainer $dc): array
    {
        return self::getOptions('bgcolor', $dc);
    }

    /**
     * Holt alle veröffentlichten Optionen eines Typs aus tl_ad_option und
     * gibt sie sortiert als [Wert => Label] zurück. Ein aktuell gespeicherter
     * Wert, der (z. B. weil er inzwischen deaktiviert wurde) nicht mehr in
     * der Liste enthalten ist, wird zusätzlich angehängt, damit bestehende
     * Artikel ihre Zuordnung nicht optisch "verlieren".
     */
    private static function getOptions(string $type, ?DataContainer $dc = null): array
    {
        $options = [];

        $result = Database::getInstance()
            ->prepare("SELECT value, label FROM tl_ad_option WHERE type=? AND published=1 ORDER BY sorting, id")
            ->execute($type);

        while ($result->next()) {
            $options[$result->value] = $result->label . ' (' . $result->value . ')';
        }

        $currentValue = $dc?->activeRecord?->{$dc->field} ?? null;

        if ($currentValue && !isset($options[$currentValue])) {
            $options[$currentValue] = $currentValue . ' (inaktiv/gelöscht)';
        }

        return $options;
    }
}
