<?php defined('_JEXEC') or die;
/**
 * @package        Unified HTML5 Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit = $this->item->params->get('access-edit');
$details = $params->get('show_parent_category') + $params->get('show_category') + $params->get('show_create_date') + $params->get('show_modify_date') + $params->get('show_publish_date') + ($params->get('show_author') && !empty($this->item->author)) + $params->get('show_hits');
$header = $details + $params->get('show_title') + $params->get('show_parent_category') + $params->get('show_category');
?>

<?php if ($this->item->state == 0) : ?>
    <section class="system-unpublished">
    <?php endif; ?>

<?php if ($header) : ?>
    <header class="article-info">
    <?php endif; ?>

<?php if ($header > 1) : ?>
    <hgroup>
    <?php endif; ?>

<?php if ($params->get('show_title')) : ?>
    <h1>
        <?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
        <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
            <?php echo htmlspecialchars($this->item->title); ?>
        </a>
        <?php else : ?>
        <?php echo htmlspecialchars($this->item->title); ?>
        <?php endif; ?>
    </h1>
    <?php endif; ?>

<?php  if (!$params->get('show_intro')) :
    echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php if ($details) : ?>
    <h2 class="article-info-term">
        <?php  echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?>
    </h2>
    <?php endif; ?>

<?php if ($params->get('show_parent_category') && $this->item->parent_id != 1) : ?>
    <h3 class="parent-category-name">
        <?php    $title = $this->escape($this->item->parent_title);
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
        <?php if ($params->get('link_parent_category')) : ?>
        <?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
        <?php else : ?>
        <?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
        <?php endif; ?>
    </h3>
    <?php endif; ?>

<?php if ($params->get('show_category')) : ?>
    <h3 class="category-name">
        <?php     $title = $this->escape($this->item->category_title);
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)) . '">' . $title . '</a>'; ?>
        <?php if ($params->get('link_category')) : ?>
        <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
        <?php else : ?>
        <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
        <?php endif; ?>
    </h3>
    <?php endif; ?>

<?php if ($header > 1) : ?>
    </hgroup>
    <?php endif; ?>

<?php if ($params->get('show_create_date')) : ?>
    <time class="create">
        <?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
    </time>
    <?php endif; ?>

<?php if ($params->get('show_modify_date')) : ?>
    <time class="modified">
        <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
    </time>
    <?php endif; ?>

<?php if ($params->get('show_publish_date')) : ?>
    <time class="published">
        <?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
    </time>
    <?php endif; ?>

<?php if ($params->get('show_author') && !empty($this->item->author)) : ?>
    <address class="createdby" rel="author">
        <?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
        <?php if (!empty($this->item->contactid) && $params->get('link_author') == true): ?>
        <?php
        $needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
        $item = JSite::getMenu()->getItems('link', $needle, true);
        $cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
        ?>
        <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
        <?php else: ?>
        <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
        <?php endif; ?>
    </address>
    <?php endif; ?>

<?php if ($params->get('show_hits')) : ?>
    <span class="hits">
        <?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
    </span>
    <?php endif; ?>

<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
    <ul class="actions">
        <?php if ($params->get('show_print_icon')) : ?>
        <li class="print-icon">
            <?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
        </li>
        <?php endif; ?>
        <?php if ($params->get('show_email_icon')) : ?>
        <li class="email-icon">
            <?php echo JHtml::_('icon.email', $this->item, $params); ?>
        </li>
        <?php endif; ?>
        <?php if ($canEdit) : ?>
        <li class="edit-icon">
            <?php echo JHtml::_('icon.edit', $this->item, $params); ?>
        </li>
        <?php endif; ?>
    </ul>
    <?php endif; ?>

<?php if ($header) : ?>
</header>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
    <?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
    <img class="img-intro <?php echo htmlspecialchars($imgfloat); ?>"
        <?php if ($images->image_intro_caption):
        echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_intro_caption) . '"';
    endif; ?>
            src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" />
    <?php endif; ?>

<?php echo $this->item->introtext; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
    if ($params->get('access-view')) :
        $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
    else :
        $menu = JFactory::getApplication()->getMenu();
        $active = $menu->getActive();
        $itemId = $active->id;
        $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
        $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
        $link = new JURI($link1);
        $link->setVar('return', base64_encode($returnURL));
    endif;
    ?>
    <p class="readmore">
        <a href="<?php echo $link; ?>">
            <?php if (!$params->get('access-view')) :
            echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
        elseif ($readmore = $this->item->alternative_readmore) :
            echo $readmore;
            if ($params->get('show_readmore_title', 0) != 0) :
                echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
            endif;
        elseif ($params->get('show_readmore_title', 0) == 0) :
            echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
        else :
            echo JText::_('COM_CONTENT_READ_MORE');
            echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
        endif; ?></a>
    </p>
    <?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</section>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent;

