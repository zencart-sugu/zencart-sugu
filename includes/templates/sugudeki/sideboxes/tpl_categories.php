<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_categories.php **** 2009-01-23 15:10:00Z yama.kyms $
 */

$currentLevel  =  1;
$prevLevel     = '';
$nextLevel     = '';
$diffLevelPrev = '';
$diffLevelNext = '';
$content       = '';
$addStr        = array();
$class         = '';

$content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";

		$content .= '<p class="more"><a href="' . zen_href_link(FILENAME_PRODUCTS_ALL) . '">';
		$content .= zen_image_button(BUTTON_IMAGE_MORE, BUTTON_MORE_ALT,'class="imgover"');
		$content .= '</a></li>' . "\n";

/*
if (   SHOW_CATEGORIES_BOX_SPECIALS          == 'true'
    or SHOW_CATEGORIES_BOX_PRODUCTS_NEW      == 'true'
    or SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true'
    or SHOW_CATEGORIES_BOX_PRODUCTS_ALL      == 'false')
{
	// display a separator between categories and links

	$content .= '<ul class="links">';
	if (SHOW_CATEGORIES_BOX_SPECIALS == 'true')
	{
		$query = 'select s.products_id from ' . TABLE_SPECIALS . ' s where s.status= 1 limit 1';
		$show_this = $db->Execute($query);
		if ($show_this->RecordCount() > 0)
		{
			$content .= '<li class="links">';
			$content .= '<a href="' . zen_href_link(FILENAME_SPECIALS) . '">';
			$content .= CATEGORIES_BOX_HEADING_SPECIALS . '</a></li>' . "\n";
		}
	}
	if (SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true')
	{
		// display limits
		$display_limit = zen_get_products_new_timelimit();
		$query  = 'select p.products_id ';
		$query .= 'from ' . TABLE_PRODUCTS .  ' p ';
		$query .= 'where p.products_status = 1 ' . $display_limit . ' limit 1';
		$show_this = $db->Execute($query);
		if ($show_this->RecordCount() > 0)
		{
			$content .= '<li class="links">';
			$content .= '<a href="' . zen_href_link(FILENAME_PRODUCTS_NEW) . '">';
			$content .= CATEGORIES_BOX_HEADING_WHATS_NEW . '</a></li>' . "\n";
		}
	}
	if (SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true')
	{
		$query = 'select products_id from ' . TABLE_FEATURED . ' where status= 1 limit 1';
		$show_this = $db->Execute($query);
		if ($show_this->RecordCount() > 0)
		{
			$content .= '<li class="links">';
			$content .= '<a href="' . zen_href_link(FILENAME_FEATURED_PRODUCTS) . '">';
			$content .= CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS . '</a></li>' . "\n";
		}
	}
	if (SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true')
	{
		$content .= '<li class="links">';
		$content .= '<a href="' . zen_href_link(FILENAME_PRODUCTS_ALL) . '">';
		$content .= CATEGORIES_BOX_HEADING_PRODUCTS_ALL . '</a></li>' . "\n";
	}
}
$content .= '</ul>';
*/

$content .= "<ul class=\"categories\">\n";
for ($i=0;$i<sizeof($box_categories_array);$i++)
{
	$prevLevel     = $currentLevel;
	$currentLevel  = count(explode('_', $box_categories_array[$i]['path']));
	$nextLevel     = count(explode('_', $box_categories_array[$i + 1]['path']));
	$diffLevelPrev = $currentLevel - $prevLevel;
	$diffLevelNext = $currentLevel - $nextLevel;
	$class         = setStyle($box_categories_array[$i]);
	$count         = showCount_is($box_categories_array[$i]['count']);
	$addStr        = setTags($diffLevelPrev, $diffLevelNext);

	$content .= $addStr['preLine'] . '<li' . $class . '>';
	$content .= '<a href="' . zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']) . '">';
	$content .= $box_categories_array[$i]['name'];
	$content .= $count . '</a>';
	$content .= $addStr['postLine'] . "";
}
$content .= "</ul>\n";

$content .= '</div>'."\n";

function setStyle($box_categories_array)
{
	$top_is      = $box_categories_array['top'];
	$has_sub_cat = $box_categories_array['has_sub_cat'];
	$current_is  = $box_categories_array['current'];
	if     ($top_is == 'true') {$class = ''         ;}
	elseif ($has_sub_cat)      {$class = 'subs '    ;}
	else                       {$class = 'products ';}
	
	if ($current_is) {$class .= 'current ';}
	if ($current_is)
	{
		if ($has_sub_cat) {$class .= 'subs-parent ';}
		else {$class .= 'subs-selected ';}
	}
	$class = trim($class);
	$class = empty($class) ? '' : " class=\"$class\"" ;
	return $class;
}

function showCount_is($count)
{
	if (SHOW_COUNTS == 'true')
	{
		$value ='';
		if ((CATEGORIES_COUNT_ZERO == '1' and $count == 0) or $count >= 1)
		{
			$value = CATEGORIES_COUNT_PREFIX . $count . CATEGORIES_COUNT_SUFFIX;
		}
	}
	return $value;
}

function setTags($diffLevelPrev, $diffLevelNext)
{
	$addStr['preLine']  = '';
	$addStr['postLine'] = '';
	if     (($diffLevelPrev == 0) and ($diffLevelNext  < 0)) { }
	elseif (($diffLevelPrev  > 0) and ($diffLevelNext  < 0))
	{
		$addStr['preLine'] = '<ul>'."\n";
	}
	elseif (($diffLevelPrev  > 0) and ($diffLevelNext == 0))
	{
		$addStr['preLine'] = '<ul>';
		$addStr['postLine'] = '</li>'."\n";
	}
	elseif (($diffLevelPrev == 0) and ($diffLevelNext  > 0))
	{
		while ($diffLevelNext > 0)
		{
			$addStr['postLine'] .= '</li></ul></li>'."\n";
			$diffLevelNext--;
		}
	}
	elseif (($diffLevelPrev  < 0) and ($diffLevelNext == 0))
	{
		$addStr['postLine'] = "</li>\n";
	}
	elseif (($diffLevelPrev == 0) and ($diffLevelNext == 0))
	{
		$addStr['postLine'] = "</li>\n";
	}
	return $addStr;
}
?>