<script type='text/javascript'>
$(function(){

	// --- Initialize sample trees
	$("#categorytree").dynatree({
    title: "<?php echo MODULE_ADDON_MODULES_TEXT_ALL_CATEGORIES; ?>",
    rootVisible: true,
    persist: false,
    activeVisible: false,
    clickFolderMode: 1,
    fx: { height: "toggle", duration: 200 },

    initAjax: {
      url: "<?php echo zen_href_link(FILENAME_ADDON) ?>",
      data: {module: "ajax_category_tree",
      key: "0",
      cPath: "<?php echo $_GET['cPath']; ?>"}
    },

    children:<?php print getAjaxCategoryTreeJson($top); ?>,

  	strings: {
  		loading: "Loading&#8230;",
  		loadError: ""
  	},

    onActivate: function(dtnode) {
      if(dtnode.data.key == "root") {
        value = "0";
      } else {
        value = dtnode.data.key;
      }
      if (dtnode.data.url) {
        location.replace("<?php echo zen_href_link(FILENAME_DEFAULT); ?>"+"&cPath="+dtnode.data.url);
      }
    },

    onLazyRead: function(dtnode){
      dtnode.appendAjax({
        url: "<?php echo zen_href_link(FILENAME_ADDON); ?>",
        data: {
          key: dtnode.data.key,
          module: "ajax_category_tree"
        }
      });
    }

  });

});
</script>
<div id="categorytree">
<?php
  // for seo
  echo getHtmlCategoryTree($top);
?>
</div>
