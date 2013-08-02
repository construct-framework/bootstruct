<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2013 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

// Load Joomla filesystem package
jimport('joomla.filesystem.file');

// Load template logic
$logicFile = JPATH_THEMES . '/' . $this->template . '/elements/logic.php';
if (JFile::exists($logicFile)) {
    include $logicFile;
}

// Mobile device detection
$mTemplate = JPATH_THEMES . '/' . $this->template . '/mobile-offline.php';

// Initialize mobile device detection
if (JFile::exists($mdetectFile)) {
    include_once $mdetectFile;
    // Instantiate the mobile object class
    $uagent_obj = new uagent_info();
    $isMobile = $uagent_obj->DetectMobileLong();
    $isTablet = $uagent_obj->DetectTierTablet();
}

// Check if mobile device has opted for desktop version
if (isset($_GET['viewDesktop'])) {
    $_SESSION['viewDesktop'] = $_GET['viewDesktop'];
}

// Check if mobile device detection is turned on and test if visitor is a mobile device. If so, load mobile version
if ((($mdetect && $isMobile) || ($mdetect && $detectTablets && $isTablet)) && (!isset($_SESSION['viewDesktop']))) {
    if (JFile::exists($mTemplate)) {
        include_once $mTemplate;
    }
} // Check for layout override
elseif (JFile::exists($template . '/layouts/offline.php')) {
    include_once $template . '/layouts/offline.php';
}
else {
    ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if gt IE 8]> <!--> <html class="no-js" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <!--<![endif]-->
<head>
    <jdoc:include type="head" />
</head>

<body id="page-top" class="<?php echo $columnLayout; if ($useStickyFooter) echo ' sticky-footer'; echo ' ' . $currentComponent; if ($articleId) echo ' article-' . $articleId; if ($itemId) echo ' item-' . $itemId; if ($catId) echo ' category-' . $catId; ?>">

<div id="footer-push">

    <?php if ($headerAboveCount) : ?>
<div id="header-above" class="clearfix">
    <?php if ($this->countModules('header-above-1')) : ?>
    <div id="header-above-1" class="<?php echo $headerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-above-2')) : ?>
    <div id="header-above-2" class="<?php echo $headerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-above-3')) : ?>
    <div id="header-above-3" class="<?php echo $headerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-above-4')) : ?>
    <div id="header-above-4" class="<?php echo $headerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-above-5')) : ?>
    <div id="header-above-5" class="<?php echo $headerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-above-6')) : ?>
    <div id="header-above-6" class="<?php echo $headerAboveClass ?>">

    </div>
    <?php endif ?>
</div>
    <?php endif ?>

