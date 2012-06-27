<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!
 * @author         Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright      Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * JFormFieldGooglewebfont
 *
 * Provides list of Google Web Fonts
 *
 * @static
 * @package        Molajo
 * @subpackage     HTML
 * @since          1.6
 */
class JFormFieldGooglewebfont extends JFormFieldList
{
	/**
	 * Field Type
	 *
	 * @var        string
	 * @since    1.6
	 */
	public $type = 'Googlewebfont';

	/**
	 * getOptions
	 *
	 * Generates list options
	 *
	 * @return    array    The field option objects.
	 * @since    1.6
	 */
	protected function getOptions()
	{
		$link    = 'https://www.googleapis.com/webfonts/v1/webfonts';
		$json    = @file_get_contents($link);
		$data    = json_decode($json, true);
		$items   = $data['items'];
		$options = array();

		$options[] = JHtml::_('select.option', '', '- None Selected -');
		foreach ($items as $item) {
			$options[] = JHtml::_('select.option', str_replace(" ", "+", $item['family']), $item['family']);
		}

		return $options;
	}
}