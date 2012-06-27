<?php defined('_JEXEC') or die;
/**
 * @package        Unified HTML5 Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$header = $this->params->get('show_page_heading', 1) + ($this->params->get('show_category_title', 1) || $this->params->get('page_subheading'));

?>
<section class="blog<?php echo $this->pageclass_sfx;?>">

<?php if ($header) : ?>
    <header class="section-info">
    <?php endif; ?>

<?php if ($header > 1) : ?>
    <hgroup>
    <?php endif; ?>

<?php if ($this->params->get('show_page_heading', 1)) : ?>
    <h1>
        <?php echo htmlspecialchars($this->params->get('page_heading')); ?>
    </h1>
    <?php endif; ?>

<?php if ($this->params->get('show_category_title', 1) || $this->params->get('page_subheading')) : ?>
    <h2 class="subheading-category">
        <?php echo htmlspecialchars($this->params->get('page_subheading')); ?>
        <?php if ($this->params->get('show_category_title')) : ?>
        <?php echo $this->category->title; ?>
        <?php endif; ?>
    </h2>
    <?php endif; ?>

<?php if ($header > 1) : ?>
    </hgroup>
    <?php endif; ?>

<?php if ($header) : ?>
    </header>
    <?php endif; ?>

<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
<section class="category-desc clearfix">
    <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
    <img src="<?php echo $this->category->getParams()->get('image'); ?>" />
    <?php endif; ?>
    <?php if ($this->params->get('show_description') && $this->category->description) : ?>
    <?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
    <?php endif; ?>
</section>
    <?php endif; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
<section class="items-leading">
    <?php foreach ($this->lead_items as &$item) : ?>
    <article class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
        <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
        ?>
    </article>
    <?php
    $leadingcount++;
    ?>
    <?php endforeach; ?>
</section>
    <?php endif; ?>
<?php
$introcount = (count($this->intro_items));
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<section class="items-intro">

    <?php foreach ($this->intro_items as $key => &$item) : ?>

    <?php
    $key = ($key - $leadingcount) + 1;
    $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
    $row = $counter / $this->columns;

    if ($rowcount == 1) : ?>
            <div class="items-row cols-<?php echo (int)$this->columns;?> <?php echo 'row-' . $row; ?> clearfix">
            <?php endif; ?>

    <article class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished"' : null; ?>">
        <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
        ?>
    </article>

    <?php $counter++; ?>

    <?php if (($rowcount == $this->columns) or ($counter == $introcount)): ?>
                </div>
            <?php endif; ?>
    <?php endforeach; ?>
</section>
    <?php endif; ?>


<?php if (!empty($this->link_items)) : ?>

    <?php echo $this->loadTemplate('links'); ?>

    <?php endif; ?>

<?php if (!empty($this->children[$this->category->id]) && $this->maxLevel != 0) : ?>
<section class="cat-children">
    <h3>
        <?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
    </h3>
    <?php echo $this->loadTemplate('children'); ?>
</section>
    <?php endif; ?>

<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
<nav class="pagination">
    <?php  if ($this->params->def('show_pagination_results', 1)) : ?>
    <p class="counter">
        <?php echo $this->pagination->getPagesCounter(); ?>
    </p>
    <?php endif; ?>

    <?php echo $this->pagination->getPagesLinks(); ?>
</nav>
    <?php endif; ?>

</section>

