<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/css/mobile.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
    <?php //Load Mobile Extended Template Style Overrides
    $mobileCssFile = $mobileStyleOverride->getIncludeFile();
    if ($mobileCssFile) : ?>
        <link rel="stylesheet" href="<?php echo $this->baseurl . $mobileCssFile ?>" type="text/css" media="screen" />
        <?php endif ?>
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script>(function ($) {
        $(document).bind("mobileinit", function () {
            $.mobile.ajaxEnabled = false;
        });
    })(jQuery);</script>
    <script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
    <script>(function ($) {
        $(document).ready(function () {
            $('html').removeClass("no-js");
        });
    })(jQuery);</script>
</head>

<body>

<div data-role="page" data-theme="<?php echo $mPageDataTheme ?>">

    <header id="header" data-role="header" data-theme="<?php echo $mHeaderDataTheme ?>">

        <h1>
            <a href="<?php echo $baseUrl ?>/" title="<?php echo htmlspecialchars($app->getCfg('sitename')) ?>"><?php echo htmlspecialchars($app->getCfg('sitename')) ?></a>
        </h1>

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
        <?php if (!$mNavPosition && ($this->countModules('nav'))) : ?>
        <a href="<?php echo JURI::current() ?>#nav" data-ajax="false">Menu</a>
        <?php endif ?>
    </header>

    <?php if ($mNavPosition && ($this->countModules('nav'))) : ?>
    <nav id="nav">
        <jdoc:include type="modules" name="nav" style="raw" />
    </nav>
    <?php endif ?>

    <section id="content-container" data-role="content" data-theme="<?php echo $mContentDataTheme ?>">
        <?php if (!empty($messageQueue)) : ?>
        <jdoc:include type="message" />
        <?php endif ?>
        <jdoc:include type="component" />
    </section>

    <?php if (!$mNavPosition && ($this->countModules('nav'))) : ?>
    <nav id="nav">
        <jdoc:include type="modules" name="nav" style="raw" />
    </nav>
    <?php endif ?>

    <footer id="footer" data-role="footer" data-theme="<?php echo $mFooterDataTheme ?>">
        <a class="view-desktop" href="<?php echo JURI::current() ?>?viewDesktop=true">View Desktop Version</a>
        <?php if ($this->countModules('footer')) : ?>
        <jdoc:include type="modules" name="footer" style="xhtml" />
        <?php endif ?>
    </footer>
</div>

<?php if ($this->countModules('analytics')) : ?>
<jdoc:include type="modules" name="analytics" />
    <?php endif ?>

</body>
</html>

