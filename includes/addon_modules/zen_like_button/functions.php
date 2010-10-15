<?php
/**
 * addon_modules_skeleten modules functions.php
 *
 * @package functions
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */

	function build_like_button() {

		$facebook_src = "http://www.facebook.com/plugins/like.php?";

		//URL
		$href = "href=http://";
		$href .= $_SERVER["SERVER_NAME"];
		$href .= $_SERVER["SCRIPT_NAME"];
		if(!empty($_SERVER["QUERY_STRING"])) {
			$href .= '?';
			$href .= urlencode($_SERVER["QUERY_STRING"]);
		}
//$href = urlencode("http://okra.ark-web.jp/~hachiya/sugudeki/zencart-sugu/");
		//FacebookAPIのパラメータ
		$layout =		"&amp;layout=" . MODULE_ZEN_LIKE_BUTTON_LAYOUT;
		$show_faces =	"&amp;show_faces=" . MODULE_ZEN_LIKE_BUTTON_FACE;
		$width =		"&amp;width=" . MODULE_ZEN_LIKE_BUTTON_IFRAME_WIDTH;
		$height =		"&amp;height=" . MODULE_ZEN_LIKE_BUTTON_IFRAME_HEIGHT;
		$action =		"&amp;action=" . MODULE_ZEN_LIKE_BUTTON_ACTION;
		$color =		"&amp;colorscheme=" . MODULE_ZEN_LIKE_BUTTON_COLOR_LIGHT . "'";

		//iframeの属性
		$scrolling =	"scrolling='" . MODULE_ZEN_LIKE_BUTTON_IFRAME_SCROLLING . "'";
		$frameborder =	"frameborder='" . MODULE_ZEN_LIKE_BUTTON_IFRAME_FRAMEBORDER . "'";
		$style =		"style='" . MODULE_ZEN_LIKE_BUTTON_IFRAME_STYLE_BORDER
									.MODULE_ZEN_LIKE_BUTTON_IFRAME_STYLE_OVERFLOW
									.MODULE_ZEN_LIKE_BUTTON_IFRAME_STYLE_WIDTH
									.MODULE_ZEN_LIKE_BUTTON_IFRAME_STYLE_HEIGHT . "'";

		$allowTransparency = "allowTransparency='" . MODULE_ZEN_LIKE_BUTTON_IFRAME_ALLOWTRANSPARENCY . "'";

		$iframe = "<iframe src='"
					. $facebook_src
					. $href
					. $layout
					. $show_faces
					. $width
					. $height
					. $action
					. $color
					. " "
					. $scrolling
					. $frameborder
					. $style
					. $allowTransparency
					. ">"
					. "</iframe>";

		return $iframe;

	}
?>
