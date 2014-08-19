<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!+
 * @author         Cristina Solana http://nightshiftcreative.com
 * @author         Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright      Copyright (C) 2009 - 2014 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

// Load Joomla filesystem package
jimport('joomla.filesystem.file');

// Load template logic
$logicFile = JPATH_THEMES . '/' . $this->template . '/elements/logic.php';
if (JFile::exists($logicFile)) {
	include $logicFile;
}

// Layout override
$results = $layoutOverride->getIncludeFile();

if ($results) {
	$alternateIndexFile = $results;
	include_once $alternateIndexFile;
} else {
	?>
	<!DOCTYPE html>
	<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
	<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
	<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
	<!--[if IE 9]>    <html class="no-js ie9 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
	<!--[if IE 10]>   <html class="no-js ie10" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
	<!--[if gt IE 10]> <!-->
	<html class="no-js" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <!--<![endif]-->
	<head>
		<jdoc:include type="head" />
	</head>

	<body id="page-top" class="<?php echo $currentComponent;
	if ($useStickyFooter) {
		echo ' sticky-footer';
	}
	if ($articleId) {
		echo ' article-' . $articleId;
	}
	if ($itemId) {
		echo ' item-' . $itemId;
	}
	if ($catId) {
		echo ' category-' . $catId;
	}
	if ($default) {
		echo ' default';
	}
	if ($pageClass) {
		echo ' ' . $pageClass;
} ?>">

	<div id="footer-push">

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="brand" href="<?php echo $this->baseurl; ?>"><?php echo htmlspecialchars($app->getCfg('sitename')) ?></a>
				<?php if ($this->countModules('nav')) : ?>
				<div class="nav-collapse collapse">
					<jdoc:include type="modules" name="nav" />
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if ($headerAboveCount) : ?>
		<div id="header-above" class="clearfix row-fluid">
			<?php if ($this->countModules('header-above-1')) : ?>
				<div id="header-above-1" class="<?php echo $headerAboveClass ?>">
					<jdoc:include type="modules" name="header-above-1" style="div" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-above-2')) : ?>
				<div id="header-above-2" class="<?php echo $headerAboveClass ?>">
					<jdoc:include type="modules" name="header-above-2" style="div" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-above-3')) : ?>
				<div id="header-above-3" class="<?php echo $headerAboveClass ?>">
					<jdoc:include type="modules" name="header-above-3" style="div" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-above-4')) : ?>
				<div id="header-above-4" class="<?php echo $headerAboveClass ?>">
					<jdoc:include type="modules" name="header-above-4" style="div" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-above-5')) : ?>
				<div id="header-above-5" class="<?php echo $headerAboveClass ?>">
					<jdoc:include type="modules" name="header-above-5" style="div" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-above-6')) : ?>
				<div id="header-above-6" class="<?php echo $headerAboveClass ?>">
					<jdoc:include type="modules" name="header-above-6" style="div" />
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>

	<header id="header" class="clear clearfix">
		<div class="gutter clearfix">

			<?php if ($showDiagnostics) : ?>
				<ul id="diagnostics">
					<li>column layout <?php echo $columnLayout ?></li>
					<li>component <?php echo $currentComponent ?></li>
					<?php if ($view) {
						echo '<li>' . $view . ' view</li>';
					} ?>
					<?php if ($articleId) {
						echo '<li>article ' . $articleId . '</li>';
					} ?>
					<?php if ($itemId) {
						echo '<li>menu item ' . $itemId . '</li>';
					} ?>
					<?php if ($catId) {
						echo '<li>category ' . $catId . '</li>';
					} ?>
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
							echo '</li>';
						}
					} ?>
				</ul>
			<?php endif ?>

			<?php if ($this->countModules('header')) : ?>
				<jdoc:include type="modules" name="header" style="header" />
			<?php endif ?>

			<nav>
				<ul id="access">
					<li>Jump to:</li>
					<li>
						<a href="<?php $url->setFragment('content');
						echo $url->toString() ?>" class="to-content">Content</a>
					</li>
					<?php if ($this->countModules('nav')) : ?>
						<li><a href="<?php $url->setFragment('nav');
							echo $url->toString() ?>" class="to-nav">Navigation</a>
						</li>
					<?php endif ?>
					<?php if ($contentBelowCount) : ?>
						<li>
							<a href="<?php $url->setFragment('additional');
							echo $url->toString() ?>" class="to-additional">Additional Information</a>
						</li>
					<?php endif ?>
				</ul>
			</nav>

		</div>
	</header>

	<section id="body-container" class="container  row-fluid">

	<?php if ($headerBelowCount) : ?>
		<div id="header-below" class="clearfix row-fluid">
			<?php if ($this->countModules('header-below-1')) : ?>
				<div id="header-below-1" class="<?php echo $headerBelowClass ?>">
					<jdoc:include type="modules" name="header-below-1" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-below-2')) : ?>
				<div id="header-below-2" class="<?php echo $headerBelowClass ?>">
					<jdoc:include type="modules" name="header-below-2" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-below-3')) : ?>
				<div id="header-below-3" class="<?php echo $headerBelowClass ?>">
					<jdoc:include type="modules" name="header-below-3" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-below-4')) : ?>
				<div id="header-below-4" class="<?php echo $headerBelowClass ?>">
					<jdoc:include type="modules" name="header-below-4" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-below-5')) : ?>
				<div id="header-below-5" class="<?php echo $headerBelowClass ?>">
					<jdoc:include type="modules" name="header-below-5" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('header-below-6')) : ?>
				<div id="header-below-6" class="<?php echo $headerBelowClass ?>">
					<jdoc:include type="modules" name="header-below-6" style="div" module-class="gutter" />
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>

	<?php if ($this->countModules('breadcrumbs')) : ?>
		<jdoc:include type="module" name="breadcrumbs" />
	<?php endif ?>

	<div id="content-container" class="clear clearfix">

		<?php if ($navBelowCount) : ?>
			<div id="nav-below" class="clearfix row-fluid">
				<?php if ($this->countModules('nav-below-1')) : ?>
					<div id="nav-below-1" class="<?php echo $navBelowClass ?>">
						<jdoc:include type="modules" name="nav-below-1" style="div" module-class="gutter" />
					</div>
				<?php endif ?>

				<?php if ($this->countModules('nav-below-2')) : ?>
					<div id="nav-below-2" class="<?php echo $navBelowClass ?>">
						<jdoc:include type="modules" name="nav-below-2" style="div" module-class="gutter" />
					</div>
				<?php endif ?>

				<?php if ($this->countModules('nav-below-3')) : ?>
					<div id="nav-below-3" class="<?php echo $navBelowClass ?>">
						<jdoc:include type="modules" name="nav-below-3" style="div" module-class="gutter" />
					</div>
				<?php endif ?>

				<?php if ($this->countModules('nav-below-4')) : ?>
					<div id="nav-below-4" class="<?php echo $navBelowClass ?>">
						<jdoc:include type="modules" name="nav-below-4" style="div" module-class="gutter" />
					</div>
				<?php endif ?>

				<?php if ($this->countModules('nav-below-5')) : ?>
					<div id="nav-below-5" class="<?php echo $navBelowClass ?>">
						<jdoc:include type="modules" name="nav-below-5" style="div" module-class="gutter" />
					</div>
				<?php endif ?>

				<?php if ($this->countModules('nav-below-6')) : ?>
					<div id="nav-below-6" class="<?php echo $navBelowClass ?>">
						<jdoc:include type="modules" name="nav-below-6" style="div" module-class="gutter" />
					</div>
				<?php endif ?>
			</div>
		<?php endif ?>

		<div id="load-first" class="clearfix span<?php echo $firstSpan ?> row-fluid">
			<a id="content" name="content"></a>

			<div id="content-main" class="span<?php echo $mainSpan ?> pull-right">
				<div class="gutter">

					<?php if ($contentAboveCount) : ?>
						<div id="content-above" class="clearfix row-fluid">
							<?php if ($this->countModules('content-above-1')) : ?>
								<div id="content-above-1" class="<?php echo $contentAboveClass ?>">
									<jdoc:include type="modules" name="content-above-1" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-above-2')) : ?>
								<div id="content-above-2" class="<?php echo $contentAboveClass ?>">
									<jdoc:include type="modules" name="content-above-2" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-above-3')) : ?>
								<div id="content-above-3" class="<?php echo $contentAboveClass ?>">
									<jdoc:include type="modules" name="content-above-3" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-above-4')) : ?>
								<div id="content-above-4" class="<?php echo $contentAboveClass ?>">
									<jdoc:include type="modules" name="content-above-4" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-above-5')) : ?>
								<div id="content-above-5" class="<?php echo $contentAboveClass ?>">
									<jdoc:include type="modules" name="content-above-5" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-above-6')) : ?>
								<div id="content-above-6" class="<?php echo $contentAboveClass ?>">
									<jdoc:include type="modules" name="content-above-6" style="div" module-class="gutter" />
								</div>
							<?php endif ?>
						</div>
					<?php endif ?>

					<jdoc:include type="message" />

					<jdoc:include type="component" />

					<?php if ($contentBelowCount) : ?>
						<div id="content-below" class="clearfix row-fluid">
							<?php if ($this->countModules('content-below-1')) : ?>
								<div id="content-below-1" class="<?php echo $contentBelowClass ?>">
									<jdoc:include type="modules" name="content-below-1" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-below-2')) : ?>
								<div id="content-below-2" class="<?php echo $contentBelowClass ?>">
									<jdoc:include type="modules" name="content-below-2" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-below-3')) : ?>
								<div id="content-below-3" class="<?php echo $contentBelowClass ?>">
									<jdoc:include type="modules" name="content-below-3" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-below-4')) : ?>
								<div id="content-below-4" class="<?php echo $contentBelowClass ?>">
									<jdoc:include type="modules" name="content-below-4" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-below-5')) : ?>
								<div id="content-below-5" class="<?php echo $contentBelowClass ?>">
									<jdoc:include type="modules" name="content-below-5" style="div" module-class="gutter" />
								</div>
							<?php endif ?>

							<?php if ($this->countModules('content-below-6')) : ?>
								<div id="content-below-6" class="<?php echo $contentBelowClass ?>">
									<jdoc:include type="modules" name="content-below-6" style="div" module-class="gutter" />
								</div>
							<?php endif ?>
						</div>
					<?php endif ?>

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

	<?php if ($footerAboveCount) : ?>
		<div id="footer-above" class="clearfix row-fluid">
			<?php if ($this->countModules('footer-above-1')) : ?>
				<div id="footer-above-1" class="<?php echo $footerAboveClass ?>">
					<jdoc:include type="modules" name="footer-above-1" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('footer-above-2')) : ?>
				<div id="footer-above-2" class="<?php echo $footerAboveClass ?>">
					<jdoc:include type="modules" name="footer-above-2" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('footer-above-3')) : ?>
				<div id="footer-above-3" class="<?php echo $footerAboveClass ?>">
					<jdoc:include type="modules" name="footer-above-3" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('footer-above-4')) : ?>
				<div id="footer-above-4" class="<?php echo $footerAboveClass ?>">
					<jdoc:include type="modules" name="footer-above-4" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('footer-above-5')) : ?>
				<div id="footer-above-5" class="<?php echo $footerAboveClass ?>">
					<jdoc:include type="modules" name="footer-above-5" style="div" module-class="gutter" />
				</div>
			<?php endif ?>

			<?php if ($this->countModules('footer-above-6')) : ?>
				<div id="footer-above-6" class="<?php echo $footerAboveClass ?>">
					<jdoc:include type="modules" name="footer-above-6" style="div" module-class="gutter" />
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
	</section>
	</div>

	<footer id="footer" class="clear clearfix">
		<div class="gutter clearfix">
			<a id="to-page-top" href="<?php $url->setFragment('page-top');
			echo $url->toString() ?>" class="to-additional">Back to Top</a>
			<?php if ($this->countModules('syndicate')) : ?>
				<div id="syndicate">
					<jdoc:include type="modules" name="syndicate" />
				</div>
			<?php endif ?>
			<?php if ($this->countModules('footer')) : ?>
				<jdoc:include type="modules" name="footer" style="div" />
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

