<script language="javascript" type="text/javascript">
<?php echo JQUERY_ALIAS; ?>(function() {
    <?php echo JQUERY_ALIAS; ?>('#multi_image_view_expand a'  ).lightBox(multi_image_view_lightbox_prm);
    <?php echo JQUERY_ALIAS; ?>('#multi_image_view_thmb   a'  ).lightBox(multi_image_view_lightbox_prm);

    <?php echo JQUERY_ALIAS; ?>('#multi_image_view_thmb img').hover(
        function(){
            <?php echo JQUERY_ALIAS; ?>('#multi_image_view_thmb div.selected_thmb').removeClass('selected_thmb');
            <?php echo JQUERY_ALIAS; ?>('#multi_image_view_thmb img.selected_thmb').removeClass('selected_thmb');
            <?php echo JQUERY_ALIAS; ?>(this).addClass('selected_thmb');
            <?php echo JQUERY_ALIAS; ?>(this).parent().parent().addClass('selected_thmb');
            <?php echo JQUERY_ALIAS; ?>('#multi_image_view_expand a'  ).attr('href' ,$(this).parent().attr('href' ));
            <?php echo JQUERY_ALIAS; ?>('#multi_image_view_expand a'  ).attr('title',$(this).parent().attr('title'));
            <?php echo JQUERY_ALIAS; ?>('#multi_image_view_expand img').attr('src'  ,multi_image_view_img_path_expd[$(this).attr('src')]);
            <?php echo JQUERY_ALIAS; ?>('#multi_image_view_expand img').attr('title',$(this).attr('title'));
        }
    );
});
//--></script>