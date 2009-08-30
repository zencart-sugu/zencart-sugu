<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// | FCKeditor - The text editor for internet                             |
// | Copyright (C) 2003-2004 Frederico Caldeira Knabben                   |
// | Licensed under the terms of the GNU Lesser General Public License    |
// | (http://www.opensource.org/licenses/lgpl-license.php)                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: fckeditor.php 1863 2005-08-19 04:28:27Z drbyte $
//


class FCKeditor
{
	var $ToolbarSet ;
	var $Value ;
	var $CanUpload ;
	var $CanBrowse ;
	var $BasePath ;

	function FCKeditor()
	{
		$this->ToolbarSet = '' ;      // blank or "Basic" or "Accessible"
		$this->Value = '' ;           // default text
		$this->CanUpload = 'true' ;   // true or none
		$this->CanBrowse = 'true' ;   // true or none
		$this->BasePath = DIR_WS_CATALOG.'FCKeditor/' ;
	}
	
	function CreateFCKeditor($instanceName, $width, $height)
	{
		echo $this->ReturnFCKeditor($instanceName, $width, $height) ;
	}
	
	function ReturnFCKeditor($instanceName, $width, $height)
	{

//		$grstr = htmlentities( $this->Value ) ;
		$grstr = htmlspecialchars( $this->Value ) ;

		$strEditor = "" ;
		
		if ( $this->IsCompatible() )
		{
			$sLink = $this->BasePath . "fckeditor.html?FieldName=$instanceName" ;

			if ( $this->ToolbarSet != '' )
				$sLink = $sLink . "&Toolbar=$this->ToolbarSet" ;

			if ( $this->CanUpload != 'none' )
			{
				if ($this->CanUpload == true)
					$sLink = $sLink . "&Upload=true" ;
				else
					$sLink = $sLink . "&Upload=false" ;
			}

			if ( $this->CanBrowse != 'none' )
			{
				if ($this->CanBrowse == true)
					$sLink = $sLink . "&Browse=true" ;
				else
					$sLink = $sLink . "&Browse=false" ;
			}

			$strEditor .= "<IFRAME src=\"$sLink\" width=\"$width\" height=\"$height\" frameborder=\"no\" scrolling=\"no\"></IFRAME>" ;
			$strEditor .= "<INPUT type=\"hidden\" name=\"$instanceName\" value=\"$grstr\">" ;
		}
		else
		{
			$strEditor .= "<TEXTAREA name=\"$instanceName\" rows=\"4\" cols=\"40\" style=\"WIDTH: $width; HEIGHT: $height\" wrap=\"virtual\">$grstr</TEXTAREA>" ;
		}
		
		return $strEditor;
	}
	
	function IsCompatible()
	{
		$sAgent = $_SERVER['HTTP_USER_AGENT'] ;

		if ( is_integer( strpos($sAgent, 'MSIE') ) && is_integer( strpos($sAgent, 'Windows') ) && !is_integer( strpos($sAgent, 'Opera') ) )
		{
			$iVersion = (int)substr($sAgent, strpos($sAgent, 'MSIE') + 5, 1) ;
			return ($iVersion >= 5) ;
		} else {
			return FALSE ;
		}
	}
}
?>