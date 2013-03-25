<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!+
 * @author         Cristina Solana http://nightshiftcreative.com
 * @author         Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright      Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

// Call the Construct Template Helper Class
if (JFile::exists(dirname(__FILE__) . '/helper.php')) {
	include dirname(__FILE__) . '/helper.php';
}

// To get an application object
$app = JFactory::getApplication();
// Returns a reference to the global document object
$doc = JFactory::getDocument();
// Returns a reference to the global language object
$lang = JFactory::getLanguage();
// Returns a reference to the menu object
$menu = $app->getMenu();
// Checks for any system messages
$messageQueue = $app->getMessageQueue();
// Define relative path to the  current template directory
$template = 'templates/' . $this->template;
// Define absolute path to the template directory
$templateDir = JPATH_THEMES . '/' . $this->template;
// Get the current URL
$url = clone(JURI::getInstance());
// To access the current user object
$user = JFactory::getUser();
// Get the current view
$view = JRequest::getCmd('view');

// The default menu item
$default = $menu->getActive() == $menu->getDefault($lang->getTag());

// Define shortcuts for template parameters
$customStyleSheet        = $this->params->get('customStyleSheet');
$customStyleSheetVersion = htmlspecialchars($this->params->get('customStyleSheetVersion'));
$fluidMedia              = $this->params->get('fluidMedia');
$fullWidth               = $this->params->get('fullWidth');
$googleWebFont           = $this->params->get('googleWebFont');
$googleWebFontSubset     = $this->params->get('googleWebFontSubset');
$googleWebFontTargets    = htmlspecialchars($this->params->get('googleWebFontTargets'));
$googleWebFont2          = $this->params->get('googleWebFont2');
$googleWebFontSubset2    = $this->params->get('googleWebFontSubset2');
$googleWebFontTargets2   = htmlspecialchars($this->params->get('googleWebFontTargets2'));
$googleWebFont3          = $this->params->get('googleWebFont3');
$googleWebFontSubset3    = $this->params->get('googleWebFontSubset3');
$googleWebFontTargets3   = htmlspecialchars($this->params->get('googleWebFontTargets3'));
$gridSystem              = $this->params->get('gridSystem');
$IECSS3                  = $this->params->get('IECSS3');
$IECSS3Targets           = htmlspecialchars($this->params->get('IECSS3Targets'));
$inheritLayout           = $this->params->get('inheritLayout');
$inheritStyle            = $this->params->get('inheritStyle');
$loadJui                 = $this->params->get('loadJui');
$loadMoo                 = $this->params->get('loadMoo');
$loadModal               = $this->params->get('loadModal');
$mooExceptions           = htmlspecialchars($this->params->get('mooExceptions'));
$setGeneratorTag         = htmlspecialchars($this->params->get('setGeneratorTag'));
$showDiagnostics         = $this->params->get('showDiagnostics');
$siteWidth               = htmlspecialchars($this->params->get('siteWidth'));
$siteWidthType           = $this->params->get('siteWidthType');
$siteWidthUnit           = $this->params->get('siteWidthUnit');
$stickyFooterHeight      = htmlspecialchars($this->params->get('stickyFooterHeight'));
$useStickyFooter         = $this->params->get('useStickyFooter');

// Get the template's XML for versioning
$xmlfile = $templateDir . '/templateDetails.xml';
$data    = JApplicationHelper::parseXMLInstallFile($xmlfile);
$version = $data['version'];

// Define fallback version number for custom style sheet
if ($customStyleSheetVersion == '') {
	$customStyleSheetVersion = $version;
}

// Change generator tag
$this->setGenerator($setGeneratorTag);

// Current component Name
$currentComponent = JRequest::getCmd('option');

// Turn $mooExceptions into an array, remove spaces from input
$mooExceptions = explode(',', str_replace(' ', '', $mooExceptions));

