<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

// --- Get extension configuration ---
$extConf = array();
if ( strlen($_EXTCONF) ) {
	$extConf = unserialize($_EXTCONF);
}

/* --------------------------------------
 * Default bootstrap_core page TSconfig
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_core/Configuration/TypoScript/tsconfig.ts">');


/* --------------------------------------
 * .htaccess (for realurl)
 */
if (TYPO3_MODE === 'BE') {
	// Creates a .htaccess file
	$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher');
	$signalSlotDispatcher->connect(
		'TYPO3\\CMS\\Extensionmanager\\Service\\ExtensionManagementService',
		'hasInstalledExtensions',
		'Laxap\\BootstrapCore\\Service\\InstallService',
		'generateConfigFiles'
	);
}

?>