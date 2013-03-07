<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!+
 * @author         Cristina Solana http://nightshiftcreative.com
 * @author         Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright      Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js ie6 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 7]>
<html class="no-js ie7 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 8]>
<html class="no-js ie8 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 9]>
<html class="no-js ie9 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 10]>
<html class="no-js ie10" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if gt IE 10]> <!-->
<html class="no-js" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <!--<![endif]-->
<head>
	<jdoc:include type="head" />
</head>

<body id="page-top" class="<?php if ($useStickyFooter) echo ' sticky-footer'; echo ' ' . $currentComponent; if ($articleId) echo ' article-' . $articleId; if ($itemId) echo ' item-' . $itemId; if ($catId) echo ' category-' . $catId; if ($default) echo ' default'; ?>">

<div id="footer-push">
	<?php if ($this->countModules('nav')) : ?>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
				<a type="button" class="btn btn-navbar" href="<?php $url->setFragment('nav'); echo $url->toString() ?>">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo $this->baseurl ?>/" title="<?php echo htmlspecialchars($app->getCfg('sitename')) ?>"><?php echo htmlspecialchars($app->getCfg('sitename')) ?></a>
			</div>
		</div>
	</div>
	<?php endif ?>

	<header id="header" class="clear clearfix">
		<div class="gutter clearfix">
			<?php if ($this->countModules('header')) : ?>
			<jdoc:include type="modules" name="header" style="header" />
			<?php endif ?>
		</div>
	</header>

	<section id="body-container" class="container  row-fluid">
		<?php if ($this->countModules('breadcrumbs')) : ?>
		<jdoc:include type="module" name="breadcrumbs" />
		<?php endif ?>

		<div id="content-container" class="clear clearfix">
			<div id="load-first" class="clearfix span<?php echo $firstSpan ?>">
				<a id="content" name="content"></a>

				<div id="content-main" class="span<?php echo $mainSpan ?> pull-right">
					<div class="gutter">
						<?php if (!empty($messageQueue)) : ?>
						<jdoc:include type="message" />
						<?php endif ?>
						<jdoc:include type="component" />
					</div>
				</div>

				<?php if ($columnGroupAlphaCount) : ?>
				<div id="column-group-alpha" class="clearfix span<?php echo $alphaSpan ?>">
					<?php if ($this->countModules('column-1')) : ?>
					<div id="column-1" class="span<?php echo $groupAlphaSpan ?>">
						<div class="gutter clearfix">
							<jdoc:include type="modules" name="column-1" style="div" />
						</div>
					</div>
					<?php endif ?>
					<?php if ($this->countModules('column-2')) : ?>
					<div id="column-2" class="span<?php echo $groupAlphaSpan ?>">
						<div class="gutter clearfix">
							<jdoc:include type="modules" name="column-2" style="div" />
						</div>
					</div>
					<?php endif ?>
				</div>
				<?php endif ?>
			</div>

			<?php if ($columnGroupBetaCount) : ?>
			<div id="column-group-beta" class="clearfix span<?php echo $betaSpan ?>">
				<?php if ($this->countModules('column-3')) : ?>
				<div id="column-3" class="span<?php echo $groupBetaSpan ?>">
					<div class="gutter clearfix">
						<jdoc:include type="modules" name="column-3" style="div" />
					</div>
				</div>
				<?php endif ?>
				<?php if ($this->countModules('column-4')) : ?>
				<div id="column-4" class="span<?php echo $groupBetaSpan ?>">
					<div class="gutter clearfix">
						<jdoc:include type="modules" name="column-4" style="div" />
					</div>
				</div>
				<?php endif ?>
			</div>
			<?php endif ?>
		</div>

		<?php if ($this->countModules('nav')) : ?>
		<div class="navbar" id="primary-nav">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="brand" href="<?php echo $this->baseurl ?>/" title="<?php echo htmlspecialchars($app->getCfg('sitename')) ?>"><?php echo htmlspecialchars($app->getCfg('sitename')) ?></a>
					<nav id="nav" class="clear clearfix">
						<jdoc:include type="modules" name="nav" style="raw" />
					</nav>
				</div>
			</div>
		</div>
		<?php endif ?>
</section>
</div>

<footer id="footer" class="clear clearfix">
	<div class="gutter clearfix">
		<a id="to-page-top" href="<?php $url->setFragment('page-top'); echo $url->toString() ?>" class="to-additional">Back to Top</a>
		<?php if ($this->countModules('footer')) : ?>
		<jdoc:include type="modules" name="footer" style="div" />
		<?php endif ?>
	</div>
</footer>

<?php if ($this->countModules('analytics')) : ?>
<jdoc:include type="modules" name="analytics" />
	<?php endif ?>

</body>
</html>