// Remove MooTools if set to no.
if (!$loadMoo && !in_array($currentComponent, $mooExceptions)) {
	unset($doc->_scripts[$this->baseurl . '/media/system/js/mootools-core.js']);
	unset($doc->_scripts[$this->baseurl . '/media/system/js/mootools-more.js']);
	unset($doc->_scripts[$this->baseurl . '/media/system/js/core.js']);
	unset($doc->_scripts[$this->baseurl . '/media/system/js/caption.js']);
	unset($doc->_scripts[$this->baseurl . '/media/system/js/modal.js']);
}

// Change Google Web Font name for CSS
$googleWebFontFamily  = str_replace(array('+', ':bold', ':italic'), " ", $googleWebFont);
$googleWebFontFamily2 = str_replace(array('+', ':bold', ':italic'), " ", $googleWebFont2);
$googleWebFontFamily3 = str_replace(array('+', ':bold', ':italic'), " ", $googleWebFont3);

// Get the name of the extended template override group
$overrideTheme = str_replace(".css", "", $customStyleSheet);

#----------------------------- Module Counts -----------------------------#
// from http://groups.google.com/group/joomla-dev-general/browse_thread/thread/b54f3f131dd173d

$headerAboveCount1 = (int) ($this->countModules('header-above-1') > 0);
$headerAboveCount2 = (int) ($this->countModules('header-above-2') > 0);
$headerAboveCount3 = (int) ($this->countModules('header-above-3') > 0);
$headerAboveCount4 = (int) ($this->countModules('header-above-4') > 0);
$headerAboveCount5 = (int) ($this->countModules('header-above-5') > 0);
$headerAboveCount6 = (int) ($this->countModules('header-above-6') > 0);

$headerAboveCount = $headerAboveCount1 + $headerAboveCount2 + $headerAboveCount3 + $headerAboveCount4 + $headerAboveCount5 + $headerAboveCount6;

if ($headerAboveCount) : $headerAboveClass = 'span' . strtr((12 / $headerAboveCount), array("." => "-")); endif;

#--------------------------------------------------------------------------#

$headerBelowCount1 = (int) ($this->countModules('header-below-1') > 0);
$headerBelowCount2 = (int) ($this->countModules('header-below-2') > 0);
$headerBelowCount3 = (int) ($this->countModules('header-below-3') > 0);
$headerBelowCount4 = (int) ($this->countModules('header-below-4') > 0);
$headerBelowCount5 = (int) ($this->countModules('header-below-5') > 0);
$headerBelowCount6 = (int) ($this->countModules('header-below-6') > 0);

$headerBelowCount = $headerBelowCount1 + $headerBelowCount2 + $headerBelowCount3 + $headerBelowCount4 + $headerBelowCount5 + $headerBelowCount6;

if ($headerBelowCount) : $headerBelowClass = 'span' . strtr((12 / $headerBelowCount), array("." => "-")); endif;

#--------------------------------------------------------------------------#

$navBelowCount1 = (int) ($this->countModules('nav-below-1') > 0);
$navBelowCount2 = (int) ($this->countModules('nav-below-2') > 0);
$navBelowCount3 = (int) ($this->countModules('nav-below-3') > 0);
$navBelowCount4 = (int) ($this->countModules('nav-below-4') > 0);
$navBelowCount5 = (int) ($this->countModules('nav-below-5') > 0);
$navBelowCount6 = (int) ($this->countModules('nav-below-6') > 0);

$navBelowCount = $navBelowCount1 + $navBelowCount2 + $navBelowCount3 + $navBelowCount4 + $navBelowCount5 + $navBelowCount6;

if ($navBelowCount) : $navBelowClass = 'span' . strtr((12 / $navBelowCount), array("." => "-")); endif;

#--------------------------------------------------------------------------#

$contentAboveCount1 = (int) ($this->countModules('content-above-1') > 0);
$contentAboveCount2 = (int) ($this->countModules('content-above-2') > 0);
$contentAboveCount3 = (int) ($this->countModules('content-above-3') > 0);
$contentAboveCount4 = (int) ($this->countModules('content-above-4') > 0);
$contentAboveCount5 = (int) ($this->countModules('content-above-5') > 0);
$contentAboveCount6 = (int) ($this->countModules('content-above-6') > 0);

