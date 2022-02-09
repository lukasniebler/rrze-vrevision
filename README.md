# RRZE vRevision

RRZE vRevision erstellt Musterinhalte und einfache Testinhalte.

Der Default wird in den Plugin-Einstellungen unter Dashboard > Einstellungen > RRZEvRevision definiert.

## Nutzung

Ohne setzen individueller Einstellungen werden Mikroskopie-Aufnahmen des National Cancer Institutes (Unsplash) mit der Farbe der zentralen Fakultät genutzt.

```bash
#Default Shortcode
[rrze_vrevision]
Default-Werte können in den Plugin-Einstellungen gesetzt werden.
```
```bash
#Default Shortcode mit Attributen
[rrze_vrevision color="" imgcontent="" imgformat=""]
```
### color=""
Color steuert die Farbgebung der ausgegebenen Elemente.
Mögliche Werte sind: ""|nat|phil|rw|med|tf
### type="post"
Gibt Musterbeiträge aus.
### imgcontent
Setzt die Bildmotive. Der Default ist standardmäßig auf Mikroskopische Aufnahmen gesetzt.
default | Motive Istanbul
mint | Motive biology / medicine / mint
medicine
microscopy

JPEG-Aufnahmen stammen größtenteils von [National Cancer Institute (Unsplash)](https://unsplash.com/@nci).
### imgformat
jpeg | SVG
SVG's stammen von [Manypixels](https://manypixels.co).

```bash
# type="test"
[rrze_vrevision type="test" color="nat"]
```

### type="unicode"

Erstellt Inhalte mit allen 10400 Unicode-Symbolen um Schriftsätze zu testen. (!10400+ Unicode Characters - Erhöhte Seitenladezeiten. Nicht für Live-Seiten empfohlen) Ausgabe erfolgt im Format: Glyph [id] | Glyph [id2] | ... | 

```bash
# type="unicode"
[rrze_vrevision type="unicode"]
```

### type="..."

Mögliche Werte für Type: list | blockquote | code | image | img-center | img-ralign | img-lalign | post | test | table | text-long | text-medium | text-short | unicode

## Zeilenlänge bestimmen

Die folgenden CSS-Klassen wurden in Mustertexten verbaut:
rrze-vrevision-45-characters | 50 | 60 | 72

Die Zahlen liegen innerhalb der Empfehlung für gute Usability.

## Lizenz

This project is licensed under GNU general public license.

## Danksagung

Besonderer Dank gilt Wolfgang Wiese und Rolf v.d. Forst und meinen Kollegen am RRZE für die zahlreichen Rückmeldungen und Hilfestellungen bei der Umsetzung.

Das PlugIn nutzt im Kern das Rückgrat von [Fau-Fehlermeldungen](https://github.com/RRZE-Webteam/FAU-Fehlermeldungen), ein weiteres Plugin des RRZE Webteams.

## Feedback

Verbesserungsvorschläge und Fehlermeldungen können gerne als Issues angemerkt werden.