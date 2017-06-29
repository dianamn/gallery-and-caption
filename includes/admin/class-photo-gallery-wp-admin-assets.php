<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//todo: correct urls
class Photo_Gallery_WP_Admin_Assets
{

    /**
     * Photo_Gallery_WP_Admin_Assets constructor.
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    }

    /**
     * @param $hook hook of current page
     */
    public function admin_styles($hook)
    {
        wp_enqueue_style("font-awesome", 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', true);
        if (in_array($hook, Photo_Gallery_WP()->admin->pages)) {
            wp_enqueue_style("gallery_admin_css", Photo_Gallery_WP()->plugin_url() . "/assets/style/admin.style.css", false);
            wp_enqueue_style("jquery_ui", esc_url("https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"), false);
            wp_enqueue_style("simple_slider_css", Photo_Gallery_WP()->plugin_url() . "/assets/style/simple-slider_sl.css", false);
            wp_enqueue_style("featured_plugins", Photo_Gallery_WP()->plugin_url() . "/assets/style/featured-plugins.css", false);
            wp_enqueue_style("free-banner", Photo_Gallery_WP()->plugin_url() . "/assets/style/free-banner.css", false);
            wp_enqueue_style('hugeit_photo_gallery_tracking', Photo_Gallery_WP()->plugin_url() . '/assets/style/admin.tracking.css');

        }
        $edit_pages = array('post.php', 'post-new.php');
        if (in_array($hook, $edit_pages)) {
            wp_enqueue_style('shortcode-components', Photo_Gallery_WP()->plugin_url() . "/assets/style/shortcode-components.css");
        }

        if ($hook === Photo_Gallery_WP()->admin->pages['licensing']) {
            wp_enqueue_style('photo-gallery-licensing', Photo_Gallery_WP()->plugin_url() . "/assets/style/licensing.css", false);
        }

        if ('plugins.php' === $hook) {
            $this->enqueue_tracking();
        }


    }

    public function admin_scripts($hook)
    {

        if (in_array($hook, Photo_Gallery_WP()->admin->pages)) {
            wp_enqueue_media();
            wp_enqueue_script("gallery_admin_js", Photo_Gallery_WP()->plugin_url() . "/assets/js/admin.js", false);
            wp_enqueue_script("jquery_ui_new", esc_url("https://code.jquery.com/ui/1.10.4/jquery-ui.js"), false);
            wp_enqueue_script("simple_slider_js", Photo_Gallery_WP()->plugin_url() . '/assets/js/simple-slider.js', false);
            wp_enqueue_script('param_block2', Photo_Gallery_WP()->plugin_url() . "/assets/js/jscolor.js");
        }
        $edit_pages = array('post.php', 'post-new.php');
        if (in_array($hook, $edit_pages)) {
            wp_enqueue_script('shortcode-components', Photo_Gallery_WP()->plugin_url() . "/assets/js/shortcode-components.js", array('jquery'));
        }
    }

    private function enqueue_tracking()
    {
        wp_enqueue_style('hugeit_photo_gallery_tracking', Photo_Gallery_WP()->plugin_url() . '/assets/style/admin.tracking.css');
        if (!Photo_Gallery_WP()->tracking->is_opted_in()) {
            return false;
        }
        wp_enqueue_script('hugeit_modal_photo_gallery', Photo_Gallery_WP()->plugin_url() . '/assets/js/hugeit-modal.js', array('jquery'));
        wp_enqueue_script('hugeit_photo_gallery_deactivation_feedback', Photo_Gallery_WP()->plugin_url() . '/assets/js/deactivation-feedback.js', array('jquery', 'hugeit_modal_photo_gallery'));
        wp_localize_script('hugeit_photo_gallery_deactivation_feedback', 'hugeitPhotogalleryL10n', array(
            'slug' => Photo_Gallery_WP()->get_slug()
        ));
        wp_enqueue_style('hugeit_modal_photo_gallery', Photo_Gallery_WP()->plugin_url() . '/assets/style/hugeit-modal.css');
    }

    public function localize_scripts()
    {

    }
}

new Photo_Gallery_WP_Admin_Assets();