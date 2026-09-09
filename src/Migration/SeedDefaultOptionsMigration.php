<?php

declare(strict_types=1);

namespace BFender\ArticleExtendedBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

/**
 * Legt beim ersten Ausführen von "contao:migrate" eine sinnvolle
 * Standard-Auswahl an Optionen in tl_ad_option an, damit die Auswahlfelder
 * im Artikel nicht leer sind. Läuft nur, solange die Tabelle noch leer ist,
 * überschreibt also keine später vom Anwender angepassten Werte.
 */
class SeedDefaultOptionsMigration extends AbstractMigration
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function getName(): string
    {
        return 'Artikel-Design: Standardoptionen anlegen';
    }

    public function shouldRun(): bool
    {
        // getSchemaManager()/createSchemaManager() unterscheiden sich je nach
        // doctrine/dbal-Version. Ein direkter, gekapselter Zugriff auf die
        // Tabelle ist über alle für Contao 5.x genutzten DBAL-Versionen hinweg
        // stabil und vermeidet die Abhängigkeit von einer bestimmten API.
        try {
            $count = (int) $this->connection->fetchOne('SELECT COUNT(*) FROM tl_ad_option');
        } catch (\Throwable) {
            // Tabelle existiert noch nicht (Schema-Migration lief noch nicht) -> später erneut prüfen
            return false;
        }

        return 0 === $count;
    }

    public function run(): MigrationResult
    {
        $now = time();

        // [type, value, label, sorting]
        $rows = [
            ['pt', 'pt-sm', 'Klein (25px / 50px)', 10],
            ['pt', 'pt-md', 'Mittel (50px / 100px)', 20],
            ['pt', 'pt-lg', 'Groß (75px / 150px)', 30],
            ['pt', 'pt-xl', 'Sehr groß (100px / 200px)', 40],
            ['pt', 'pt-xxl', 'Extra groß (150px / 250px)', 50],

            ['pb', 'pb-sm', 'Klein (25px / 50px)', 10],
            ['pb', 'pb-md', 'Mittel (50px / 100px)', 20],
            ['pb', 'pb-lg', 'Groß (75px / 150px)', 30],
            ['pb', 'pb-xl', 'Sehr groß (100px / 200px)', 40],
            ['pb', 'pb-xxl', 'Extra groß (150px / 250px)', 50],

            ['mt', 'mt-sm', 'Klein (25px / 50px)', 10],
            ['mt', 'mt-md', 'Mittel (50px / 100px)', 20],
            ['mt', 'mt-lg', 'Groß (75px / 150px)', 30],
            ['mt', 'mt-xl', 'Sehr groß (100px / 200px)', 40],
            ['mt', 'mt-xxl', 'Extra groß (150px / 250px)', 50],

            ['mb', 'mb-sm', 'Klein (25px / 50px)', 10],
            ['mb', 'mb-md', 'Mittel (50px / 100px)', 20],
            ['mb', 'mb-lg', 'Groß (75px / 150px)', 30],
            ['mb', 'mb-xl', 'Sehr groß (100px / 200px)', 40],
            ['mb', 'mb-xxl', 'Extra groß (150px / 250px)', 50],

            ['mw', 'article-mw-sm', 'Schmal (585px)', 10],
            ['mw', 'article-mw-md', 'Mittel (910px)', 20],
            ['mw', 'article-mw-lg', 'Breit (1230px)', 30],
            ['mw', 'article-mw-xl', 'Sehr breit (1390px)', 40],
            ['mw', 'article-mw-xxl', 'Extra breit (1550px)', 50],

            ['bgcolor', 'article-bg-white', 'Weiß', 10],
            ['bgcolor', 'article-bg-grau-100', 'Hellgrau', 20],
            ['bgcolor', 'article-bg-grau-200', 'Grau', 30],
            ['bgcolor', 'article-bg-primary', 'Primärfarbe', 40],
        ];

        foreach ($rows as [$type, $value, $label, $sorting]) {
            $this->connection->insert('tl_ad_option', [
                'tstamp'    => $now,
                'type'      => $type,
                'value'     => $value,
                'label'     => $label,
                'sorting'   => $sorting,
                'published' => '1',
            ]);
        }

        return $this->createResult(true, sprintf('%d Standardoptionen wurden angelegt.', count($rows)));
    }
}
