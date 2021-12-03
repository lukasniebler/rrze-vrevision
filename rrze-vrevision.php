<?php

/*
Plugin Name:     RRZE vRevision
Plugin URI:      https://github.com/lukasniebler/rrze-vrevision
Description:     Shortcode that displays dummy content to check fontspacing and Theme functionality.
Version:         1.0.0
Author:          RRZE Webteam
Author URI:      https://blogs.fau.de/webworking/
License:         GNU General Public License v2
License URI:     http://www.gnu.org/licenses/gpl-2.0.html
Text Domain:     rrze-vRevision
*/

namespace RRZE\vRevision;

function loaded()
{
    new Main;
}
