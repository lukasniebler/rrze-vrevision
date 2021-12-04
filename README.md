# RRZE vRevision

Das WordPress Plugin ermöglicht schnelles generieren von Testcontent. Hierfür wird der Shortcode [rrze_mustercontent] verwendet.

Als Attribut wird type="" gesetzt.

Aktuell gibt es:

* type=""
** text (generiert puren Text)
** html-text (generiert Text mit HTML-Formatierung)


Hierbei wird zwischen verschiedenen Text-Templates gemischt.

Aktuell gibt es plain-text und text mit blockquotes.


Die Ausgabe ist zufällig.


## Wortliste erweitern
Der File Alice.php ermöglicht es zudem, die Wortliste anzupassen. Hierbei können die Hauptworte im Array $main erweitert werden.

Komplexe Fachbegriffe können unter $keywords gesetzt werden.

$getFillerWords ermöglicht es die Liste der Bindewörter zu erweitern.

## Geplante Templates:
- Ausgabe von Unicode
- Ausgabe von Latex
- Ausgabe von RRZE Shortcode-Inhalten
- Ausgabe von Bild & Text
- Kombination von allen Elementen