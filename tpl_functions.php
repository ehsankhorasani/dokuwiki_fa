<?php

/**
 * functions for dokuwiki_fa template
 *
 * License: GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * @author:         Ehsan Khorasani <mohamadiank@gmail.com>
 */

require_once('jdf.php');

function fa_tpl_pageinfo() {

    global $conf;
    global $lang;
    global $INFO;
    global $ID;

    // return if we are not allowed to view the page
    if(!auth_quickaclcheck($ID)) {
        return false;
    }

    // prepare date and path
    $fn = $INFO['filepath'];
    if(!$conf['fullpath']) {
        if($INFO['rev']) {
            $fn = str_replace(fullpath($conf['olddir']).'/', '', $fn);
        } else {
            $fn = str_replace(fullpath($conf['datadir']).'/', '', $fn);
        }
    }
    $fn   = utf8_decodeFN($fn);
    $date = jdate('H:i:s l j F Y', $INFO['lastmod']);

    if($INFO['exists']) {
        $out = '';
        $out .= '<bdi>'.$fn.'</bdi>';
        $out .= ' · ';
        $out .= $lang['lastmod'];
        $out .= ' ';
        $out .= $date;
        if($INFO['editor']) {
            $out .= ' '.$lang['by'].' ';
            $out .= '<bdi>'.editorinfo($INFO['editor']).'</bdi>';
        } else {
            $out .= ' ('.$lang['external_edit'].')';
        }
        if($INFO['locked']) {
            $out .= ' · ';
            $out .= $lang['lockedby'];
            $out .= ' ';
            $out .= '<bdi>'.editorinfo($INFO['locked']).'</bdi>';
        }
        if($ret) {
            return $out;
        } else {
            echo $out;
            return true;
        }
    }
}