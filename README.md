# RRZE vRevision

RRZE vRevision is a WordPress-Plugin for displaying filler test-content. RRZE vRevision currently requires German set as default language. More information about using this plugin in other languages see the information below Usage-Instructions.

## Installation

Download the Plugin-Folder and install it within your WordPress Test environment.

## Usage

Without passing any arguments RRZEvRevision will display a set of test elements. This also includes RRZE-specific elements which rely on other Plugins like RRZE Elements.

```bash
#Default Shortcode
[rrze_vrevision color="" imgcontent="" imgformat=""]
```
### color=""
The default value for color is "". It controls RRZE Elements color-values for Accordion display. Possible values are: ""|nat|phil|rw|med|tf
### type="post"
### imgcontent
default | Motive Istanbul
mint | Motive biology / medicine / mint
medicine
microscopy

Images are from [National Cancer Institute (Unsplash)](https://unsplash.com/@nci).
### imgformat
jpeg | SVG
SVG's are from [Manypixels](https://manypixels.co)

Simulates a classic post or site-entry. This type includes text-content, accordions (RRZE Elements required), tables and block quotes.

```bash
# type="test"
[rrze_vrevision type="test" color="nat"]
```

### type="unicode"

Creates content with all existing unicode-Symbols (!10400+ Unicode Characters - Increased Loading-Time) and their linked ID in the unicode-System. Uses the following format: Glyph [id] | Glyph [id2] | ... | Id-Identifiers can be deactivated in Shortcodes.php on Line 54 by changing 'debug'-Mode into 'default'-Mode.

```bash
# type="unicode"
[rrze_vrevision type="unicode"]
```

### type="..."

All possible values for type: list | blockquote | code | image | img-center | img-ralign | img-lalign | post | test | table | text-long | text-medium | unicode

## Determine Characters per line

You can target Span-Elements within their paragraphs.
The following Class-names are available:
rrze-vrevision-45-characters | 50 | 60 | 72

These numbers are within the recommended range for best readability.

## How to use RRZE vRevision in other languages

Add your own Template-Files with your used language shorthand: for example: Instead of long-text-article-2-de_DE.html : long-text-article-2-en_EN

Furthermore you should also change the Arrays inside includes > Text.php with your individual language content.
The Arrays to change: $headline | $quotes | $notice and inside getSentence change case 'gutenberg' and the $output to your individual notice-text.

## License

This project is licensed under GNU general public license.

## Acknowledgment

Special thanks to Wolfgang Wiese, Rolf v.d. Forst and my other colleagues from RRZE Webteam for their constant help, advice and support.
This project uses quite a few snippets from [Fau-Fehlermeldungen](https://github.com/RRZE-Webteam/FAU-Fehlermeldungen), another plugin from RRZE Webteam.
