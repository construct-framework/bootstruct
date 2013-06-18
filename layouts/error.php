<?php defined('_JEXEC') or die;
/**
 * @package		Template Framework for Joomla!+
 * @author		Cristina Solana http://nightshiftcreative.com
 * @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright	Copyright (C) 2009 - 2013 Matt Thomas. All rights reserved.
 * @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 7]>	<html class="no-js ie7 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 8]>	<html class="no-js ie8 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if gt IE 8]> <!--> <html class="no-js" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <!--<![endif]-->
<head>
	<meta name="copyright" content="<?php echo htmlspecialchars($app->getCfg('sitename')) ?>" />
	<link rel="shortcut icon" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/favicon.png" type="image/png" />
	<link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/css/screen.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/css/print.css" type="text/css" media="print" />
	<?php
	if ($customStyleSheet > -1)
		echo '<link rel="stylesheet" href="' . $this->baseurl . '/templates/' . $this->template . '/css/' . $customStyleSheet . '"  type="text/css" media="screen" />';
	if ($gridSystem != '-1')
		echo '<link rel="stylesheet" href="' . $this->baseurl . '/templates/' . $this->template . '/css/grids/' . $gridSystem . '"  type="text/css" media="screen" />';
	if ($this->direction == 'rtl')
		echo '<link rel="stylesheet" href="' . $this->baseurl . '/templates/' . $this->template . '/css/rtl.css"  type="text/css" media="screen" />';
	if (isset($cssFile))
		echo "\n" . $cssFile;
	if ($googleWebFont != "")
		echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' . $googleWebFont . '">
		<style type="text/css">' . $googleWebFontTargets . '{font-family:' . $googleWebFont . ', serif !important;} </style>';
	if ($googleWebFont2 != "")
		echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' . $googleWebFont2 . '">
		<style type="text/css">' . $googleWebFontTargets2 . '{font-family:' . $googleWebFont2 . ', serif !important;} </style>';
	if ($googleWebFont3 != "")
		echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' . $googleWebFont3 . '">
		<style type="text/css">' . $googleWebFontTargets3 . '{font-family:' . $googleWebFont3 . ', serif !important;} </style>';
	if ($siteWidth)
		echo '<style type="text/css"> #body-container, #header-above {' . $siteWidthType . ':' . $siteWidth . $siteWidthUnit . ' !important}</style>';
	if ($siteWidth && !$fullWidth)
		echo '<style type="text/css"> #header, #footer {' . $siteWidthType . ':' . $siteWidth . $siteWidthUnit . ';margin:0 auto}</style>';
	if (($siteWidthType == 'max-width') && $fluidMedia)
		echo '<style type="text/css"> img, object {max-width:100%}</style>';
	?>
	<script type="text/javascript">window.addEvent('domready', function () {
		new SmoothScroll({duration:1200}, window);
	});</script>
	<!--[if lt IE 7]>
	<?php if ($IE6TransFix) {
		echo '  <script type="text/javascript" src="' . $this->baseurl . '/templates/' . $this->template . '/js/DD_belatedPNG_0.0.8a-min.js"></script>
  <script>DD_belatedPNG.fix(\'' . $IE6TransFixTargets . '\');</script>' . "\n";
	} ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/css/ie6.css" type="text/css" media="screen" />
	<style type="text/css">
	body {text-align: center}
	#body-container {text-align : left;}
	#body-container <?php if (!$fullWidth) echo ',#header, #footer '?>{width: expression( document.body.clientWidth > <?php echo ($siteWidth - 1) ?> ? "<?php echo $siteWidth . $siteWidthUnit ?>" : "auto" );margin : 0 auto;}
	</style>
	<![endif]-->
	<?php if ($useStickyFooter) {
	echo '  <style type="text/css">.sticky-footer #body-container{padding-bottom:' . $stickyFooterHeight . 'px;}
  .sticky-footer #footer{margin-top:-' . $stickyFooterHeight . 'px;height:' . $stickyFooterHeight . 'px;}
  </style>
  <!--[if !IE 7]>
  <style type="text/css">.sticky-footer #footer-push {display:table;height:100%}</style>
  <![endif]-->';
} ?>
<!--[if lte IE 8]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
	<?php if ($IECSS3) {
	echo '  <!--[if !IE 9]>
  <style type="text/css">' . $IECSS3Targets . '"{behavior:url("' . $this->baseurl . '/templates/' . $this->template . '/js/PIE.htc)</style>
  <![endif]-->';
}
	echo "\n" ?>
</head>

<body id="page-top" class="<?php echo $columnLayout; if ($useStickyFooter) echo ' sticky-footer' ?> error">
<div id="footer-push">
<?php if ($headerAboveClass) : ?>
<div id="header-above" class="clearfix">
	<div id="header-above-1" class="<?php echo $headerAboveClass ?>">
		<?php echo $renderer->render('header-above-1', $jexhtml, null) ?>
	</div>
	<div id="header-above-2" class="<?php echo $headerAboveClass ?>">
		<?php echo $renderer->render('header-above-2', $jexhtml, null) ?>
	</div>
	<div id="header-above-3" class="<?php echo $headerAboveClass ?>">
		<?php echo $renderer->render('header-above-3', $jexhtml, null) ?>
	</div>
	<div id="header-above-4" class="<?php echo $headerAboveClass ?>">
		<?php echo $renderer->render('header-above-4', $jexhtml, null) ?>
	</div>
	<div id="header-above-5" class="<?php echo $headerAboveClass ?>">
		<?php echo $renderer->render('header-above-5', $jexhtml, null) ?>
	</div>
	<div id="header-above-6" class="<?php echo $headerAboveClass ?>">
		<?php echo $renderer->render('header-above-6', $jexhtml, null) ?>
	</div>
</div>
	<?php endif ?>

<header id="header" class="clear clearfix">
	<div class="gutter">

		<h1 id="logo">
			<a href="<?php echo $this->baseurl ?>/" title="<?php echo htmlspecialchars($app->getCfg('sitename')) ?>"><?php echo $this->baseurl ?></a>
		</h1>

		<?php echo $renderer->render('header', $jexhtml, null) ?>

		<nav>
			<ul id="access">
				<li>Jump to:</li>
				<li><a href="<?php echo $this->baseurl ?>/index.php#content" class="to-content">Content</a></li>
				<li><a href="<?php echo $this->baseurl ?>/index.php#nav" class="to-nav">Navigation</a></li>
				<li>
					<a href="<?php echo $this->baseurl ?>/index.php#additional" class="to-additional">Additional Information</a>
				</li>
			</ul>
		</nav>

	</div>
</header>

<section id="body-container">
	<?php if ($headerBelowClass) : ?>
	<div id="header-below" class="clearfix">
		<div id="header-below-1" class="<?php echo $headerBelowClass ?>">
			<?php echo $renderer->render('header-below-1', $jexhtml, null) ?>
		</div>
		<div id="header-below-2" class="<?php echo $headerBelowClass ?>">
			<?php echo $renderer->render('header-below-2', $jexhtml, null) ?>
		</div>
		<div id="header-below-3" class="<?php echo $headerBelowClass ?>">
			<?php echo $renderer->render('header-below-3', $jexhtml, null) ?>
		</div>
		<div id="header-below-4" class="<?php echo $headerBelowClass ?>">
			<?php echo $renderer->render('header-below-4', $jexhtml, null) ?>
		</div>
		<div id="header-below-5" class="<?php echo $headerBelowClass ?>">
			<?php echo $renderer->render('header-below-5', $jexhtml, null) ?>
		</div>
		<div id="header-below-6" class="<?php echo $headerBelowClass ?>">
			<?php echo $renderer->render('header-below-6', $jexhtml, null) ?>
		</div>
	</div>
	<?php endif ?>

	<?php echo $renderer->render('breadcrumbs', $raw, null) ?>

	<nav id="nav" class="clear">
		<?php echo $renderer->render('nav', $raw, null) ?>
	</nav>

	<div id="content-container" class="clear clearfix">
		<?php if ($navBelowClass) : ?>
		<div id="nav-below" class="clearfix">
			<div id="nav-below-1" class="<?php echo $navBelowClass ?>">
				<?php echo $renderer->render('nav-below-1', $jexhtml, null) ?>
			</div>
			<div id="nav-below-2" class="<?php echo $navBelowClass ?>">
				<?php echo $renderer->render('nav-below-2', $jexhtml, null) ?>
			</div>
			<div id="nav-below-3" class="<?php echo $navBelowClass ?>">
				<?php echo $renderer->render('nav-below-3', $jexhtml, null) ?>
			</div>
			<div id="nav-below-4" class="<?php echo $navBelowClass ?>">
				<?php echo $renderer->render('nav-below-4', $jexhtml, null) ?>
			</div>
			<div id="nav-below-5" class="<?php echo $navBelowClass ?>">
				<?php echo $renderer->render('nav-below-5', $jexhtml, null) ?>
			</div>
			<div id="nav-below-6" class="<?php echo $navBelowClass ?>">
				<?php echo $renderer->render('nav-below-6', $jexhtml, null) ?>
			</div>
		</div>
		<?php endif ?>

		<div id="load-first" class="clearfix">
			<div id="content-main">
				<div class="gutter">
					<?php if ($contentAboveClass) : ?>
					<div id="content-above" class="clearfix">
						<div id="content-above-1" class="<?php echo $contentAboveClass ?>">
							<?php echo $renderer->render('content-above-1', $jexhtml, null) ?>
						</div>
						<div id="content-above-2" class="<?php echo $contentAboveClass ?>">
							<?php echo $renderer->render('content-above-2', $jexhtml, null) ?>
						</div>
						<div id="content-above-3" class="<?php echo $contentAboveClass ?>">
							<?php echo $renderer->render('content-above-3', $jexhtml, null) ?>
						</div>
						<div id="content-above-4" class="<?php echo $contentAboveClass ?>">
							<?php echo $renderer->render('content-above-4', $jexhtml, null) ?>
						</div>
						<div id="content-above-5" class="<?php echo $contentAboveClass ?>">
							<?php echo $renderer->render('content-above-5', $jexhtml, null) ?>
						</div>
						<div id="content-above-6" class="<?php echo $contentAboveClass ?>">
							<?php echo $renderer->render('content-above-6', $jexhtml, null) ?>
						</div>
					</div>
					<?php endif ?>

					<div id="error-message">
						<?php echo $this->error->getCode() ?> - <?php echo $this->error->getMessage() ?>
						<p><strong><?php echo JText::_('You may not be able to visit this page because of:') ?></strong>
						</p>
						<ol>
							<li><?php echo JText::_('An out-of-date bookmark/favourite') ?></li>
							<li><?php echo JText::_('A search engine that has an out-of-date listing for this site') ?></li>
							<li><?php echo JText::_('A mis-typed address') ?></li>
							<li><?php echo JText::_('You have no access to this page') ?></li>
							<li><?php echo JText::_('The requested resource was not found') ?></li>
							<li><?php echo JText::_('An error has occurred while processing your request.') ?></li>
						</ol>
						<p><strong><?php echo JText::_('Please try one of the following pages:') ?></strong></p>
						<ul>
							<li>
								<a href="<?php echo $this->baseurl ?>/" title="<?php echo JText::_('Go to the home page') ?>"><?php echo JText::_('Home Page') ?></a>
							</li>
						</ul>
						<p><?php echo JText::_('If difficulties persist, please contact the system administrator of this site.') ?></p>

						<p><?php echo $this->error->getMessage() ?></p>

						<p>
							<?php if ($this->debug) :
							echo $this->renderBacktrace();
						endif ?>
						</p>
					</div>
					<?php if ($contentBelowClass) : ?>
					<div id="content-below" class="clearfix">
						<div id="content-below-1" class="<?php echo $contentBelowClass ?>">
							<?php echo $renderer->render('content-below-1', $jexhtml, null) ?>
						</div>
						<div id="content-below-2" class="<?php echo $contentBelowClass ?>">
							<?php echo $renderer->render('content-below-2', $jexhtml, null) ?>
						</div>
						<div id="content-below-3" class="<?php echo $contentBelowClass ?>">
							<?php echo $renderer->render('content-below-3', $jexhtml, null) ?>
						</div>
						<div id="content-below-4" class="<?php echo $contentBelowClass ?>">
							<?php echo $renderer->render('content-below-4', $jexhtml, null) ?>
						</div>
						<div id="content-below-5" class="<?php echo $contentBelowClass ?>">
							<?php echo $renderer->render('content-below-5', $jexhtml, null) ?>
						</div>
						<div id="content-below-6" class="<?php echo $contentBelowClass ?>">
							<?php echo $renderer->render('content-below-6', $jexhtml, null) ?>
						</div>
					</div>
					<?php endif ?>
				</div>
			</div>
			<?php if ($columnGroupAlphaClass) : ?>
			<div id="column-group-alpha">
				<div class="gutter clearfix">
					<div id="column-1" class="<?php echo $columnGroupAlphaClass ?>">
						<?php echo $renderer->render('column-1', $jexhtml, null) ?>
					</div>
					<div id="column-2" class="<?php echo $columnGroupAlphaClass ?>">
						<?php echo $renderer->render('column-2', $jexhtml, null) ?>
					</div>
				</div>
			</div>
			<?php endif ?>
		</div>

		<?php if ($columnGroupBetaClass) : ?>
		<div id="column-group-beta">
			<div class="gutter clearfix">
				<div id="column-3" class="<?php echo $columnGroupBetaClass ?>">
					<?php echo $renderer->render('column-3', $jexhtml, null) ?>
				</div>
				<div id="column-4" class="<?php echo $columnGroupBetaClass ?>">
					<?php echo $renderer->render('column-4', $jexhtml, null) ?>
				</div>
			</div>
		</div>
		<?php endif ?>

		<?php if ($footerAboveClass) : ?>
		<div id="footer-above" class="clearfix">
			<div id="footer-above-1" class="<?php echo $footerAboveClass ?>">
				<?php echo $renderer->render('footer-above-1', $jexhtml, null) ?>
			</div>
			<div id="footer-above-2" class="<?php echo $footerAboveClass ?>">
				<?php echo $renderer->render('footer-above-2', $jexhtml, null) ?>
			</div>
			<div id="footer-above-3" class="<?php echo $footerAboveClass ?>">
				<?php echo $renderer->render('footer-above-3', $jexhtml, null) ?>
			</div>
			<div id="footer-above-4" class="<?php echo $footerAboveClass ?>">
				<?php echo $renderer->render('footer-above-4', $jexhtml, null) ?>
			</div>
			<div id="footer-above-5" class="<?php echo $footerAboveClass ?>">
				<?php echo $renderer->render('footer-above-5', $jexhtml, null) ?>
			</div>
			<div id="footer-above-6" class="<?php echo $footerAboveClass ?>">
				<?php echo $renderer->render('footer-above-6', $jexhtml, null) ?>
			</div>
		</div>
		<?php endif ?>
	</div>
</section>
</div>

<footer id="footer" class="clear clearfix">
	<div class="gutter clearfix">
		<a id="to-page-top" href="<?php echo $this->baseurl ?>/index.php#page-top">Back to Top</a>
		<?php echo $renderer->render('syndicate', $jexhtml, null) ?>
		<?php echo $renderer->render('footer', $jexhtml, null) ?>
	</div>
</footer>

<?php echo $renderer->render('analytics', $raw, null) ?>

</body>
</html>
