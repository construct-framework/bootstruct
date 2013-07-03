<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$title = $item->anchor_title ? ' title="'.$item->anchor_title.'" ' : '';
if ($item->menu_image)
	{
		$item->params->get('menu_text', 1) ?
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><span class="image-title">'.$item->title.'</span> ' :
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
}
else { $linktype = $item->title;
}

if ($item->parent) { ?>
<a class="separator dropdown-toggle" data-toggle="dropdown" href="#"<?php echo $title; ?>><?php echo $linktype; ?><span class="caret"></span></a><?php
	} else {
?><span class="separator"<?php echo $title; ?>><?php echo $linktype; ?></span><?php
}