<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_settings'];

/**
 * Palettes
 */
$arrDca['palettes']['default'] .= ';{backend_admin_menu_legend},backendAdminMenuActiveActions;';

/**
 * Fields
 */
$arrDca['fields']['backendAdminMenuActiveActions'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['backendAdminMenuActiveActions'],
	'inputType' => 'checkboxWizard',
	'options'   => array_keys($GLOBALS['TL_CONFIG']['backendAdminMenuActions']),
	'reference' => &$GLOBALS['TL_LANG']['MSC'],
	'eval'      => array('multiple' => true)
);