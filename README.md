# RRZE vRevision

RRZE vRevision is a WordPress-Plugin for creating Test-content. The Shortcode is passed into the classic editor and creates a set of paragraphs, unicode-symbols, html-formatting and images to test fonts and Theme-display.

## Installation

Download the Plugin-Folder and install it within your WordPress Test environment.

## Usage

Creates plain Textcontent without styling. With each site reload another Template is loaded. Templates can include images served in the Plugin-Folder.

```bash
#Default Shortcode
[rrze_vrevision]
```

### type="test"

Creates Test-Content with all currently available Elements. Only selected Unicode-Symbols are included to reduce loading-time. Also includes Element-Shortcodes Accordion, Alert & Latex. Accordion-Preset and Color can be set in Shortcode.php on line 57. (Preset: 10 Accordion-Slides & FAU blue).

```bash
# type="test"
[rrze_vrevision type="test"]
```

### type="unicode"

Creates content with all existing unicode-Symbols (!10400+ Unicode Characters - Increased Loading-Time) and their linked ID in the unicode-System. Uses the following format: Glyph [id] | Glyph [id2] | ... | Id-Identifiers can be deactivated in Shortcodes.php on Line 54 by changing 'debug'-Mode into 'default'-Mode.

```bash
# type="unicode"
[rrze_vrevision type="unicode"]
```

### type="text"

Creates headlines and paragraphs without html-formatting. These Templates can include other Elements.

```bash
# type="text"
[rrze_vrevision type="text"] | Creates headlines and paragraphs without html-formatting.
```

### type="html-text"

Creates content with all available html-Formatting-Options. Html-Tags can be extended in file Rabbithole.php on Line 97.

```bash
# type="html-text"
[rrze_vrevision type="html-text"] | Creates headlines and paragraphs with common html-formatting. Including underlined text, bolt text, etc...
```

## Include your own Templates

-   Create a new Folder with a name for your templates
-   Create a new File inside your created Folder in the format identifier-de_DE.html
-   Register your Template inside Options.php

### The following Variables are currently available for use in Template-Files:

-   {{=paragraph1}} up to paragraph 10 | Creates paragraph
-   {{=h1}} up to h10 | Creates a sentence
-   {{=htmlparagraph1}} up to htmlparagraph10 | Creates a paragraph with html formatting
-   {{=author1}} up to author10 | Creates a random word
-   {{=word1}} up to word10 | Creates a random word
-   {{=citate1}} up to citate10 | Creates a sentence
-   {{=unicode}} | Creates all unicode-Characters
-   {{=unicodeStandard}} | Creates a brief list of common unicode-Symbols
-   {{=imgpath}}/assets/img/{{=imgname1}} up to imgname 10
-   {{=elementalert}}
-   {{=elementaccordion}}
-   {{=elementlatex}}

This list will be enhanced within the next versions.

## Include your own Image-Files

Insert your own Image-Files inside the assets/img-Folder. All templates now load your images instead with the variable {{=imagname1}} (up to 10) inside the Template-Files.

You can also delete certain images out of the Plugin-Directory.

## License

This project is licensed under GNU general public license.

## Roadmap

-   Serve images in different resolutions and alignments

## Acknowledgment

Special thanks to Wolfgang Wiese, Rolf v.d. Forst and my other colleagues from RRZE Webteam for their constant help, advice and support.
This project uses quite a few snippets from [Fau-Fehlermeldungen](https://github.com/RRZE-Webteam/FAU-Fehlermeldungen), another plugin from RRZE Webteam.
