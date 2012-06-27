<?php defined('_JEXEC') or die;
/**
 * @version        $Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package        Joomla.Site
 * @subpackage    com_content
 * @copyright    Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$header = $this->params->get('show_page_heading', 1) + ($this->params->get('show_base_description') || $this->parent->description);
?>

<section class="categories-list<?php echo $this->pageclass_sfx;?>">
    <?php if ($header) : ?>
    <header>
    <?php endif; ?>
    <?php if ($this->params->get('show_page_heading', 1)) : ?>
    <h1>
        <?php echo htmlspecialchars($this->params->get('page_heading')); ?>
    </h1>
    <?php endif; ?>

    <?php if ($this->params->get('show_base_description')) : ?>
    <?php if ($this->params->get('categories_description')) : ?>
        <?php echo  JHtml::_('content.prepare', $this->params->get('categories_description'), '', 'com_content.categories'); ?>
        <?php else: ?>
        <?php if ($this->parent->description) : ?>
            <p class="category-desc">
                <?php  echo JHtml::_('content.prepare', $this->parent->description, '', 'com_content.categories'); ?>
            </p>
            <?php endif; ?>
        <?php  endif; ?>
    <?php endif; ?>

    <?php if ($header) : ?>
    </header>
    <?php endif; ?>

    <?php echo $this->loadTemplate('items'); ?>
</section>
