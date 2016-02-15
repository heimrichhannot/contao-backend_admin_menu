<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'HeimrichHannot',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'HeimrichHannot\BackendAdminMenu\BackendAdminMenu' => 'system/modules/backend_admin_menu/classes/BackendAdminMenu.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_admin_menu'       => 'system/modules/backend_admin_menu/templates',
	'be_admin_menu_entry' => 'system/modules/backend_admin_menu/templates',
));