<header id="header" class="clear clearfix">
    <div class="gutter clearfix">

        <div class="date-container">
            <span class="date-weekday"><?php    $now = JFactory::getDate(); echo $now->toFormat('%A') . ',' ?></span>
            <span class="date-month"><?php         $now = JFactory::getDate(); echo $now->toFormat('%B') ?></span>
            <span class="date-day"><?php         $now = JFactory::getDate(); echo $now->toFormat('%d') . ',' ?></span>
            <span class="date-year"><?php         $now = JFactory::getDate(); echo $now->toFormat('%Y') ?></span>
        </div>

        <?php if ($showDiagnostics) : ?>
        <ul id="diagnostics">
            <li>column layout <?php echo $columnLayout ?></li>
            <li>component <?php echo $currentComponent ?></li>
            <?php if ($view) echo '<li>' . $view . ' view</li>' ?>
            <?php if ($articleId) echo '<li>article ' . $articleId . '</li>' ?>
            <?php if ($itemId) echo '<li>menu item ' . $itemId . '</li>' ?>
            <?php if ($catId) echo '<li>category ' . $catId . '</li>' ?>
            <?php if ($catId && ($inheritStyle || $inheritLayout)) {
            if ($parentCategory) {
                echo '<li>parent category ' . $parentCategory . '</li>';
            }
            $results = getAncestorCategories($catId);
            if ($results) {
                echo '<li>ancestor categories';
                if (count($results) > 0) {
                    foreach ($results as $item) {
                        echo ' ' . $item->id . ' ';
                    }
                }
                echo'</li>';
            }
        } ?>
        </ul>
        <?php endif ?>

        <h1 id="logo">
            <a href="<?php echo $this->baseurl ?>/" title="<?php echo htmlspecialchars($app->getCfg('sitename')) ?>"><?php echo htmlspecialchars($app->getCfg('sitename')) ?></a>
        </h1>

        <?php if ($this->countModules('header')) : ?>
        <jdoc:include type="modules" name="header" style="jexhtml" />
        <?php endif ?>

        <nav>
            <ul id="access">
                <li>Jump to:</li>
                <li>
                    <a href="<?php $url->setFragment('content'); echo $url->toString() ?>" class="to-content">Content</a>
                </li>
                <?php if ($this->countModules('nav')) : ?>
                <li><a href="<?php $url->setFragment('nav'); echo $url->toString() ?>" class="to-nav">Navigation</a>
                </li>
                <?php endif ?>
                <?php if ($contentBelowCount) : ?>
                <li>
                    <a href="<?php $url->setFragment('additional'); echo $url->toString() ?>" class="to-additional">Additional Information</a>
                </li>
                <?php endif ?>
            </ul>
        </nav>

        <?php if ($enableSwitcher) : ?>
        <ul id="style-switch">
            <li class="narrow">
                <a href="#" onclick="setActiveStyleSheet('diagnostic'); return false;" title="Diagnostic">Diagnostic Mode</a>
            </li>
            <li class="wide">
                <a href="#" onclick="setActiveStyleSheet('normal'); return false;" title="Normal">Normal Mode</a></li>
        </ul>
        <?php endif ?>

    </div>
</header>

<section id="body-container">

    <?php if ($headerBelowCount) : ?>
<div id="header-below" class="clearfix">
    <?php if ($this->countModules('header-below-1')) : ?>
    <div id="header-below-1" class="<?php echo $headerBelowClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-below-2')) : ?>
    <div id="header-below-2" class="<?php echo $headerBelowClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-below-3')) : ?>
    <div id="header-below-3" class="<?php echo $headerBelowClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-below-4')) : ?>
    <div id="header-below-4" class="<?php echo $headerBelowClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-below-5')) : ?>
    <div id="header-below-5" class="<?php echo $headerBelowClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('header-below-6')) : ?>
    <div id="header-below-6" class="<?php echo $headerBelowClass ?>">

    </div>
    <?php endif ?>
</div>
    <?php endif ?>

<div id="content-container" class="clear clearfix">

    <?php if ($navBelowCount) : ?>
<div id="nav-below" class="clearfix">
    <?php if ($this->countModules('nav-below-1')) : ?>
    <div id="nav-below-1" class="<?php echo $navBelowClass ?>">

    </div>
    <?php endif ?>

    <?php if ($this->countModules('nav-below-2')) : ?>
    <div id="nav-below-2" class="<?php echo $navBelowClass ?>">

    </div>
    <?php endif ?>

    <?php if ($this->countModules('nav-below-3')) : ?>
    <div id="nav-below-3" class="<?php echo $navBelowClass ?>">

    </div>
    <?php endif ?>

    <?php if ($this->countModules('nav-below-4')) : ?>
    <div id="nav-below-4" class="<?php echo $navBelowClass ?>">

    </div>
    <?php endif ?>

    <?php if ($this->countModules('nav-below-5')) : ?>
    <div id="nav-below-5" class="<?php echo $navBelowClass ?>">

    </div>
    <?php endif ?>

    <?php if ($this->countModules('nav-below-6')) : ?>
    <div id="nav-below-6" class="<?php echo $navBelowClass ?>">

    </div>
    <?php endif ?>
