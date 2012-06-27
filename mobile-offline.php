<?php defined('_JEXEC') or die;
/**
 * @package        Unified HTML5 Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

// To get an application object
$app = JFactory::getApplication();

// Check for layout override
if (JFile::exists($template . '/layouts/mobile-offline.php')) {
    include_once $template . '/layouts/mobile-offline.php';
}
else {
    ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/css/mobile.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script>(function ($) {
        $(document).bind("mobileinit", function () {
            $.mobile.ajaxEnabled = false;
        });
    })(jQuery);</script>
    <script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
    <script>(function ($) {
        $(document).ready(function () {
            $('html').removeClass("no-js").addClass("js");
        });
    })(jQuery);</script>
</head>

<body>
<div data-role="page" data-theme="<?php echo $mPageDataTheme ?>">
    <div id="header" data-role="header" data-theme="<?php echo $mHeaderDataTheme ?>">
        <h1>
            <a href="<?php echo $this->baseurl ?>/" title="<?php echo htmlspecialchars($app->getCfg('sitename')) ?>"><?php echo htmlspecialchars($app->getCfg('sitename')) ?></a>
        </h1>
    </div>

    <?php if ($mNavPosition && ($this->countModules('nav'))) : ?>
    <div id="nav">
        <jdoc:include type="modules" name="nav" style="raw" />
    </div>
    <?php endif ?>

    <div id="content-container" data-role="content" data-theme="<?php echo $mContentDataTheme ?>">

        <?php if (!empty($messageQueue)) : ?>
        <jdoc:include type="message" />
        <?php endif ?>
        <p>
            <?php echo $app->getCfg('offline_message') ?>
        </p>

        <form action="index.php" method="post" name="login" id="form-login">
            <fieldset class="input">
                <p id="form-login-username">
                    <label for="username"><?php echo JText::_('JGLOBAL_USERNAME') ?></label>
                    <input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME') ?>" size="18" />
                </p>

                <p id="form-login-password">
                    <label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
                    <input type="password" name="password" class="inputbox" size="18" alt="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" id="passwd" />
                </p>

                <p id="form-login-remember">
                    <label for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?></label>
                    <input type="checkbox" name="remember" class="inputbox" value="yes" alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" id="remember" />
                </p>
                <input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
                <input type="hidden" name="option" value="com_users" />
                <input type="hidden" name="task" value="user.login" />
                <input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
                <?php echo JHtml::_('form.token') ?>
            </fieldset>
        </form>

    </div>

    <?php if (!$mNavPosition && ($this->countModules('nav'))) : ?>
    <div id="nav">
        <jdoc:include type="modules" name="nav" style="raw" />
    </div>
    <?php endif ?>

    <div id="footer" data-role="footer" data-theme="<?php echo $mFooterDataTheme ?>">
        <a class="view-desktop" href="<?php echo JURI::current() ?>?viewDesktop=true">View Desktop Version</a>
        <?php if ($this->countModules('footer')) : ?>
        <jdoc:include type="modules" name="footer" style="xhtml" />
        <?php endif ?>
    </div>
</div>

    <?php if ($this->countModules('analytics')) : ?>
<jdoc:include type="modules" name="analytics" />
    <?php endif ?>

</body>
</html>
<?php }