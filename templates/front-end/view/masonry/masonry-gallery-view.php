<?php

switch ($gallery[0]->hover_effect) {
    case 0:
        $hover_class = "view-first";
        break;
    case 1:
        $hover_class = "view-second";
        break;
    case 2:
        $hover_class = "view-third";
        break;
    case 3:
        $hover_class = "view-forth";
        break;
    case 4:
        $hover_class = "view-fifth";
        break;
    default:
        $hover_class = "view-first";
        break;
}
?>

<input type="hidden" name="view_style" value="<?php echo $hover_class; ?>">

<div id="ph-g-wp-masonry_<?php echo $galleryID; ?>"
     class="ph-g-wp_gallery_container view-<?php echo esc_html($view_slug); ?> gallery-img-content"
     data-pages-count="<?php echo absint($total); ?>"
     data-content-per-page="<?php echo absint($num); ?>"
     data-current-page="2"
     data-show-center="<?php echo esc_html(Photo_Gallery_WP()->settings->masonry_show_content_in_the_center); ?>"
     data-element-width="<?php echo esc_html(Photo_Gallery_WP()->settings->masonry_image_width_in_px); ?>"
     data-rating-type="<?php echo esc_html($like_dislike); ?>"
     data-ph-gallery-id="<?php echo absint($galleryID); ?>">
    <div class="ph-gallery-wp-loading-icon"></div>
    <div class="grid ph-gallery-wp-loading-class" style="visibility: hidden">
        <?php
        global $wpdb;
        foreach ($page_images as $key => $row) {
            $row->id = absint($row->id);
            $row->like = absint($row->like);
            $row->dislike = absint($row->dislike);
            $imagerowstype = $row->sl_type;
            if ($row->sl_type == '') {
                $imagerowstype = 'image';
            }
            ?>
            <div class="grid-item view  <?php echo $hover_class; ?>">
                <div class="<?php echo $hover_class; ?>-wrapper view-wrapper">
                    <?php
                    switch ($imagerowstype) {
                    case 'image': ?>
                    <a href="<?php echo esc_url($row->image_url); ?>" class="ph-lightbox">
                        <img src="<?php echo esc_url($row->image_url); ?>"
                             alt="<?php echo sanitize_text_field($row->name); ?>">
                        <?php
                        break;
                        case 'video':
                        $videourl = photo_gallery_wp_get_video_id_from_url($row->image_url);
                        if ($videourl[1] == 'youtube') {
                        ?>
                        <a href="<?php echo esc_url($row->image_url); ?>" class="ph-lightbox">
                            <img src="https://img.youtube.com/vi/<?php echo esc_html($videourl[0]); ?>/mqdefault.jpg"
                                 alt="<?php echo esc_html(str_replace('__5_5_5__', '%', $row->name)); ?>">
                            <div class="play-icon <?php echo esc_html($videourl[1]); ?>-icon"></div>

                            <?php
                            } else {
                            $hash = unserialize(wp_remote_fopen("https://vimeo.com/api/v2/video/" . $videourl[0] . ".php"));
                            $imgsrc = $hash[0]['thumbnail_large'];
                            ?>
                            <a href="<?php echo esc_url($row->image_url); ?>" class="ph-lightbox">
                                <img src="<?php echo esc_attr($imgsrc); ?>"
                                     alt="<?php echo esc_attr(str_replace('__5_5_5__', '%', $row->name)); ?>">
                                <div class="play-icon <?php echo esc_attr($videourl[1]); ?>-icon"></div>

                                <?php
                                }
                                break;
                                }
                                $target = ($row->link_target == "on") ? '_blank' : '_self';
                                ?>
                                <div class="mask">
                                    <div class="mask-text">
                                        <?php if ($row->name != "") { ?>
                                            <h2 <?php if ($row->sl_url != ""){ ?>onclick="event.stopPropagation(); event.preventDefault();window.open('<?php echo $row->sl_url; ?>', '<?php echo $target; ?>')" <?php } ?>><?php echo $row->name; ?></h2>
                                        <?php } ?>
                                        <span class="text-category"><?php echo $row->description; ?></span>
                                    </div>

                                    <div class="mask-bg"></div>
                                </div>
                            </a>

                </div>
                <?php if ($like_dislike != 'off'): ?>
                    <div
                            class="ph-g-wp_gallery_like_cont ph-g-wp_gallery_like_cont_<?php echo esc_attr($galleryID . $pID); ?>"
                            style="position: absolute; top:0; right: 0;">
                        <div class="ph-g-wp_gallery_like_wrapper">
						<span class="huge_it_like">
							<?php if ($like_dislike == 'heart'): ?>
                                <i class="hugeiticons-heart likeheart"></i>
                            <?php endif; ?>
                            <?php if ($like_dislike == 'dislike'): ?>
                                <i class="hugeiticons hugeiticons-thumbs-up like_thumb_up"></i>
                            <?php endif; ?>
                            <span class="huge_it_like_thumb" id="<?php echo $row->id ?>"
                                  data-status="<?php if (isset($res3->image_status) && $res3->image_status == 'liked') {
                                      echo esc_attr($res3->image_status);
                                  } elseif (isset($res4->image_status) && $res4->image_status == 'liked') {
                                      echo esc_attr($res4->image_status);
                                  } else {
                                      echo 'unliked';
                                  } ?>">
							<?php if ($like_dislike == 'heart'): ?>
                                <?php echo $row->like; ?>
                            <?php endif; ?>
						</span>
							<span
                                    class="ph-g-wp_like_count <?php if (Photo_Gallery_WP()->settings->popup_rating_count == 'off') {
                                        echo 'huge_it_hide';
                                    } ?>"
                                    id="<?php echo $row->id ?>"><?php if ($like_dislike != 'heart'): ?><?php echo $row->like; ?><?php endif; ?></span>
						</span>
                        </div>
                        <?php if ($like_dislike != 'heart'): ?>
                            <div class="huge_it_gallery_dislike_wrapper">
						<span class="huge_it_dislike">
							<i class="hugeiticons-thumbs-down dislike_thumb_down"></i>
							<span class="huge_it_dislike_thumb" id="<?php echo $row->id ?>"
                                  data-status="<?php if (isset($res3->image_status) && $res3->image_status == 'disliked') {
                                      echo $res3->image_status;
                                  } elseif (isset($res5->image_status) && $res5->image_status == 'disliked') {
                                      echo $res5->image_status;
                                  } else {
                                      echo 'unliked';
                                  } ?>">
							</span>
							<span
                                    class="huge_it_dislike_count <?php if (Photo_Gallery_WP()->settings->popup_rating_count == 'off') {
                                        echo 'huge_it_hide';
                                    } ?>"
                                    id="<?php echo $row->id ?>"><?php echo $row->dislike; ?></span>
						</span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
        }
        ?>
    </div>

    <div style="clear:both;"></div>
    <?php
    $a = $disp_type;
    if ($a == 1) {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
        $actual_link = esc_url($protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        $pattern = "/\?p=/";
        $pattern2 = "/&page-img[0-9]+=[0-9]+/";
        $pattern3 = "/\?page-img[0-9]+=[0-9]+/";
        $gallery_img_lightbox_load_nonce = wp_create_nonce('gallery_img_lightbox_load_nonce');
        if (preg_match($pattern, $actual_link)) {
            if (preg_match($pattern2, $actual_link)) {
                $actual_link = preg_replace($pattern2, '', $actual_link);
                header("Location:" . $actual_link);
                exit;
            }
        } elseif (preg_match($pattern3, $actual_link)) {
            $actual_link = preg_replace($pattern3, '', $actual_link);
            header("Location:" . $actual_link . "");
            exit;
        }
        ?>
        <div class="load_more8">
            <div class="load_more_button8"
                 data-lightbox-nonce-value="<?php echo esc_attr($gallery_img_lightbox_load_nonce); ?>"><?php echo wp_kses_post(Photo_Gallery_WP()->settings->masonry_load_more_text); ?></div>
            <div class="loading8"><img
                        src="<?php if (Photo_Gallery_WP()->settings->masonry_load_more_loading_animation == '1') {
                            echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading1.gif';
                        } elseif (Photo_Gallery_WP()->settings->masonry_load_more_loading_animation == '2') {
                            echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading4.gif';
                        } elseif (Photo_Gallery_WP()->settings->masonry_load_more_loading_animation == '3') {
                            echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading36.gif';
                        } elseif (Photo_Gallery_WP()->settings->masonry_load_more_loading_animation == '4') {
                            echo PHOTO_GALLERY_WP_IMAGES_URL . '/front_images/arrows/loading51.gif';
                        } ?>"></div>
        </div>
        <?php
    } elseif ($a == 0) {
        ?>
        <div class="pagination_align">
            <div class="paginate8">
                <?php
                $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
                $actual_link = esc_url($protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "");
                $checkREQ = '';
                $pattern = "/\?p=/";
                $pattern2 = "/&page-img[0-9]+=[0-9]+/";
                $pattern_2 = "/\?page_id=/";
                if (preg_match($pattern, $actual_link) || preg_match($pattern_2, $actual_link)) {
                    if (preg_match($pattern2, $actual_link)) {
                        $actual_link = preg_replace($pattern2, '', $actual_link);
                    }
                    $checkREQ = $actual_link . '&page-img' . $galleryID . $pID;
                } else {
                    $checkREQ = '?page-img' . $galleryID . $pID;
                }
                $pervpage = '';
                if ($page != 1) {
                    $pervpage = '<a href= ' . $checkREQ . '=1><i class="icon-style8 hugeiticons-fast-backward" ></i></a>  
            <a href= ' . $checkREQ . '=' . ($page - 1) . '><i class="icon-style8 hugeiticons-chevron-left"></i></a> ';
                }
                $nextpage = '';
                if ($page != $total) {
                    $nextpage = ' <a href= ' . $checkREQ . '=' . ($page + 1) . '><i class="icon-style8 hugeiticons-chevron-right"></i></a>  
            <a href= ' . $checkREQ . '=' . $total . '><i class="icon-style8 hugeiticons-fast-forward" ></i></a>';
                }
                echo $pervpage . $page . '/' . $total . $nextpage;
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<?php if ($hover_class == "view-fifth") { ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.view-fifth ').each(function () {
                jQuery(this).hoverdir();
            });
        });
    </script>
<?php } ?>

