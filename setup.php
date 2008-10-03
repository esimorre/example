<?php
/*
   ----------------------------------------------------------------------
   GLPI - Gestionnaire Libre de Parc Informatique
   Copyright (C) 2003-2006 by the INDEPNET Development Team.

   http://indepnet.net/   http://glpi-project.org
   ----------------------------------------------------------------------

   LICENSE

   This file is part of GLPI.

   GLPI is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   GLPI is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with GLPI; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
   ------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------

// Init the hooks of the plugins -Needed
function plugin_init_example() {
	global $PLUGIN_HOOKS,$LANGEXAMPLE,$LANG,$CFG_GLPI;

	// Display a menu entry ?
	$PLUGIN_HOOKS['menu_entry']['example'] = true;
	$PLUGIN_HOOKS['submenu_entry']['example']['add'] = 'example.form.php';
	$PLUGIN_HOOKS['submenu_entry']['example']["<img  src='".$CFG_GLPI["root_doc"]."/pics/menu_showall.png' title='".$LANGEXAMPLE["test"]."' alt='".$LANGEXAMPLE["test"]."'>"] = 'index.php';
	$PLUGIN_HOOKS['submenu_entry']['example'][$LANGEXAMPLE["test"]] = 'index.php';
	$PLUGIN_HOOKS['submenu_entry']['example']['config'] = 'index.php';

	$PLUGIN_HOOKS["helpdesk_menu_entry"]['example'] = true;

	// Config page
	$PLUGIN_HOOKS['config_page']['example'] = 'config.php';

	// Init session
	//$PLUGIN_HOOKS['init_session']['example'] = 'plugin_init_session_example';
	// Change profile
	//$PLUGIN_HOOKS['change_profile']['example'] = 'plugin_change_profile_example';
	// Change entity
	//$PLUGIN_HOOKS['change_entity']['example'] = 'plugin_change_entity_example';
	

	// Onglets management
	$PLUGIN_HOOKS['headings']['example'] = 'plugin_get_headings_example';
	$PLUGIN_HOOKS['headings_action']['example'] = 'plugin_headings_actions_example';

	// Item action event // See define.php for defined ITEM_TYPE
	$PLUGIN_HOOKS['pre_item_update']['example'] = 'plugin_pre_item_update_example';
	$PLUGIN_HOOKS['item_update']['example'] = 'plugin_item_update_example';
	
	$PLUGIN_HOOKS['pre_item_add']['example'] = 'plugin_pre_item_add_example';
	$PLUGIN_HOOKS['item_add']['example'] = 'plugin_item_add_example';
	
	$PLUGIN_HOOKS['pre_item_delete']['example'] = 'plugin_pre_item_delete_example';
	$PLUGIN_HOOKS['item_delete']['example'] = 'plugin_item_delete_example';
	
	$PLUGIN_HOOKS['pre_item_purge']['example'] = 'plugin_pre_item_purge_example';
	$PLUGIN_HOOKS['item_purge']['example'] = 'plugin_item_purge_example';
	
	$PLUGIN_HOOKS['pre_item_restore']['example'] = 'plugin_pre_item_restore_example';
	$PLUGIN_HOOKS['item_restore']['example'] = 'plugin_item_restore_example';
	
	$PLUGIN_HOOKS['item_transfer']['example'] = 'plugin_item_transfer_example';

	// Cron action
	$PLUGIN_HOOKS['cron']['example'] = DAY_TIMESTAMP;

	//redirect appel http://localhost/glpi/index.php?redirect=plugin_example_2 (ID 2 du form)
	$PLUGIN_HOOKS['redirect_page']['example']="example.form.php";

	//function to populate planning
	$PLUGIN_HOOKS['planning_populate']['example']="plugin_planning_populate_example";

	//function to display planning items
	$PLUGIN_HOOKS['display_planning']['example']="plugin_display_planning_example";

	// Massive Action definition
	$PLUGIN_HOOKS['use_massive_action']['example']=1;

	// Add specific files to add to the header : javascript or css
	$PLUGIN_HOOKS['add_javascript']['example']="example.js";
	$PLUGIN_HOOKS['add_css']['example']="example.css";

	// Retrieve others datas from LDAP
	//$PLUGIN_HOOKS['retrieve_more_data_from_ldap']['example']="plugin_retrieve_more_data_from_ldap_example";
	
	// Reports
	$PLUGIN_HOOKS['reports']['example'] = array('report.php'=>'New Report', 'report.php?other'=>'New Report 2',);
	
	
	// Params : plugin name - string type - ID - class - table - form page - Type name
	pluginNewType('example',"PLUGIN_EXAMPLE_TYPE",1001,"pluginExample","glpi_plugin_example","example.form.php","Example Type");

}


// Get the name and the version of the plugin - Needed
function plugin_version_example(){
	return array( 
		'name'    => 'Plugin Example',
		'version' => '0.1.0',
		'author' => 'Julien Dombre',
		'homepage'=> 'http://glpi-project.org');
}

// Install process for plugin : need to return true if succeeded
function plugin_example_install(){
	global $DB;
	if (!TableExists("glpi_plugin_example")){
		$query="CREATE TABLE `glpi_plugin_example` (
			`ID` int(11) NOT NULL auto_increment,
			`name` varchar(255) collate utf8_unicode_ci default NULL,
			`serial` varchar(255) collate utf8_unicode_ci NOT NULL,
			`FK_dropdown` int(11) NOT NULL default '0',
			`deleted` smallint(6) NOT NULL default '0',
			`is_template` smallint(6) NOT NULL default '0',
			`tplname` varchar(255) collate utf8_unicode_ci default NULL,
			PRIMARY KEY  (`ID`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
			";
		$DB->query($query) or die("error creating glpi_plugin_example ". $DB->error());
		$query="INSERT INTO `glpi_plugin_example` (`ID`, `name`, `serial`, `FK_dropdown`, `deleted`, `is_template`, `tplname`) VALUES
			(1, 'example 1', 'serial 1', 1, 0, 0, NULL),
			(2, 'example 2', 'serial 2', 2, 0, 0, NULL),
			(3, 'example 3', 'serial 3', 1, 0, 0, NULL);";
		$DB->query($query) or die("error populate glpi_plugin_example ". $DB->error());

	}
	if (!TableExists("glpi_dropdown_plugin_example")){

		$query="CREATE TABLE `glpi_dropdown_plugin_example` (
			`ID` int(11) NOT NULL auto_increment,
			`name` varchar(255) collate utf8_unicode_ci default NULL,
			`comments` text collate utf8_unicode_ci,
			PRIMARY KEY  (`ID`),
			KEY `name` (`name`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

		$DB->query($query) or die("error creating glpi_dropdown_plugin_example". $DB->error());
		$query="INSERT INTO `glpi_dropdown_plugin_example` (`ID`, `name`, `comments`) VALUES
			(1, 'dp 1', 'comment 1'),
			(2, 'dp2', 'comment 2');";
		$DB->query($query) or die("error populate glpi_dropdown_plugin_example". $DB->error());

	}
	return true;
}

// Uninstall process for plugin : need to return true if succeeded
function plugin_example_uninstall(){
	global $DB;

	if (TableExists("glpi_plugin_example")){
		$query="DROP TABLE `glpi_plugin_example`;";
		$DB->query($query) or die("error creating glpi_plugin_example");
	}
	if (TableExists("glpi_dropdown_plugin_example")){

		$query="DROP TABLE `glpi_dropdown_plugin_example`;";
		$DB->query($query) or die("error creating glpi_dropdown_plugin_example");
	}
	return true;
}


// Optional : check prerequisites before install : may print errors or add to message after redirect
function plugin_example_check_prerequisites(){
	if (GLPI_VERSION>=0.72){
		return true;
	} else {
		echo "GLPI version not compatible need 0.72";
	}
}


// Uninstall process for plugin : need to return true if succeeded : may display messages or add to message after redirect
function plugin_example_check_config(){
	return true;
}



?>
