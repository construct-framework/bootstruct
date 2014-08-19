<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<?php if ($item->parent) { ?>
<a class="nav-header dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $item->title; ?><span class="caret"></span></a><?php
	} else {
?><span class="nav-header"><?php echo $item->title; ?></span><?php
}