</div>
    <?php endif ?>

<div id="load-first" class="clearfix">
    <a id="content" name="content"></a>

    <div id="content-main">
        <div class="gutter">

            <?php if ($contentAboveCount) : ?>
            <div id="content-above" class="clearfix">
                <?php if ($this->countModules('content-above-1')) : ?>
                <div id="content-above" class="<?php echo $contentAboveClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-above-2')) : ?>
                <div id="content-above-2" class="<?php echo $contentAboveClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-above-3')) : ?>
                <div id="content-above-3" class="<?php echo $contentAboveClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-above-4')) : ?>
                <div id="content-above-4" class="<?php echo $contentAboveClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-above-5')) : ?>
                <div id="content-above-5" class="<?php echo $contentAboveClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-above-6')) : ?>
                <div id="content-above-6" class="<?php echo $contentAboveClass ?>">

                </div>
                <?php endif ?>

            </div>
            <?php endif ?>

            <?php if (substr(JVERSION, 0, 3) >= '1.6') { ?>

            <div id="offline">
                <?php if ($this->countModules('offline')) : ?>
                <jdoc:include type="modules" name="offline" style="jexhtml" />
                <?php endif ?>

                <?php if (!empty($messageQueue)) : ?>
                <jdoc:include type="message" />
                <?php endif ?>

                <h3><?php echo $app->getCfg('offline_message') ?></h3>

                <form action="<?php echo JRoute::_('index.php', true) ?>" method="post" id="form-login">
                    <fieldset class="input">
                        <label id="form-login-username" for="username"><?php echo JText::_('JGLOBAL_USERNAME') ?>
                            <input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME') ?>" size="18" />
                        </label>
                        <label id="form-login-password" for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?>
                            <input type="password" name="password" class="inputbox" size="18" alt="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" id="passwd" />
                        </label>
                        <label id="form-login-remember" for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>
                            <input type="checkbox" name="remember" class="inputbox" value="yes" alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" id="remember" />
                        </label>
                        <input type="submit" name="Submit" class="button btn" value="<?php echo JText::_('JLOGIN') ?>" />
                        <input type="hidden" name="option" value="com_users" />
                        <input type="hidden" name="task" value="user.login" />
                        <input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
                        <?php echo JHtml::_('form.token') ?>
                    </fieldset>
                </form>
            </div>

            <?php
        }
        else {
            ?>

            <div id="offline">
                <?php if ($this->countModules('offline')) : ?>
                <jdoc:include type="modules" name="offline" style="jexhtml" />
                <?php endif ?>

                <?php if (!empty($messageQueue)) : ?>
                <jdoc:include type="message" />
                <?php endif ?>

                <h3><?php echo $app->getCfg('offline_message') ?></h3>
                <?php if (JPluginHelper::isEnabled('authentication', 'openid')) : ?>
                <?php JHtml::_('script', 'openid.js') ?>
                <?php endif ?>
                <form action="index.php" method="post" name="login" id="form-login">
                    <fieldset class="input">
                        <label id="form-login-username" for="username"><?php echo JText::_('Username') ?>
                            <input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('Username') ?>" size="18" />
                        </label>
                        <label id="form-login-password" for="passwd"><?php echo JText::_('Password') ?>
                            <input type="password" name="passwd" class="inputbox" size="18" alt="<?php echo JText::_('Password') ?>" id="passwd" />
                        </label>
                        <label id="form-login-remember" for="remember"><?php echo JText::_('Remember me') ?>
                            <input type="checkbox" name="remember" class="inputbox" value="yes" alt="<?php echo JText::_('Remember me') ?>" id="remember" />
                        </label>
                        <input type="submit" name="Submit" class="button btn" value="<?php echo JText::_('LOGIN') ?>" />
                    </fieldset>
                    <input type="hidden" name="option" value="com_user" />
                    <input type="hidden" name="task" value="login" />
                    <input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
                    <?php echo JHtml::_('form.token') ?>
                </form>
            </div>

            <?php } ?>

            <?php if ($contentBelowCount) : ?>
            <div id="content-below" class="clearfix">
                <?php if ($this->countModules('content-below-1')) : ?>
                <div id="content-below-1" class="<?php echo $contentBelowClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-below-2')) : ?>
                <div id="content-below-2" class="<?php echo $contentBelowClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-below-3')) : ?>
                <div id="content-below-3" class="<?php echo $contentBelowClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-below-4')) : ?>
                <div id="content-below-4" class="<?php echo $contentBelowClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-below-5')) : ?>
                <div id="content-below-5" class="<?php echo $contentBelowClass ?>">

                </div>
                <?php endif ?>

                <?php if ($this->countModules('content-below-6')) : ?>
                <div id="content-below-6" class="<?php echo $contentBelowClass ?>">

                </div>
                <?php endif ?>

            </div>
            <?php endif ?>

        </div>
    </div>

    <?php if ($columnGroupAlphaCount) : ?>
    <div id="column-group-alpha" class="clearfix">
        <div class="gutter clearfix">
            <?php if ($this->countModules('column-1')) : ?>
            <div id="column-1" class="<?php echo $columnGroupAlphaClass ?>">

            </div>
            <?php endif ?>
            <?php if ($this->countModules('column-2')) : ?>
            <div id="column-2" class="<?php echo $columnGroupAlphaClass ?>">

            </div>
            <?php endif ?>
        </div>
    </div>
    <?php endif ?>

