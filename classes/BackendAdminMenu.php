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
use HeimrichHannot\Haste\Util\StringUtil;

class BackendAdminMenu
{
	protected $strTemplate = 'be_admin_menu';
	protected $strEntryTemplate = 'be_admin_menu_entry';

	public function addBackendAdminMenu($strBuffer, $strTemplate)
	{
		if ($strTemplate != 'be_main' || !\BackendUser::getInstance()->isAdmin)
			return $strBuffer;

		// replace the scripts before processing -> https://code.google.com/archive/p/phpquery/issues/212
		$arrScripts = StringUtil::replaceScripts($strBuffer);
		$objDoc = \phpQuery::newDocumentHTML($arrScripts['content']);

		$objMenu = new BackendTemplate($this->strTemplate);
		$arrActions = array();
		$arrActiveActions = deserialize(\Config::get('backendAdminMenuActiveActions'), true);

		foreach (empty($arrActiveActions) ? array_keys(\Config::get('backendAdminMenuActions')) : $arrActiveActions as $strAction)
		{
			$arrActionData = $GLOBALS['TL_CONFIG']['backendAdminMenuActions'][$strAction];

			$objAction = new BackendTemplate($this->strEntryTemplate);
			$objAction->setData($arrActionData);

			// href = callback?
			if (is_array($arrActionData['href']) || is_callable($arrActionData['href'])) {
				$strClass  = $arrActionData['href'][0];
				$strMethod = $arrActionData['href'][1];
				$objInstance = \Controller::importStatic($strClass);
				$objAction->href = $objInstance->$strMethod();
			}

			$objAction->class = $strAction;
			$arrActions[] = $objAction->parse();
		}

		$objMenu->actions = $arrActions;

		$objDoc['#tmenu']->prepend($objMenu->parse());

		return StringUtil::unreplaceScripts($objDoc->htmlOuter(), $arrScripts['scripts']);
	}

	public static function getGenerateInternalCacheAction()
	{
		\RequestToken::initialize();
		return 'contao/main.php?do=maintenance&bic=1&rt=' . \RequestToken::get();
	}
}