<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('_JEXEC') or die('Restricted access');// no direct access

if (!JComponentHelper::isEnabled('com_phocapanorama', true)) {
	$app = JFactory::getApplication();
	$app->enqueueMessage(JText::_('Phoca Panorama Error'), JText::_('Phoca Panorama is not installed on your system'), 'error');
	return;
}


jimport( 'joomla.filesystem.folder' );
jimport( 'joomla.filesystem.file' );
require_once( JPATH_ADMINISTRATOR.'/components/com_phocapanorama/helpers/phocapanoramautils.php' );
require_once( JPATH_ADMINISTRATOR.'/components/com_phocapanorama/helpers/phocapanorama.php' );
require_once( JPATH_ADMINISTRATOR.'/components/com_phocapanorama/helpers/html/ordering.php' );
require_once( JPATH_ADMINISTRATOR.'/components/com_phocapanorama/helpers/route.php' );
require_once( JPATH_ADMINISTRATOR.'/components/com_phocapanorama/helpers/pagination.php' );


$id		= $params->get( 'id', 0 );

if ((int)$id < 1) {
	echo JText::_('MOD_PHOCAPANORAMA_PANORAMA_ID_NOT_SET');
} else {

	$component	= 'com_phocapanorama';
	$pC			= JComponentHelper::getParams($component) ;
	$document	= JFactory::getDocument();
	//$p['panorama_metakey'] 		= $pC->get( 'panorama_metakey', '' );
	//$p['panorama_metadesc'] 	= $pC->get( 'panorama_metadesc', '' );
	$p['load_bootstrap']		= $pC->get( 'load_bootstrap', 0 );
	$p['panorama_width']		= $pC->get( 'panorama_width', '100%' );
	$p['panorama_height']		= $pC->get( 'panorama_height', '500px' );
	$p['display_method']		= $pC->get( 'display_method', 1 );
	$p['file_name']				= htmlspecialchars($pC->get( 'file_name', 'tour' ));
	$p['display_back']			= $pC->get( 'display_back', 3 );

    $path								= PhocaPanoramaUtils::getPath();
    $this->t['panoramapathrel']			= $path['rel'];
    $this->t['panoramapathabs']			= $path['abs'];


	$lang = JFactory::getLanguage();
	//$lang->load('com_phocapanorama.sys');
	$lang->load('com_phocapanorama');

	//JLoader::import('joomla.application.component.model');
	JLoader::import( 'item', JPATH_SITE .'/components/com_phocapanorama/models' );
	$model = JModelLegacy::getInstance( 'Item', 'PhocaPanoramaModel' );
	$category 	= $model->getCategory($id);
	$item		= $model->getItem($id);


	JHTML::stylesheet('media/com_phocapanorama/css/style.css' );

	if ($p['load_bootstrap'] == 1) {
		JHTML::stylesheet('media/com_phocapanorama/bootstrap/css/bootstrap.min.css' );
		$document->addScript(JURI::root(true).'/media/com_phocapanorama/bootstrap/js/bootstrap.min.js');
	}

}

require(JModuleHelper::getLayoutPath('mod_phocapanorama'));
?>
