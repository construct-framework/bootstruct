<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

?>
<section class="contact<?php echo $this->pageclass_sfx?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<h1>
    <?php echo htmlspecialchars($this->params->get('page_heading')); ?>
</h1>
    <?php endif; ?>
<?php if ($this->contact->name && $this->params->get('show_name')) : ?>
<h2 class="contact-name">
    <?php echo $this->contact->name; ?>
</h2>
    <?php endif;  ?>
<?php if ($this->params->get('show_contact_category') == 'show_no_link') : ?>
<h3 class="contact-category">
    <?php echo $this->contact->category_title; ?>
</h3>
    <?php endif; ?>
<?php if ($this->params->get('show_contact_category') == 'show_with_link') : ?>
    <?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid); ?>
<h3 class="contact-category">
    <a href="<?php echo $contactLink; ?>">
        <?php echo htmlspecialchars($this->contact->category_title); ?>
    </a>
</h3>
    <?php endif; ?>
<?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
<form action="#" method="get" name="selectForm" id="selectForm">
    <?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?>
    <?php echo JHtml::_('select.genericlist', $this->contacts, 'id', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link);?>
</form>
    <?php endif; ?>
<?php  if ($this->params->get('presentation_style') != 'plain') { ?>
    <?php echo  JHtml::_($this->params->get('presentation_style') . '.start', 'contact-slider'); ?>
    <?php echo JHtml::_($this->params->get('presentation_style') . '.panel', JText::_('COM_CONTACT_DETAILS'), 'basic-details');
} ?>
<?php if ($this->params->get('presentation_style') == 'plain'): ?>
<h3>
    <?php  echo JText::_('COM_CONTACT_DETAILS');  ?>
</h3>
    <?php endif; ?>
<?php if ($this->contact->image && $this->params->get('show_image')) : ?>
<div class="contact-image">
    <?php echo JHtml::_('image', $this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('align' => 'middle')); ?>
</div>
    <?php endif; ?>

<?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
<p class="contact-position"><?php echo $this->contact->con_position; ?></p>
    <?php endif; ?>

<?php echo $this->loadTemplate('address'); ?>

<?php if ($this->params->get('allow_vcard')) : ?>
    <?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
    <?php echo JText::_('COM_CONTACT_VCARD');?></a>
    <?php endif; ?>

<?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>

    <?php if ($this->params->get('presentation_style') != 'plain'): ?>
        <?php echo JHtml::_($this->params->get('presentation_style') . '.panel', JText::_('COM_CONTACT_EMAIL_FORM'), 'display-form'); ?>
        <?php endif; ?>
    <?php if ($this->params->get('presentation_style') == 'plain'): ?>
    <h3>
        <?php echo JText::_('COM_CONTACT_EMAIL_FORM');  ?>
    </h3>
        <?php endif; ?>
    <?php echo $this->loadTemplate('form'); ?>
    <?php endif; ?>
<?php if ($this->params->get('show_links')) : ?>
    <?php echo $this->loadTemplate('links'); ?>
    <?php endif; ?>
<?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
    <?php if ($this->params->get('presentation_style') != 'plain'): ?>
        <?php echo JHtml::_($this->params->get('presentation_style') . '.panel', JText::_('JGLOBAL_ARTICLES'), 'display-articles'); ?>
        <?php endif; ?>
    <?php if ($this->params->get('presentation_style') == 'plain'): ?>
    <h3>
        <?php echo JText::_('JGLOBAL_ARTICLES'); ?>
    </h3>
        <?php endif; ?>
    <?php echo $this->loadTemplate('articles'); ?>
    <?php endif; ?>
<?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
    <?php if ($this->params->get('presentation_style') != 'plain'): ?>
        <?php echo JHtml::_($this->params->get('presentation_style') . '.panel', JText::_('COM_CONTACT_PROFILE'), 'display-profile'); ?>
        <?php endif; ?>
    <?php if ($this->params->get('presentation_style') == 'plain'): ?>
    <h3>
        <?php echo JText::_('COM_CONTACT_PROFILE'); ?>
    </h3>
        <?php endif; ?>
    <?php echo $this->loadTemplate('profile'); ?>
    <?php endif; ?>
<?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>
    <?php if ($this->params->get('presentation_style') != 'plain') { ?>
        <?php echo JHtml::_($this->params->get('presentation_style') . '.panel', JText::_('COM_CONTACT_OTHER_INFORMATION'), 'display-misc');
    } ?>
    <?php if ($this->params->get('presentation_style') == 'plain'): ?>
    <h3>
        <?php echo JText::_('COM_CONTACT_OTHER_INFORMATION'); ?>
    </h3>
        <?php endif; ?>
<section class="contact-miscinfo">
    <dl>
        <dt class="<?php echo $this->params->get('marker_class'); ?>">
            <?php echo $this->params->get('marker_misc'); ?>
        </dt>
        <dd class="contact-misc">
            <?php echo $this->contact->misc; ?>
        </dd>
    </dl>
</section>
    <?php endif; ?>
<?php if ($this->params->get('presentation_style') != 'plain') { ?>
    <?php echo JHtml::_($this->params->get('presentation_style') . '.end');
} ?>
</section>

