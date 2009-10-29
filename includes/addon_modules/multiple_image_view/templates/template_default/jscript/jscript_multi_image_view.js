$(function() {
    $('#multi_image_view_expand a'  ).lightBox(multi_image_view_lightbox_prm);
    $('#multi_image_view_thmb   a'  ).lightBox(multi_image_view_lightbox_prm);

    $('#multi_image_view_thmb img').hover(
        function(){
            $('#multi_image_view_thmb div.selected_thmb').removeClass('selected_thmb');
            $('#multi_image_view_thmb img.selected_thmb').removeClass('selected_thmb');
            $(this).addClass('selected_thmb');
            $(this).parent().parent().addClass('selected_thmb');
            $('#multi_image_view_expand a'  ).attr('href' ,$(this).parent().attr('href' ));
            $('#multi_image_view_expand a'  ).attr('title',$(this).parent().attr('title'));
            $('#multi_image_view_expand img').attr('src'  ,multi_image_view_img_path_expd[$(this).attr('src')]);
            $('#multi_image_view_expand img').attr('title',$(this).attr('title'));
        }
    );
});