$contentAboveCount = $contentAboveCount1 + $contentAboveCount2 + $contentAboveCount3 + $contentAboveCount4 + $contentAboveCount5 + $contentAboveCount6;

if ($contentAboveCount) : $contentAboveClass = 'span' . strtr((12 / $contentAboveCount), array("." => "-")); endif;

#--------------------------------------------------------------------------#

$contentBelowCount1 = (int) ($this->countModules('content-below-1') > 0);
$contentBelowCount2 = (int) ($this->countModules('content-below-2') > 0);
$contentBelowCount3 = (int) ($this->countModules('content-below-3') > 0);
$contentBelowCount4 = (int) ($this->countModules('content-below-4') > 0);
$contentBelowCount5 = (int) ($this->countModules('content-below-5') > 0);
$contentBelowCount6 = (int) ($this->countModules('content-below-6') > 0);

$contentBelowCount = $contentBelowCount1 + $contentBelowCount2 + $contentBelowCount3 + $contentBelowCount4 + $contentBelowCount5 + $contentBelowCount6;

if ($contentBelowCount) : $contentBelowClass = 'span' . strtr((12 / $contentBelowCount), array("." => "-")); endif;

#--------------------------------------------------------------------------#

$footerAboveCount1 = (int) ($this->countModules('footer-above-1') > 0);
$footerAboveCount2 = (int) ($this->countModules('footer-above-2') > 0);
$footerAboveCount3 = (int) ($this->countModules('footer-above-3') > 0);
$footerAboveCount4 = (int) ($this->countModules('footer-above-4') > 0);
$footerAboveCount5 = (int) ($this->countModules('footer-above-5') > 0);
$footerAboveCount6 = (int) ($this->countModules('footer-above-6') > 0);

$footerAboveCount = $footerAboveCount1 + $footerAboveCount2 + $footerAboveCount3 + $footerAboveCount4 + $footerAboveCount5 + $footerAboveCount6;

if ($footerAboveCount) : $footerAboveClass = 'span' . strtr((12 / $footerAboveCount), array("." => "-")); endif;

#------------------------------ Column Layout -----------------------------#

$column1Count          = (int) ($this->countModules('column-1') > 0);
$column2Count          = (int) ($this->countModules('column-2') > 0);
$columnGroupAlphaCount = $column1Count + $column2Count;

if ($columnGroupAlphaCount) : $columnGroupAlphaClass = 'span' . 12 / $columnGroupAlphaCount; endif;

$column3Count         = (int) ($this->countModules('column-3') > 0);
$column4Count         = (int) ($this->countModules('column-4') > 0);
$columnGroupBetaCount = $column3Count + $column4Count;

if ($columnGroupBetaCount) : $columnGroupBetaClass = 'span' . 12 / $columnGroupBetaCount; endif;

if ($columnGroupAlphaCount == 1) {
	$mainSpan       = '9';
	$alphaSpan      = '3';
	$groupAlphaSpan = '12';
} elseif ($columnGroupAlphaCount == 2) {
	$mainSpan       = '6';
	$alphaSpan      = '6';
	$groupAlphaSpan = '6';
} else {
	$mainSpan = '12';
}

if ($columnGroupBetaCount == 1) {
	$firstSpan     = '10';
	$betaSpan      = '2';
	$groupBetaSpan = '12';
} elseif ($columnGroupBetaCount == 2) {
	$firstSpan     = '8';
	$betaSpan      = '4';
	$groupBetaSpan = '6';
} else {
	$firstSpan = '12';
}

#-------------------------------- Item ID ---------------------------------#

$itemId = JRequest::getInt('Itemid', 0);

#------------------------------- Article ID -------------------------------#

if ($view == 'article') {
	$articleId = JRequest::getInt('id');
} else {
	($articleId = NULL);
}

#------------------------------- Section ID -------------------------------#

