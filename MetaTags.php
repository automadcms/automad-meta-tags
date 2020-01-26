<?php
/**
 *	Automad Meta Tags
 *
 * 	An Automad meta tags extension.
 *
 * 	@author Marc Anton Dahmen
 * 	@copyright Copyright (C) 2018 Marc Anton Dahmen - <https://marcdahmen.de> 
 * 	@license MIT license
 */

namespace Automad;

defined('AUTOMAD') or die('Direct access not permitted!');


class MetaTags {
	
	
	/**
	 *  The main function.
	 *
	 * 	@param array $options
	 * 	@param object $Automad
	 * 	@return string the output of the extension
	 */
	
	public function MetaTags($options, $Automad) {
		
		$Page = $Automad->Context->get();
		
		$defaults = array(
			'charset' => 'utf-8',
			'viewport' => 'width=device-width, initial-scale=1, shrink-to-fit=no',
			'description' => false,
			'ogTitle' => $Automad->Shared->get('sitename') . ' / ' . $Page->get('title'),
			'ogDescription' => false,
			'ogType' => 'website',
			'ogImage' => false,
			'twitterCard' => false
		);
		
		$options = array_merge($defaults, $options);
		
		$host = getenv('HTTP_HOST');
		$protocol = 'http';
		
		if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
			$protocol = 'https';
		}
		
		$baseUrl = $protocol . '://' . $host . AM_BASE_URL;
		$baseIndex = $protocol . '://' . $host . AM_BASE_INDEX;
		
		$html = '';
		
		$html .= '<meta charset="' . $options['charset'] . '" />';
		$html .= '<meta name="viewport" content="' . $options['viewport'] . '" />';
		
		if ($options['description']) {
			$html .= '<meta name="description" content="' . Core\Str::shorten($options['description'], 160) . '" />';
		}
		
		if ($options['ogTitle']) {
			$html .= '<meta property="og:title" content="' . $options['ogTitle'] . '" />';
		}
		
		if ($options['ogDescription']) {
			$html .= '<meta property="og:description" content="' . Core\Str::shorten($options['ogDescription'], 320) . '" />';
		}
		
		$html .= '<meta property="og:type" content="' . $options['ogType'] . '" />' . 
		         '<meta property="og:url" content="' . $baseIndex . $Page->url . '" />';
		         
		
		if ($options['ogImage']) {
			
			$files = Core\Parse::fileDeclaration($options['ogImage'], $Page);
			
			if ($files) {
				$file = reset($files);
				$Image = new Core\Image($file);
				$imageUrl =  $baseUrl . $Image->file;
			} else {
				$imageUrl = $options['ogImage'];
			}
			
			$html .= '<meta property="og:image" content="' . $imageUrl . '" />';
			
		}
		
		if ($options['twitterCard']) {
			$html .= '<meta name="twitter:card" content="' . $options['twitterCard'] . '" />';
        	$html .= '<meta name="twitter:title" content="' . $options['ogTitle'] . '" />';
        	$html .= '<meta name="twitter:description" content="' . Core\Str::shorten($options['ogDescription'], 320) . '" />';
        	$html .= '<meta name="twitter:url" content="' . $baseIndex . $Page->url . '" />';
        	$html .= '<meta name="twitter:image" content="' . $imageUrl . '" />';

		}
		
		return $html;
		
	}
	
	
}
