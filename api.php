<?php

/**
 * Ajax
 *
 * @package Boots
 * @subpackage Ajax
 * @version 1.0.0
 * @license GPLv2
 *
 * Boots - The missing WordPress framework. http://wpboots.com
 *
 * Copyright (C) <2014>  <M. Kamal Khan>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 */

class Boots_Ajax
{
    private $Boots;
    private $Settings;
    private $dir;
    private $url;

    static private $ajaxurl = false;

    public function __construct($Boots, $Args, $dir, $url)
    {
        $this->Settings = $Args;
        $this->Boots = $Boots;
        $this->dir = $dir;
        $this->url = $url;
    }

    public function ajaxurl()
    {
        $Vars = array(
            'url' => $this->url . '/ajax.php'
        );

        echo '
            <script type="text/javascript">
            /* <![CDATA[ */
            var boots_ajax = ' . json_encode($Vars) . ';
            /* ]]> */
            </script>
        ';
    }

    public function url()
    {
        if(self::$ajaxurl)
        {
            return false;
        }

        self::$ajaxurl = true;

        add_action('wp_head', array(&$this, 'ajaxurl'));
    }

    public function scripts()
    {

        $ajax = $this->Boots->Enqueue
        ->script('jquery')->done()
        ->raw_script('boots_ajax')
            ->source($this->url . '/js/boots_ajax.min.js')
            ->requires('jquery');
        if(!self::$ajaxurl)
        {
            $ajax->vars('url', $this->url . '/ajax.php');
        }
        $ajax->done(true);

        self::$ajaxurl = true;
    }

    public function admin()
    {
        add_action('admin_enqueue_scripts', array(&$this, 'scripts'));
    }

    public function wp()
    {
        add_action('wp_enqueue_scripts', array(&$this, 'scripts'));
    }
}