function getSection($id) {
	$database = JFactory::getDBO();
	if ((substr(JVERSION, 0, 3) >= '1.6')) {
		return NULL;
	} elseif (JRequest::getCmd('view', 0) == "section") {
		return $id;
	} elseif (JRequest::getCmd('view', 0) == "category") {
		$sql = "SELECT section FROM #__categories WHERE id = $id ";
		$database->setQuery($sql);

		return $database->loadResult();
	} elseif (JRequest::getCmd('view', 0) == "article") {
		$temp = explode(":", $id);
		$sql  = "SELECT sectionid FROM #__content WHERE id = " . $temp[0];
		$database->setQuery($sql);

		return $database->loadResult();
	}
}

$sectionId = getSection(JRequest::getInt('id'));

#------------------------------ Category ID -------------------------------#

function getCategory($id) {
	$database = JFactory::getDBO();
	if (JRequest::getCmd('view', 0) == "section") {
		return NULL;
	} elseif ((JRequest::getCmd('view', 0) == "category") || (JRequest::getCmd('view', 0) == "categories")) {
		return $id;
	} elseif (JRequest::getCmd('view', 0) == "article") {
		$temp = explode(":", $id);
		$sql  = "SELECT catid FROM #__content WHERE id = " . $temp[0];
		$database->setQuery($sql);

		return $database->loadResult();
	}
}

$catId = getCategory(JRequest::getInt('id'));

#------------------------- Ancestor Category IDs --------------------------#

if ($catId && ($inheritStyle || $inheritLayout)) {

	function getParentCategory($id) {
		$database = JFactory::getDBO();
		$sql      = "SELECT parent_id
        FROM #__categories
        WHERE id = $id";
		$database->setQuery($sql);

		return $database->loadResult();
	}

	$parentCategory = getParentCategory($catId);

	function getAncestorCategories($id) {
		$database = JFactory::getDBO();
		$sql      = "SELECT b.id, b.title
        FROM #__categories a,
        #__categories b
        WHERE a.id = $id
        AND a.lft > b.lft
        AND a.rgt < b.rgt
        AND a.id <> b.id
        AND b.lft > 0";
		$database->setQuery($sql);

		return $database->loadObjectList();
	}
}

#--------------------------------- Alias ----------------------------------#

if ($itemId) {
	$currentAlias = $app->getMenu()->getActive()->alias;
}

#----------------------------- Component Name -----------------------------#

$currentComponent = JRequest::getCmd('option');

#------------------Extended Template Style Overrides------------------------#

$styleOverride = new ConstructTemplateHelper ();

$styleOverride->includeFile = array();

$styleOverride->includeFile[] = $template . '/css/article/' . $overrideTheme . '-article-' . $articleId . '.css';
$styleOverride->includeFile[] = $template . '/css/article/article-' . $articleId . '.css';
$styleOverride->includeFile[] = $template . '/css/article/article.css';
$styleOverride->includeFile[] = $template . '/css/item/' . $overrideTheme . '-item-' . $itemId . '.css';
$styleOverride->includeFile[] = $template . '/css/item/item-' . $itemId . '.css';
$styleOverride->includeFile[] = $template . '/css/category/' . $overrideTheme . '-category-' . $catId . '.css';
$styleOverride->includeFile[] = $template . '/css/category/category-' . $catId . '.css';
if ($catId && $inheritStyle) {
	$styleOverride->includeFile[] = $template . '/css/category/category-' . $parentCategory . '.css';

	$results = getAncestorCategories($catId);
	if (count($results) > 0) {
		foreach ($results as $result) {
			$styleOverride->includeFile[] = $template . '/css/category/category-' . $result->id . '.css';
		}
	}
}
if ($view == 'category') {
	$styleOverride->includeFile[] = $template . '/css/category/category.css';
}
if ($view == 'categories') {
	$styleOverride->includeFile[] = $template . '/css/category/categories.css';
}
$styleOverride->includeFile[] = $template . '/css/section/' . $overrideTheme . '-section-' . $sectionId . '.css';
$styleOverride->includeFile[] = $template . '/css/section/section-' . $sectionId . '.css';
$styleOverride->includeFile[] = $template . '/css/section/section.css';
$styleOverride->includeFile[] = $template . '/css/component/' . $currentComponent . '.css';
$styleOverride->includeFile[] = $template . '/css/component/' . $overrideTheme . '-' . $currentComponent . '.css';

