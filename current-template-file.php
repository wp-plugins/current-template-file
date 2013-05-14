<?php

/*
  Plugin Name: Current Template File
  Plugin URI: http://wordpress.org/extend/plugins/current-template-file
  Description: Displays the current template file in WordPress admin toolbar
  Version: 1.1
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

		add_action('admin_bar_init', array(&$this, 'admin_toolbar_init'));
	}

	function admin_toolbar_init() {

		if (!is_admin() && is_super_admin() && is_admin_bar_showing()) {
			add_action('admin_bar_menu', array(&$this, 'admin_tooolbar_add_item'), 100);
		}
	}

	function admin_tooolbar_add_item() {

		global $wp_admin_bar;
		global $template;
		
		echo $template;
		
		$wp_admin_bar->add_menu(array(
			    'id' => 'current_template_file',
			    'title' => "Current file: /" . substr( $template, ( strpos( $template, 'wp-content') ) ),
			    //'title' => $template,
			    'href' => false,
			    "parent" => false,
			    "meta" => false
		));
	}

}

new CurrentTemplateFile();