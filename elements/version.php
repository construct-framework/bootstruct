<?php
/**
 * Tweet Display Back Module for Joomla!
 *
 * @package    TweetDisplayBack
 *
 * @copyright  Copyright (C) 2010-2012 Michael Babker. All rights reserved.
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die;

/**
 * Field type to display the version and check for a newer version.
 *
 * @package  TweetDisplayBack
 * @since    2.1
 */
class JFormFieldVersion extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  2.1
	 */
	protected $type = 'Version';

	/**
	 * Method to get the field input.
	 *
	 * @return  string
	 *
	 * @since   2.1
	 */
	protected function getInput()
	{
		return '';
	}

	/**
	 * Method to get the field label.
	 *
	 * @return  string  A message containing the installed version and,
	 *                  if necessary, information on a new version.
	 *
	 * @since           2.1
	 */
	protected function getLabel()
	{
		// Check if cURL is loaded; if not, proceed no further
		if (!extension_loaded('curl')) {
			return JText::_('TPL_BOOTSTRUCT_ERROR_NOCURL');
		} // If cURL is supported, check the current version available.
		else {
			// Get the module's XML
			$xmlfile = JPATH_SITE . '/templates/bootstruct/templateDetails.xml';

			$data = JApplicationHelper::parseXMLInstallFile($xmlfile);

			// The module's version
			$version = $data['version'];
			$name    = str_replace(array('construct','bootstruct'),array('Construct','Bootstruct'), $data['name']);

			// The target to check against
			$target = 'http://construct-framework.com/upgradecheck/' . $data['name'];

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $target);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			$update = curl_exec($curl);
			curl_close($curl);

			// Message containing the version
			$message = '<label style="max-width:100%">' . JText::sprintf('TPL_BOOTSTRUCT_VERSION_INSTALLED', $name, $version);

			// If an update is available, and compatible with the current Joomla! version, notify the user
			if (version_compare($version, $update,'lt')) {
				$message .= '  <a href="http://construct-framework.com" target="_blank">' . JText::sprintf('TPL_BOOTSTRUCT_VERSION_UPDATE', $update) . '</a></label>';
			} // No updates, or the Joomla! version is not compatible, so let the user know they're using the current version
			else {
				$message .= '  ' . JText::_('TPL_BOOTSTRUCT_VERSION_CURRENT') . '</label>';
			}
			return $message;
		}
	}
}