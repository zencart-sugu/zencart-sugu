/*
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |   
// | http://www.zen-cart.com/index.php                                    |   
// |                                                                      |   
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: $
*/
/*

// jQueryがある前提

↓こういうサンプルがある想定

<ul id="product-listing">
<li>hoge1</li>
<li>hoge2</li>
<li>hoge3</li>
</ul>
<ul id="ajax-nextpage">
<li><a class="whiteButton" href="#">next page</a></li>
</ul>

<script type="text/javascript">
var option = {
	current_page: 1,
	max_page: 3,
	max_page_callback: function () {
		// 全ページ描画したら次のページへのリンクは隠す
		$('#ajax-nextpage').hide();
	}
};
var apd = new $.nextPageAdd(option);
$('#ajax-nextpage a').click(apd.addPage);
</script>
*/
(function($) {
    $.nextPageAdd = function(options) {
        options = $.extend({
            current_page: 1,
            max_page: 3,
            url: "http://example.com/?page=",
            loading: "<li id='loading'>nowloading...</li>",
            loading_element_name: '#product-listing #loading',
            added_list_element: $('#product-listing'),
            max_page_callback: null
        }, options);
        
        function addPage(e) {
            if (options.current_page > options.max_page) return;
            
            options.added_list_element.append(options.loading);
            $.get(options.url+(parseInt(options.current_page)+1), function(contents) {
                $(options.loading_element_name).remove();
                options.added_list_element.append(contents);
                options.current_page++;
                if (options.current_page >= options.max_page) {
                    if (options.max_page_callback != null)
                        options.max_page_callback();
                }
            });
            return false;
        }
    
        var publicObj = {
            addPage: addPage
        }
    
        return publicObj;
    
    }
})(jQuery);