</div>

    <?php if ($columnGroupBetaCount) : ?>
<div id="column-group-beta" class="clearfix">
    <div class="gutter clearfix">
        <?php if ($this->countModules('column-3')) : ?>
        <div id="column-group-beta-1" class="<?php echo $columnGroupBetaClass ?>">

        </div>
        <?php endif ?>
        <?php if ($this->countModules('column-4')) : ?>
        <div id="column-4" class="<?php echo $columnGroupBetaClass ?>">

        </div>
        <?php endif ?>
    </div>
</div>
    <?php endif ?>

    <?php if ($footerAboveCount) : ?>
<div id="footer-above" class="clearfix">
    <?php if ($this->countModules('footer-above-1')) : ?>
    <div id="footer-above-1" class="<?php echo $footerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('footer-above-2')) : ?>
    <div id="footer-above-2" class="<?php echo $footerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('footer-above-3')) : ?>
    <div id="footer-above-3" class="<?php echo $footerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('footer-above-4')) : ?>
    <div id="footer-above-4" class="<?php echo $footerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('footer-above-5')) : ?>
    <div id="footer-above-5" class="<?php echo $footerAboveClass ?>">

    </div>
    <?php endif ?>
    <?php if ($this->countModules('footer-above-6')) : ?>
    <div id="footer-above-6" class="<?php echo $footerAboveClass ?>">

    </div>
    <?php endif ?>
</div>
    <?php endif ?>

</div>
</section>
</div>

<footer id="footer" class="clear clearfix">
    <div class="gutter clearfix">

        <a id="to-page-top" href="<?php $url->setFragment('page-top'); echo $url->toString() ?>" class="to-additional">Back to Top</a>

        <?php if ($this->countModules('syndicate')) : ?>
        <div id="syndicate">

        </div>
        <?php endif ?>

        <?php if ($this->countModules('footer')) : ?>
        <jdoc:include type="modules" name="footer" style="jexhtml" />
        <?php endif ?>

    </div>
</footer>

    <?php if ($this->countModules('debug')) : ?>
<jdoc:include type="modules" name="debug" style="raw" />
    <?php endif ?>

    <?php if ($this->countModules('analytics')) : ?>
<jdoc:include type="modules" name="analytics" />
    <?php endif ?>

</body>
</html>
<?php }