#---------------Mobile Extended Template Style Overrides---------------------#

$mobileStyleOverride = new ConstructTemplateHelper ();

$mobileStyleOverride->includeFile = array();

$mobileStyleOverride->includeFile[] = $template . '/css/article/article-' . $articleId . '-mobile.css';
$mobileStyleOverride->includeFile[] = $template . '/css/item/item-' . $itemId . '-mobile.css';
$mobileStyleOverride->includeFile[] = $template . '/css/category/category-' . $catId . '-mobile.css';
$mobileStyleOverride->includeFile[] = $template . '/css/section/section-' . $sectionId . '-mobile.css';
$mobileStyleOverride->includeFile[] = $template . '/css/component/' . $currentComponent . '-mobile.css';

#-------------------Extended Template Layout Overrides-----------------------#

$layoutOverride = new ConstructTemplateHelper ();

$layoutOverride->includeFile = array();

$layoutOverride->includeFile[] = $template . '/layouts/article/' . $overrideTheme . '-article-' . $articleId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/article/article-' . $articleId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/article/article.php';
$layoutOverride->includeFile[] = $template . '/layouts/item/' . $overrideTheme . '-item-' . $itemId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/item/item-' . $itemId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/category/' . $overrideTheme . '-category-' . $catId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/category/category-' . $catId . '.php';
if ($catId && $inheritLayout) {
	$layoutOverride->includeFile[] = $template . '/layouts/category/category-' . $parentCategory . '.php';

	$results = getAncestorCategories($catId);
	if (count($results) > 0) {
		foreach ($results as $result) {
			$layoutOverride->includeFile[] = $template . '/layouts/category/category-' . $result->id . '.php';
		}
	}
}
if ($view == 'category') {
	$layoutOverride->includeFile[] = $template . '/layouts/category/category.php';
}
if ($view == 'categories') {
	$layoutOverride->includeFile[] = $template . '/layouts/category/categories.php';
}
$layoutOverride->includeFile[] = $template . '/layouts/section/' . $overrideTheme . '-section-' . $sectionId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/section/section-' . $sectionId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/section/section.php';
$layoutOverride->includeFile[] = $template . '/layouts/component/' . $overrideTheme . '-' . $currentComponent . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/component/' . $currentComponent . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/' . $overrideTheme . '-index.php';
$layoutOverride->includeFile[] = $template . '/layouts/index.php';

#---------------Mobile Extended Template Layout Overrides--------------------#

$mobileLayoutOverride = new ConstructTemplateHelper ();

$mobileLayoutOverride->includeFile = array();

$mobileLayoutOverride->includeFile[] = $template . '/layouts/article/article-' . $articleId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/item/item-' . $itemId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/category/category-' . $catId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/category/category-' . $catId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/category/category-' . $catId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/component/' . $currentComponent . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/mobile.php';

#---------------------------- Head Elements --------------------------------#

// Always force latest IE rendering engine (even in intranet) & Chrome Frame
$doc->setMetadata('X-UA-Compatible', 'IE=edge,chrome=1');
// Set initial scale of mobile viewport to 100% - see http://bit.ly/sK7Zty
$doc->setMetadata('viewport', 'width=device-width, initial-scale=1.0');
// Define copyright of site content
$doc->setMetadata('copyright', htmlspecialchars($app->getCfg('sitename')));

// Site icons
$doc->addFavicon($template . '/favicon.png', 'image/png', 'shortcut icon');
$doc->addFavicon($template . '/apple-touch-icon.png', 'image/png', 'apple-touch-icon');

if ($loadJui) {
// Load core Bootstrap CSS and Bootstrap bugfixes
	JHtmlBootstrap::loadCss($includeMaincss = TRUE, $this->direction);
// Load additonal Bootstruct core CSS
	$doc->addStyleSheet($template . '/css/bootstruct.css?' . $version, 'text/css', 'screen');
}

