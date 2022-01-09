<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

class Text
{
    public static function getRandInt($array){
        return rand(0, count($array)-1);
    }

    public static function getQuote()
    {
        $quotes = array(
            array(
                'Science and everyday life cannot and should not be separated.',
                'Rosalind Franklin',
            ),
            array(
                "What's the use of doing all this work if we don't get some fun out of this?",
                'Rosalind Franklin',
            ),
        );
        $randomInt = rand(0, count($quotes)-1);
        $output = $quotes[$randomInt];
        return $output;
    }

    public static function getHeadline()
    {
        $headline = array(
            'Kontrollierte Entnetzung',
            'Mikroskopische Kunstwerke',
            'Sterne am Halbleiterhimmel',
            'Goldschwamm im CT',
            'Ein Hort für Mikroskope',
            'Molekülpost',
            'Postdienst unter Beobachtung',
            'Aus dem Baukasten der Natur',
            'Die digitale Wunderkammer',
            'Das Projekt "Objekte im Netz"',
            'Besser vernetzt',
            'Körper(ein)sichten',
            'Endo-Mikroskopie: Schnelltest für Polypen',
            'Computertomografie: Scannen unter Volllast',
            'Lichtblatt-Mikroskopie: Die U-Bahn für Immunzellen',
            'Endo-Mikroskopie: Gewebediagnose ohne künstliche Kontrastmittel',
            'Multispektrale Optoakustische Tomografie: Wegweiser Hämoglobin',
            'Wissenslücken',
            'Politisch (un-)erwünscht',
            'Wirtschaftlich nutzbar',
            'Ethisch und rechtlich problematisch',
            'Gesellschaftlich (un-)erwünscht',
            'Nullen und Einsen',
            'Der Mensch bleibt Experte',
            'Hilfreiche Tools für die Medizin',
            'KI kann uns helfen, gesünder zu leben',
            'Expertise von KI und Mensch nötig',
            'KI-Forschung mit Tradition',
            'Was Sprache macht',
            'Gesellschaftsspiele',
            'Brückenbauer aktivieren',
            'Übereinander statt miteinander reden',
            'Ins Hirn geschaut',
            'Der finale Sargnagel',
            'Wissen wir, was wir tun?',
            'Falsche Selbsteinschätzung',
            'Die Kindheit prägt Bindungsverhalten',
            'Bindungsstatus ist veränderlich',
            'Wenig Wissen für die Opposition',
            'Wissen ist Macht',
            'Was Whistleblower motiviert',
            'Wahrnehmung positiv veärndern',
            'Die Unaussprechlichen',
            'Können Krankheiten entstigmatisiert werden?',
            'Was bedeutet das Wort "Tabu"?',
            'Tabula rasa',
            'Die Lust am Ekel',
            'Weil es uns (vermeintlich) nützt',
            'Schweigen aus Scham',
            'Schreiben über das Unaussprechliche',
            'Unter dem Meer',
            'Baumeister unter Wasser',
            'Perlenkette unter Wasser',
            'Schwarzer Raucher',
            'Unter der Erde',
            'Zweitbesetzung'
        );
        $randomInt = Self::getRandInt($headline);
        $output = $headline[$randomInt];
        return $output;
    }

    public static function getSentence($type = 'notice'){
        $output='no output set';
        $notice = array(
            'Bitte melden Sie sich vor den Veranstaltungen in unserem Sekretariat an.',
            'Die Wiederholungsklausuren finden erst im nächsten Wintersemester statt.',
            'Bitte beachten Sie die Teilnehmergrenze für Gruppenanmeldungen',
            'Die Ausstellung endet am 15. Oktober',
        );
        switch($type){
            case 'gutenberg':
                $output = 'Die deutschen Beispieltexte sind Auszüge aus dem Gutenberg-Projekt. Mehr Informationen finden Sie im Internet auf der <a href="https://www.projekt-gutenberg.org">Seite vom Projekt Gutenberg</a>.';
                break;
            case 'notice':
                $randomInt = Self::getRandInt($notice);
                $output = $notice[$randomInt];
                break;
        }
        return $output;
    }
}