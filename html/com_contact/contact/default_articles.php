<?php defined('_JEXEC') or die;
/**
 * @version        $Id: default_articles.php 21097 2011-04-07 15:38:03Z dextercowley $
 * @package        Joomla.Site
 * @subpackage    com_contact
 * @copyright    Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

require_once JPATH_SITE . '/components/com_content/helpers/route.php';

if ($this->params->get('show_articles')) :
    ?><section class="contact-articles">
        <ol>
            <?php foreach ($this->item->articles as $article) : ?>
            <li>
                <?php echo JHtml::_('link', JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug)), htmlspecialchars($article->title, ENT_COMPAT, 'UTF-8')); ?>
            </li>
            <?php endforeach; ?>
        </ol>
    </section>
<?php endif;
