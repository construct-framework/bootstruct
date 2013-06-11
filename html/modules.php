<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!
 * @author         Cristina Solana http://nightshiftcreative.com
 * @author         Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright      Copyright (C) 2009 - 2013 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

function getTopLevelMenuTitle($module)
{
    $app    = JFactory::getApplication();
    $menu   = $app->getMenu();
    $active = ($menu->getActive()) ? $menu->getActive() : $menu->getDefault();
    $items  = $menu->getItems('id', $active->tree[0]);

    return (count($items) == 1) ? $items[0]->title : $module->title;
}

function dynamicMenuTitle($module, $params)
{
    $isDynamic = strpos($params->get('moduleclass_sfx'), 'dynamic');
    if ($isDynamic) {
        $moduleTitle = getTopLevelMenuTitle($module);
    } else {
        $moduleTitle = $module->title;
    }

    return $moduleTitle;
}

function modChrome_div($module, $params, $attribs)
{
    $id          = isset($attribs['id']) ? $attribs['id'] : null;
    $headerLevel = isset($attribs['level']) ? (int)$attribs['level'] : 3;
    $headerClass = isset($attribs['header-class']) ? $attribs['header-class'] : null;
    $moduleClass = isset($attribs['module-class']) ? $attribs['module-class'] : null;
    $moduleTitle = dynamicMenuTitle($module, $params);

    if (!empty($module->content)) : ?>
	<div <?php if ($id) echo 'id="' . $id . '"'; ?> class="moduletable<?php echo $params->get('moduleclass_sfx') ?><?php if ($moduleClass) echo ' ' . $moduleClass ?>">
        <?php if ($module->showtitle) : ?>
                <h<?php echo $headerLevel ?> <?php if ($headerClass) echo 'class="' . $headerClass . '"' ?>><?php echo $moduleTitle ?><?php echo '</h' . $headerLevel ?>>
        <?php endif ?>
        <?php echo $module->content ?>
	</div>
    <?php endif;
}

function modChrome_aside($module, $params, $attribs)
{
    $id          = isset($attribs['id']) ? $attribs['id'] : null;
    $headerLevel = isset($attribs['level']) ? (int)$attribs['level'] : 3;
    $headerClass = isset($attribs['header-class']) ? $attribs['header-class'] : null;
    $moduleClass = isset($attribs['module-class']) ? $attribs['module-class'] : null;
    $moduleTitle = dynamicMenuTitle($module, $params);

    if (!empty($module->content)) : ?>
	<aside <?php if ($id) echo 'id="' . $id . '"'; ?> class="moduletable<?php echo $params->get('moduleclass_sfx') ?><?php if ($moduleClass) echo ' ' . $moduleClass ?>">
        <?php if ($module->showtitle) : ?>
                <h<?php echo $headerLevel ?> <?php if ($headerClass) echo 'class="' . $headerClass . '"' ?>><?php echo $moduleTitle ?><?php echo '</h' . $headerLevel ?>>
        <?php endif ?>
        <?php echo $module->content ?>
	</aside>
    <?php endif;
}

function modChrome_figure($module, $params, $attribs)
{
    $id          = isset($attribs['id']) ? $attribs['id'] : null;
    $headerLevel = isset($attribs['level']) ? (int)$attribs['level'] : 3;
    $headerClass = isset($attribs['header-class']) ? $attribs['header-class'] : null;
    $moduleClass = isset($attribs['module-class']) ? $attribs['module-class'] : null;
    $moduleTitle = dynamicMenuTitle($module, $params);

    if (!empty($module->content)) : ?>
	<figure <?php if ($id) echo 'id="' . $id . '"'; ?> class="moduletable<?php echo $params->get('moduleclass_sfx') ?><?php if ($moduleClass) echo ' ' . $moduleClass ?>">
        <?php if ($module->showtitle) : ?>
                <h<?php echo $headerLevel ?> <?php if ($headerClass) echo 'class="' . $headerClass . '"' ?>><?php echo $moduleTitle ?><?php echo '</h' . $headerLevel ?>>
        <?php endif ?>
        <?php echo $module->content ?>
	</figure>
    <?php endif;
}