if ($gridSystem != '-1') {
	$doc->addStyleSheet($template . '/css/grids/' . $gridSystem . '?' . $version, 'text/css', 'screen');
}
if ($customStyleSheet > -1) {
	$doc->addStyleSheet($template . '/css/' . $customStyleSheet . '?' . $customStyleSheetVersion, 'text/css', 'screen');
}
if ($this->direction == 'rtl') {
	$doc->addStyleSheet($template . '/css/rtl.css?' . $version, 'text/css', 'screen');
}
// Override style sheet returned from our template helper
$cssFile = $styleOverride->getIncludeFile();
if ($cssFile) {
	$doc->addStyleSheet($cssFile . '?' . $version, 'text/css', 'screen');
}

// Typography
if ($googleWebFont) {
	$googleWebFont = 'http://fonts.googleapis.com/css?family=' . $googleWebFont;
	if ($googleWebFontSubset) {
		$googleWebFont = $googleWebFont . '&subset=' . $googleWebFontSubset;
	}
	$doc->addStyleSheet($googleWebFont);
	$doc->addStyleDeclaration($googleWebFontTargets . ' {font-family:' . $googleWebFontFamily . ', serif;}');
}
if ($googleWebFont2) {
	$googleWebFont2 = 'http://fonts.googleapis.com/css?family=' . $googleWebFont2;
	if ($googleWebFontSubset) {
		$googleWebFont2 = $googleWebFont2 . '&subset=' . $googleWebFontSubset2;
	}
	$doc->addStyleSheet($googleWebFont2);
	$doc->addStyleDeclaration($googleWebFontTargets2 . ' {font-family:' . $googleWebFontFamily2 . ', serif;}');
}
if ($googleWebFont3) {
	$googleWebFont3 = 'http://fonts.googleapis.com/css?family=' . $googleWebFont3;
	if ($googleWebFontSubset) {
		$googleWebFont3 = $googleWebFont3 . '&subset=' . $googleWebFontSubset3;
	}
	$doc->addStyleSheet($googleWebFont3);
	$doc->addStyleDeclaration($googleWebFontTargets3 . ' {font-family:' . $googleWebFontFamily3 . ', serif;}');
}

// JavaScript
$doc->addScriptDeclaration('(function($){$().ready(function(){$("html.no-js").removeClass("no-js").addClass("js");});})(jQuery);');
// Load JUI jQuery and Bootstrap JS, including jQuery noConflict
JHtml::_('bootstrap.framework');
// Example to load additional jQuery UI plugins - http://docs.joomla.org/Javascript_Frameworks#JQuery_UI_Framework
//JHtml::_('jquery.ui', array('core', 'sortable'));

// Layout Declarations
if ($siteWidth) {
	$doc->addStyleDeclaration('#body-container, #header-above, #primary-nav .container {' . $siteWidthType . ':' . $siteWidth . $siteWidthUnit . ';}');
}
if (($siteWidthType == 'max-width') && $fluidMedia) {
	$doc->addStyleDeclaration('img, object {max-width:100%;}');
}
if ($siteWidth && !$fullWidth) {
	$doc->addStyleDeclaration('#header, #footer {' . $siteWidthType . ':' . $siteWidth . $siteWidthUnit . '; margin:0 auto;}');
}
if ($useStickyFooter && $stickyFooterHeight != '') {
	$doc->addStyleDeclaration('.sticky-footer #body-container {padding-bottom:' . $stickyFooterHeight . 'px;}');
	$doc->addStyleDeclaration('.sticky-footer #footer {margin-top:-' . $stickyFooterHeight . 'px;height:' . $stickyFooterHeight . 'px;}');
}

// Internet Explorer Fixes
$doc->addCustomTag('<!--[if lt IE 9]>');
$doc->addCustomTag('<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>');
if ($IECSS3) {
	$doc->addCustomTag('<style type="text/css">' . $IECSS3Targets . ' {behavior:url("' . $this->baseurl . '/templates/' . $this->template . '/js/PIE.htc")}</style>');
}
$doc->addCustomTag('<![endif]-->');
