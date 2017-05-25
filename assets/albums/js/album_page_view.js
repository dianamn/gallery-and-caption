jQuery(document).ready(function () {

    var share_enable = jQuery("input[name='sharing_buttons']").val();
    var mosaic_enable = jQuery("input[name='mosaic']").val();

    var shareButtons = "";

    if (share_enable == 1) {
        shareButtons += '<ul class="rwd-share-buttons" style="display: block;">';
        shareButtons += '<li><a title="Facebook" class="album_social_fb" id="rwd-share-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' + (encodeURIComponent(document.URL)) + '"></a></li>';
        shareButtons += '<li><a title="Twitter" class="album_social_twitter" id="rwd-share-twitter" target="_blank" href="https://twitter.com/intent/tweet?text=&url=' + (encodeURIComponent(document.URL)) + '"></a></li>';
        shareButtons += '<li><a title="Google Plus" class="album_social_google" id="rwd-share-googleplus" target="_blank" href="https://twitter.com/intent/tweet?text=&url=' + (encodeURIComponent(document.URL)) + '"></a></li>';
        shareButtons += '</ul>';
    }
    else {
        jQuery(".rwd-socialIcons").hide();
    }

    jQuery(".album_socials").prepend(shareButtons);

    var get_galleries = jQuery(".get_galleries");
    var hover_class = get_galleries.attr("data-hover");

    get_galleries.on("click", function (e) {

        e.preventDefault();
        var data = {
            action: 'hg_gallery_get_album_images',
            nonce: gallery_img_album_page_view_obj.front_nonce,
            album_id: jQuery(this).attr("data-id"),
            type: "get_galleries"
        }
        jQuery("#album_disabled_layer").show();
        jQuery.ajax({
            url: gallery_img_album_page_view_obj.ajax_url,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (response) {
                jQuery("#album_disabled_layer").hide();
                jQuery("#album_list_container").hide();
                jQuery("#gallery_images").show();
                jQuery("#gallery_images").append("<div class='album_back_button'><a href='#' id='back_to_albums'>back to albums</a>" +
                    "<div class='album_socials'>" + shareButtons + "</div></div><div class='gallery_images'></div>");
                jQuery.each(response.images, function (key, val) {
                    if (val.name.length) {
                        if (val.sl_url.length) {
                            var a_title = (jQuery("input[name='show_title']").val() == "yes") ? "<h2  onclick=\"event.stopPropagation(); event.preventDefault(); window.open('" + val.sl_url + "', '" + val.target + "');\" >" + val.name + "</h2>" : "";
                        } else {
                            var a_title = (jQuery("input[name='show_title']").val() == "yes") ? "<h2>" + val.name + "</h2>" : "";
                        }
                    }
                    else {
                        var a_title = "";
                    }
                    var a_desc = (jQuery("input[name='show_desc']").val() == "yes") ? val.description : "";
                    jQuery(".gallery_images").append('' +
                        '<div class="view ' + hover_class + '">' +
                        '<a href="' + val.image_url + '" title="' + val.name + '" class="gallery_group2 gallery_responsive_lightbox">' +
                        '<div class="' + hover_class + '-wrapper view-wrapper">' +
                        val.thumbnail +
                        '<div class="mask">' +
                        '<div class="mask-text">' +
                        '<h2>' + a_title + '</h2>' +
                        '<span class="text-category">' + a_desc + '</span></div><div class="mask-bg"></div></div></div></a></div>');
                });

                jQuery('.gallery_responsive_lightbox').lightbox();
                jQuery(' .gallery_images > .view-fifth ').each(function () {
                    jQuery(this).hoverdir();
                });

                if (mosaic_enable == 1 || mosaic_enable == 2) {
                    setTimeout(function () {
                        jQuery(".gallery_images").mosaicflow();
                    }, 300);
                }
            },
            error: function (error) {
                console.log("error");
            }
        });

    });

    jQuery("#back_to_albums").live("click", function (event) {
        event.preventDefault();
        jQuery("#gallery_images").hide();
        jQuery("#gallery_images").empty();
        jQuery("#album_list_container").show();
    });

    jQuery("#back_to_galleries").live("click", function (event) {
        event.preventDefault();
        jQuery("#album_image_place").hide();
        jQuery("#album_image_place").empty();
        jQuery("#gallery_images").show();
    });
});















