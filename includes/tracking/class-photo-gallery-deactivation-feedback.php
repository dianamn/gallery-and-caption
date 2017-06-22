<?php

class Hugeit_Photo_Gallery_Deactivation_Feedback
{

    public function __construct()
    {
        if (Photo_Gallery_WP()->tracking->is_opted_in()) {
            add_action('current_screen', array($this, 'init'));
            add_action('wp_ajax_hugeit_photo_gallery_deactivation_feedback', array($this, 'send'));
        }
    }

    public function init()
    {
        $screen = get_current_screen();

        if ('plugins' === $screen->id) {
            add_action('admin_footer', array($this, 'render_footer'));
        }
    }

    public function render_footer()
    {
        $slug = Photo_Gallery_WP()->get_slug();
        echo Photo_Gallery_WP_Template_Loader::render(PHOTO_GALLERY_WP_TEMPLATES_PATH . '/admin/tracking/deactivation-feedback/show.php', compact('slug'));
    }

    public function send()
    {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'hugeit-photo-gallery-deactivation-feedback')) {
            die(0);
        }

        Photo_Gallery_WP()->tracking->track_data();

        if (!Photo_Gallery_WP()->tracking->is_opted_in()) {
            die(0);
        }

        $data = array(
            'project_id' => Photo_Gallery_WP()->get_project_id(),
            'project_version' => Photo_Gallery_WP()->get_version(),
            'deactivation_reason' => sanitize_text_field($_POST['value']),
            'comment' => sanitize_text_field($_POST['comment']),
            'site_url' => home_url(),
            'email' => get_option('admin_email'),
        );


        wp_remote_post('https://huge-it.com/track-user-data/deactivation-feedback.php', array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'blocking' => true,
            'headers' => array(),
            'body' => $data,
        ));

        echo 'ok';
        die;
    }

}