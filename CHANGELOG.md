# Changelog

Alle nennenswerten Änderungen an diesem Projekt werden hier dokumentiert.

## [1.1.1] - 2026-09-10

### Geändert
- Composer-Paketname und PHP-Namespace von `b-fender`/`BFender` auf
  `pedro-go`/`PedroGo` umgestellt (GitHub-Account umbenannt).

## [1.1.0] - 2026-09-10

### Geändert
- **Breaking:** `templates/mod_article.html5` entfernt. Seit Contao 5.7 ist
  Twig der Standard-Renderer; ein von einem Bundle mitgeliefertes
  `.html5`-Template überschreibt die Core-Twig-Vorlage nicht mehr
  zuverlässig automatisch.
- Neu: `templates/mod_article.html.twig` als Kopiervorlage für einen
  Projekt-Override über das Template Studio (siehe README).

## [1.0.2] - 2026-09-09

### Behoben
- `Bundle::getPath()` überschrieben. Ohne diese Überschreibung lieferte
  `getPath()` das `src/`-Verzeichnis statt des Paket-Wurzelverzeichnisses
  zurück, wodurch Contao `contao/dca/*.php`, `templates/*` und `config/*`
  nie gefunden hat – der eigentliche Grund für so gut wie alle
  Installationsprobleme in den Versionen davor.

## [1.0.1] - 2026-09-09

### Behoben
- Fehlende `Symfony\Component\DependencyInjection\Extension`-Klasse
  ergänzt. Ohne sie wurde `config/services.yaml` nie geladen, wodurch die
  Migration (`SeedDefaultOptionsMigration`) nicht als Service registriert
  wurde und nicht in `contao.migration` auftauchte.

## [1.0.0] - 2026-09-08

Erste Veröffentlichung.

### Hinzugefügt
- Neue Tabelle `tl_ad_option` (Backend-Modul "Artikel-Design-Optionen")
  zur Verwaltung der auswählbaren CSS-Klassen (Abstände, Breite,
  Hintergrundfarbe) ohne Codeänderung.
- Neue Felder an `tl_article`: `pt`, `pb`, `mt`, `mb`, `mw`, `bgcolor`,
  `ad_noinside`.
- Migration, die beim ersten `contao:migrate` automatisch sinnvolle
  Standardwerte anlegt.
- Composer-/Contao-Manager-installierbar via Contao-Manager-Plugin.
