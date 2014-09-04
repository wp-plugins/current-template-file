<?php

/*
  Plugin Name: Current Template File
  Plugin URI: http://wordpress.org/extend/plugins/current-template-file
  Description: Displays the current template file in WordPress admin toolbar
  Version: 1.2.1
  Author: Konstantinos Kouratoras
  Author URI: http://www.kouratoras.gr
  Author Email: kouratoras@gmail.com
  License: GPL v2

  Copyright 2012 Konstantinos Kouratoras (kouratoras@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

class CurrentTemplateFile {

	public function __construct() {
		
		//Load localisation files
		add_action( 'init', array(&$this, 'plugin_textdomain'));
		
		//Print file
		add_action('admin_bar_init', array(&$this, 'ctf_toolbar_init'));
	}
	
	function plugin_textdomain() {

		load_plugin_textdomain(
			'current-template-file',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
			);
	}

	function ctf_toolbar_init() {

		if (!is_admin() && is_super_admin() && is_admin_bar_showing()) {
			add_action('admin_bar_menu', array(&$this, 'ctf_tooolbar_add_item'), 100);
		}
	}
	
	function ctf_tooolbar_add_item() {

		global $wp_admin_bar;
		global $template;
		
		$wp_admin_bar->add_menu(array(
			    'id' => 'current_template_file',
			    'title' => __('Current file:', 'current-template-file') . " " . substr( $template, ( strpos( $template, 'wp-content') ) ),
			    'href' => false,
			    "parent" => false,
			    "meta" => false
		));
	}
}

new CurrentTemplateFile();