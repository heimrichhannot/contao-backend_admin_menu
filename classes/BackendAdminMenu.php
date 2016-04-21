<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2016 Heimrich & Hannot GmbH
 *
 * @author  Dennis Patzer <d.patzer@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\BackendAdminMenu;

use Contao\BackendTemplate;

class BackendAdminMenu
{
	protected $strTemplate = 'be_admin_menu';
	protected $strEntryTemplate = 'be_admin_menu_entry';

	public function addBackendAdminMenu($strBuffer, $strTemplate)
	{
		if ($strTemplate != 'be_main' || !\BackendUser::getInstance()->isAdmin)
			return $strBuffer;

		$objDoc = \phpQuery::newDocumentHTML($strBuffer);

		$objMenu = new BackendTemplate($this->strTemplate);
		$arrActions = array();

		// generate internal cache
		$objAction = new BackendTemplate($this->strEntryTemplate);
		$objAction->href = 'contao/main.php?do=maintenance&bic=1&rt=' . \RequestToken::get();
		$objAction->class = 'generate_internal_cache';
		$arrActions[] = $objAction->parse();

		// HOOK: add custom menu entries
		if (isset($GLOBALS['TL_HOOKS']['addBackendAdminMenuEntry']) && is_array($GLOBALS['TL_HOOKS']['addBackendAdminMenuEntry']))
		{
			foreach ($GLOBALS['TL_HOOKS']['addBackendAdminMenuEntry'] as $callback)
			{
				$this->import($callback[0]);
				$strAction = $this->$callback[0]->$callback[1]($this->strEntryTemplate, $this);

				if ($strAction !== false)
				{
					$arrActions[][] = $strAction;
				}
			}
		}

		$objMenu->actions = $arrActions;

		$objDoc['#tmenu']->prepend($objMenu->parse());

		return $objDoc->htmlOuter();
	}
}