function modChrome_footer($module, $params, $attribs)
{
    $id          = isset($attribs['id']) ? $attribs['id'] : null;
    $headerLevel = isset($attribs['level']) ? (int)$attribs['level'] : 3;
    $headerClass = isset($attribs['header-class']) ? $attribs['header-class'] : null;
    $moduleClass = isset($attribs['module-class']) ? $attribs['module-class'] : null;
    $moduleTitle = dynamicMenuTitle($module, $params);

    if (!empty($module->content)) : ?>
	<footer <?php if ($id) echo 'id="' . $id . '"'; ?> class="moduletable<?php echo $params->get('moduleclass_sfx') ?><?php if ($moduleClass) echo ' ' . $moduleClass ?>">
        <?php if ($module->showtitle) : ?>
                <h<?php echo $headerLevel ?> <?php if ($headerClass) echo 'class="' . $headerClass . '"' ?>><?php echo $moduleTitle ?><?php echo '</h' . $headerLevel ?>>
        <?php endif ?>
        <?php echo $module->content ?>
	</footer>
    <?php endif;
}

function modChrome_header($module, $params, $attribs)
{
    $id          = isset($attribs['id']) ? $attribs['id'] : null;
    $headerLevel = isset($attribs['level']) ? (int)$attribs['level'] : 3;
    $headerClass = isset($attribs['header-class']) ? $attribs['header-class'] : null;
    $moduleClass = isset($attribs['module-class']) ? $attribs['module-class'] : null;
    $moduleTitle = dynamicMenuTitle($module, $params);

    if (!empty($module->content)) : ?>
	<header <?php if ($id) echo 'id="' . $id . '"'; ?> class="moduletable<?php echo $params->get('moduleclass_sfx') ?><?php if ($moduleClass) echo ' ' . $moduleClass ?>">
        <?php if ($module->showtitle) : ?>
                <h<?php echo $headerLevel ?> <?php if ($headerClass) echo 'class="' . $headerClass . '"' ?>><?php echo $moduleTitle ?><?php echo '</h' . $headerLevel ?>>
        <?php endif ?>
        <?php echo $module->content ?>
	</header>
    <?php endif;
}

function modChrome_nav($module, $params, $attribs)
{
    $id          = isset($attribs['id']) ? $attribs['id'] : null;
    $headerLevel = isset($attribs['level']) ? (int)$attribs['level'] : 3;
    $headerClass = isset($attribs['header-class']) ? $attribs['header-class'] : null;
    $moduleClass = isset($attribs['module-class']) ? $attribs['module-class'] : null;
    $moduleTitle = dynamicMenuTitle($module, $params);

    if (!empty($module->content)) : ?>
	<nav <?php if ($id) echo 'id="' . $id . '"'; ?> class="moduletable<?php echo $params->get('moduleclass_sfx') ?><?php if ($moduleClass) echo ' ' . $moduleClass ?>">
        <?php if ($module->showtitle) : ?>
                <h<?php echo $headerLevel ?> <?php if ($headerClass) echo 'class="' . $headerClass . '"' ?>><?php echo $moduleTitle ?><?php echo '</h' . $headerLevel ?>>
        <?php endif ?>
        <?php echo $module->content ?>
	</nav>
    <?php endif;
}

function modChrome_section($module, $params, $attribs)
{
    $id          = isset($attribs['id']) ? $attribs['id'] : null;
    $headerLevel = isset($attribs['level']) ? (int)$attribs['level'] : 3;
    $headerClass = isset($attribs['header-class']) ? $attribs['header-class'] : null;
    $moduleClass = isset($attribs['module-class']) ? $attribs['module-class'] : null;
    $moduleTitle = dynamicMenuTitle($module, $params);

    if (!empty($module->content)) : ?>
	<section <?php if ($id) echo 'id="' . $id . '"'; ?> class="moduletable<?php echo $params->get('moduleclass_sfx') ?><?php if ($moduleClass) echo ' ' . $moduleClass ?>">
        <?php if ($module->showtitle) : ?>
                <h<?php echo $headerLevel ?> <?php if ($headerClass) echo 'class="' . $headerClass . '"' ?>><?php echo $moduleTitle ?><?php echo '</h' . $headerLevel ?>>
        <?php endif ?>
        <?php echo $module->content ?>
	</section>
    <?php endif;
}
