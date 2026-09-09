# Contao Article Design

**Kompatibilität:** Contao 5.0 oder neuer, PHP 8.1+. Getestet unter Contao 5.7.

Erweitert `tl_article` um konfigurierbare Design-Eigenschaften – Innen-/Außenabstände,
maximale Breite, Hintergrundfarbe und einen Schalter für den "inside"-Wrapper.
Die auswählbaren Werte (CSS-Klasse + Backend-Bezeichnung) werden **nicht im Code**,
sondern über ein eigenes Backend-Modul verwaltet, sodass neue Abstufungen oder
Farben ohne Programmieraufwand ergänzt werden können.

## Installation

1. Paket in den `composer.json`-Verzeichnisbaum des Contao-Projekts legen bzw. per
   Composer einbinden:

   ```bash
   composer config repositories.article-design vcs https://github.com/b-fender/contao-article-extended
   composer require b-fender/contao-article-extended:^1.0
   ```

2. Datenbank aktualisieren, damit die neuen Felder und die Tabelle `tl_ad_option`
   angelegt werden:

   ```bash
   vendor/bin/contao-console contao:migrate
   ```

   Dabei werden automatisch sinnvolle Standardwerte (kleine bis extra-große
   Abstände, gängige Breiten, ein paar Beispiel-Hintergrundfarben) angelegt –
   das Auswahlfeld im Artikel ist also sofort nutzbar.

3. Fertig – kein Eintrag in `bundles.php` nötig, das Bundle registriert sich
   über den Contao-Manager-Plugin automatisch.

## Verwendung

* **Backend → Layout → Artikel-Design-Optionen**: hier neue Werte anlegen,
  deaktivieren oder umsortieren (Feld "Sortierung", je kleiner die Zahl, desto
  weiter oben in der Auswahlliste). Jeder Eintrag besteht aus:
  * **Eigenschaft** – für welches Artikelfeld der Eintrag gilt (pt/pb/mt/mb/mw/bgcolor)
  * **CSS-Klasse** – der exakte Klassenname, wie er im Projekt-SCSS definiert ist
  * **Bezeichnung im Backend** – der für Redakteure sichtbare Text
* **Artikel bearbeiten**: In der neuen Palette "Design-Eigenschaften" stehen die
  Felder Abstand oben/unten (Padding/Margin), maximale Breite, Hintergrundfarbe
  und "Ohne Innen-Wrapper" zur Verfügung.
* **CSS**: `theme/scss/_article-design.example.scss` enthält Beispielregeln für
  alle mitgelieferten Standardwerte. Contao kompiliert kein SCSS – die Regeln
  bei Bedarf in das eigene Theme-SCSS übernehmen und mit den in
  `tl_ad_option` gepflegten Klassennamen synchron halten.

## Template-Anpassung (Twig, Contao ≥ 5.7) — WICHTIG

Damit die neuen Felder (`pt`, `pb`, `mt`, `mb`, `mw`, `bgcolor`, `ad_noinside`)
auch tatsächlich als CSS-Klassen im HTML landen, muss der Artikel-Wrapper
angepasst werden. Seit Contao 5.7 ist **Twig der Standard-Renderer** für
`mod_article` – ein von einem Bundle mitgeliefertes `.html5`- oder
`.html.twig`-Template überschreibt die Core-Twig-Vorlage dabei **nicht
zuverlässig automatisch**. Der von Contao offiziell unterstützte und
getestete Weg ist ein **Projekt-Override über das Template Studio**:

1. Backend → Layout → **Template Studio** → nach `mod_article` suchen und
   öffnen.
2. Oben rechts auf **„Ihr Template erstellen"** klicken. Das legt automatisch
   `templates/mod_article.html.twig` im Contao-Projekt an, die Vorrang vor
   der Core-Vorlage `@Contao/mod_article.html.twig` hat.
3. Den vorbelegten Inhalt löschen und durch den Inhalt von
   [`templates/mod_article.html.twig`](templates/mod_article.html.twig) aus
   diesem Repository ersetzen.
4. Speichern – die Änderung greift sofort, ohne Cache-Clear oder Migration.

Die mitgelieferte Datei `templates/mod_article.html.twig` in diesem Repo ist
also **kein automatisch aktives Template**, sondern die Vorlage zum Kopieren
in Schritt 3.

### Warum nicht automatisch über das Bundle?

Contao 5.7 rendert `mod_article` per Default über die Core-Twig-Vorlage. Die
Wrapper-Klassen werden dort **außerhalb** eines benannten `{% block %}`
gesetzt, sodass sich ein klassischer `{% extends %}`-Block-Override nicht
eignet – die komplette Datei muss ersetzt werden. Contao garantiert diesen
Vorrang laut Dokumentation nur für Templates im **Projekt-Verzeichnis**
(`/templates`), nicht zuverlässig für gleichnamige Bundle-Templates. Deshalb
ist der Weg über das Template Studio aktuell die robusteste, offiziell
dokumentierte Lösung.
