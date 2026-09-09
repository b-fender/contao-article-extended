# Contao Article Design

**Kompatibilität:** Contao 5.0 oder neuer, PHP 8.1+.

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

* **Backend → Design → Artikel-Design-Optionen**: hier neue Werte anlegen,
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
