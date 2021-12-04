# RRZE vRevision

RRZE vRevision is a WordPress-Plugin for creating Test-content. The Shortcode is passed into the classic editor and creates a set of paragraphs, unicode-symbols, html-formatting and images to test fonts and Theme-display.

## Installation

Download the Plugin-Folder and install it within your WordPress Test environment.

## Usage

```bash
#Default Shortcode
[rrze_mustercontent] | Creates plain Textcontent without styling.

# type="unicode" 
[rrze_mustercontent type="unicode"] | Creates all Unicode-Symbols with according id in the following format: Glyph [id] | Glyph [id2] | ...

# type="text"
[rrze_mustercontent type="text"] | Creates headlines and paragraphs without html-formatting.

# type="html-text"
[rrze_mustercontent type="html-text"] | Creates headlines and paragraphs with common html-formatting. Including underlined text, bolt text, etc...
```

## Including own Templates

* Create a new Folder with a name for your templates
* Create a new File inside your created Folder in the format identifier-de_DE.html
* Register your Template inside Options.php

### The following Variables are currently available:
* {{=paragraph1}} up to paragraph 10 | Creates paragraph
* {{=h1}} up to h10 | Creates a sentence
* {{=htmlparagraph1}} up to htmlparagraph10 | Creates a paragraph with html formatting
* {{=author1}} up to author10 | Creates a random word
* {{=word1}} up to word10 | Creates a random word
* {{=citate1}} up to citate10 | Creates a sentence
* {{=unicode}} | Creates all unicode-Characters

This list will be enhanced within the next versions.

## License
This project is licensed under GNU general public license.

## Roadmap
- Image-Content
- Use of Shortcakes from RRZE Plugins
- type="test"

## Acknowledgment
Special thanks to Wolfgang Wiese, Rolf v.d. Forst and my other colleagues for their constant help and advice.
This project uses quite a few snippets from Fau-Fehlermeldungen, another plugin from RRZE. 