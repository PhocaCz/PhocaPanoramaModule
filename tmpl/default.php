<?php // no direct access
defined('_JEXEC') or die('Restricted access');

if ( isset($item[0]->description) && $item[0]->description != '') {
	echo '<div class="ph-desc">'. $item[0]->description. '</div>';
}
//echo '<div class="ph-pano-module">';
if (!empty($item[0])) {
	
	if (isset($item[0]->iframe_link) && $item[0]->iframe_link != '' ) {
		echo '<iframe style="width:'.$p['panorama_width'].';height:'.$p['panorama_height'].';border: 0px" src="'.htmlspecialchars($item[0]->iframe_link).'"></iframe>';
	} else if ($p['display_method'] == 1) {
		$tourAbs 	= $p['panoramapathabs'] . htmlspecialchars($item[0]->folder).'/'.$p['file_name'].'.html';
		$tourRel 	= $p['panoramapathrel'] . htmlspecialchars($item[0]->folder).'/'.$p['file_name'].'.html';
		
		echo '<iframe style="width:'.$p['panorama_width'].';height:'.$p['panorama_height'].';border: 0px" src="'.$tourRel.'"></iframe>';
	} else {
		
		$document->setMetadata('viewport', 'target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0');
		$document->setMetadata('apple-mobile-web-app-capable', 'yes');

		$s = '@-ms-viewport { width: device-width; }
			@media only screen and (min-device-width: 800px) { html { overflow:hidden; } }
			html { height:100%; }
			body { height:100%; overflow:hidden; margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FFFFFF; background-color:#000000; }';
		//$document->addCustomTag('<style type="text/css">'.$s.'</style>');
		$tourAbs 	= $p['panoramapathabs'] . htmlspecialchars($item[0]->folder).'/'.$p['file_name'].'.js';
		$tourRel 	= $p['panoramapathrel'] . htmlspecialchars($item[0]->folder).'/'.$p['file_name'].'.js';
		$path 		= JURI::base(true). '/' . $p['panoramapathrel'] . htmlspecialchars($item[0]->folder);
		
		if (JFile::exists($tourAbs)) {
			$document->addScript(JURI::root(true).'/'.$tourRel);
			echo '<div id="ph-pano-module" style="width:'.$p['panorama_width'].';height:'.$p['panorama_height'].';">';
			echo '<script type="text/javascript">'. "\n";
			echo 'var viewer = createPanoViewer({swf:"'. $path .'/'.$p['file_name'].'.swf", target:"ph-pano-module", html5:"auto", passQueryParameters:true});'. "\n";
			echo 'viewer.addVariable("xml", "'.$path .'/'.$p['file_name'].'.xml");'. "\n";
			echo 'viewer.embed();'."\n";
			echo '</script>'. "\n";
			echo '</div>';
		}
	
	}
}
//echo '</div>';
?>


