<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2016 Heimrich & Hannot GmbH
 *
 * @author  Dennis Patzer <d.patzer@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['parseBackendTemplate']['addBackendAdminMenu'] =
	array('HeimrichHannot\BackendAdminMenu\BackendAdminMenu', 'addBackendAdminMenu');

/**
 * Actions
 */
$GLOBALS['TL_CONFIG']['backendAdminMenuActions'] = array(
	'generate_internal_cache' => array(
		'href' => array('HeimrichHannot\BackendAdminMenu\BackendAdminMenu', 'getGenerateInternalCacheAction'),
		'icon' => 'system/modules/backend_admin_menu/assets/img/generate_internal_cache.png'
	),
	'composer' => array(
		'href' => 'contao/main.php?do=composer',
		'icon' => 'system/modules/!composer/assets/images/icon.png'
	),
	'update_database' => array(
		'href' => 'contao/main.php?do=composer&update=database',
		'icon' => 'system/modules/!composer/assets/images/database_update.png'
	)
);

/**
 * JS
 */
if (TL_MODE == 'BE')
{
	$GLOBALS['TL_JAVASCRIPT']['mootools.backend_admin_menu.min.js'] =
			'system/modules/backend_admin_menu/assets/js/mootools.backend_admin_menu' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';
}

/**
 * CSS
 */
if (TL_MODE == 'BE')
{
	$GLOBALS['TL_CSS']['backend_admin_menu'] = 'system/modules/backend_admin_menu/assets/css/style.css|static';
}