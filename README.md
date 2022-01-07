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

## Determine Characters per line

You can target Span-Elements within their paragraphs.
The following Class-names are available:
rrze-vrevision-45-characters | 50 | 60 | 72

These numbers are within the recommended range for best readability.
## License

This project is licensed under GNU general public license.

## Acknowledgment

Special thanks to Wolfgang Wiese, Rolf v.d. Forst and my other colleagues from RRZE Webteam for their constant help, advice and support.
This project uses quite a few snippets from [Fau-Fehlermeldungen](https://github.com/RRZE-Webteam/FAU-Fehlermeldungen), another plugin from RRZE Webteam.
