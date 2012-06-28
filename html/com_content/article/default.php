<?php defined('_JEXEC') or die;
/**
 * @package        Unified HTML5 Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

JHtml::addIncludePath(JPATH_COMPONENT . DS . 'helpers');

// Create shortcuts to some parameters.
$params = $this->item->params;
$images = json_decode($this->item->images);
$urls = json_decode($this->item->urls);
$canEdit = $this->item->params->get('access-edit');
$user = JFactory::getUser();
$details = $params->get('show_parent_category') + $params->get('show_category') + $params->get('show_create_date') + $params->get('show_modify_date') + $params->get('show_publish_date') + ($params->get('show_author') && !empty($this->item->author)) + $params->get('show_hits');
$header = $details + $this->params->get('show_page_heading') + $params->get('show_title') + $params->get('show_parent_category') + $params->get('show_category');

?>
<article class="item-page<?php echo $this->pageclass_sfx?>">
    <?php if ($header) : ?>
    <header class="article-info">
    <?php endif; ?>

    <?php if ($header > 1) : ?>
    <hgroup>
    <?php endif; ?>

    <?php if ($this->params->get('show_page_heading', 1)) : ?>
    <h1>
        <?php echo htmlspecialchars($this->params->get('page_heading')); ?>
    </h1>
    <?php endif; ?>

    <?php if ($params->get('show_title')) : ?>
    <h2>
        <?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
        <a href="<?php echo $this->item->readmore_link; ?>">
            <?php echo htmlspecialchars($this->item->title); ?>
        </a>
        <?php else : ?>
        <?php echo htmlspecialchars($this->item->title); ?>
        <?php endif; ?>
    </h2>
    <?php endif; ?>

    <?php  if (!$params->get('show_intro')) :
    echo $this->item->event->afterDisplayTitle;
endif; ?>

    <?php if ($details) : ?>
    <h3 class="article-info-term">
        <?php  echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?>
    </h3>
    <?php endif; ?>

    <?php if ($params->get('show_parent_category') && $this->item->parent_id != '1:root') : ?>
    <h3 class="parent-category-name">
        <?php    $title = $this->escape($this->item->parent_title);
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>';?>
        <?php if ($params->get('link_parent_category') AND $this->item->parent_id) : ?>
        <?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
        <?php else : ?>
        <?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
        <?php endif; ?>
    </h3>
    <?php endif; ?>

    <?php if ($params->get('show_category')) : ?>
    <h3 class="category-name">
        <?php     $title = $this->escape($this->item->category_title);
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>';?>
        <?php if ($params->get('link_category') AND $this->item->catslug) : ?>
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
        $menu = JFactory::getApplication()->getMenu();
        $item = $menu->getItems('link', $needle, true);
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
        <?php if (!$this->print) : ?>
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
        <?php else : ?>
        <li>
            <?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
        </li>
        <?php endif; ?>
    </ul>
    <?php endif; ?>

    <?php if ($header) : ?>
</header>
<?php endif; ?>

    <?php echo $this->item->event->beforeDisplayContent; ?>

    <?php if (isset ($this->item->toc)) : ?>
    <?php echo $this->item->toc; ?>
    <?php endif; ?>

    <?php if ($params->get('access-view')): ?>
    <?php if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
        <?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
        <img class="img-fulltext <?php echo htmlspecialchars($imgfloat); ?>"
            <?php if ($images->image_fulltext_caption):
            echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_fulltext_caption) . '"';
        endif; ?>
                src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" />
        <?php endif; ?>

    <?php if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
        echo $this->item->pagination; ?>
        <?php endif; ?>

    <?php echo $this->item->text; ?>
    <?php if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND!$this->item->paginationrelative):
        echo $this->item->pagination; ?>
        <?php endif; ?>

    <?php if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position == '1')) OR ($params->get('urls_position') == '1'))): ?>
        <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>

    <?php //optional teaser intro text for guests ?>
    <?php elseif ($params->get('show_noauth') == true AND  $user->get('guest')) : ?>
    <?php echo $this->item->introtext; ?>
    <?php //Optional link to let them register to see the whole article. ?>
    <?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
        $link1 = JRoute::_('index.php?option=com_users&view=login');
        $link = new JURI($link1);?>
        <p class="readmore btn btn-primary">
            <a href="<?php echo $link; ?>">
                <?php $attribs = json_decode($this->item->attribs);  ?>
                <?php
                if ($attribs->alternative_readmore == null) :
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
                endif; ?>
            </a>
        </p>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
    echo $this->item->pagination;?>
    <?php endif; ?>
    <?php echo $this->item->event->afterDisplayContent; ?>
</article>

