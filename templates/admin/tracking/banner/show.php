<?php
/**
 * @var $optin_url string
 * @var $optout_url string
 */
?>
<div class="hugeit-tracking-optin-photo-gallery">
    <div class="hugeit-tracking-optin-photo-gallery-left">
        <div class="hugeit-tracking-optin-photo-gallery-icon"><img
                    src="<?php echo PHOTO_GALLERY_WP_IMAGES_URL . '/admin_images/tracking/plugin-icon.png'; ?>"
                    alt="<?php echo Photo_Gallery_WP()->get_slug() ?>"/></div>
        <div class="hugeit-tracking-optin-photo-gallery-info">
            <div class="hugeit-tracking-optin-photo-gallery-header"><?php _e('Let us know how you wish to better this plugin! ', 'hugeit-photo-gallery'); ?></div>
            <div class="hugeit-tracking-optin-photo-gallery-description"><?php _e('Allow us to email you and ask how you like our plugin and what issues we may fix or add in the future. We collect <a href="http://huge-it.com/privacy-policy/#collected_data_from_plugins" target="_blank">basic data</a>, in order to help the community to improve the quality of the plugin for you. Data will never be shared with any third party.', 'hugeit-photo-gallery'); ?></div>
            <div>
                <a href="<?php echo $optin_url; ?>"
                   class="hugeit-tracking-optin-photo-gallery-button"><?php _e('Yes, sure', 'hugeit-photo-gallery'); ?></a><a
                        href="<?php echo $optout_url; ?>"
                        class="hugeit-tracking-optout-button"><?php _e('No, thanks', 'hugeit-photo-gallery'); ?></a>
            </div>
        </div>
    </div>
    <div class="hugeit-tracking-optin-photo-gallery-right">
        <div class="hugeit-tracking-optin-photo-gallery-logo">
            <img src="<?php echo PHOTO_GALLERY_WP_IMAGES_URL . '/admin_images/tracking/logo.png'; ?>" alt="Huge-IT"/>
        </div>
        <div class="hugeit-tracking-optin-photo-gallery-links">
            <a href="http://huge-it.com/privacy-policy/#collected_data_from_plugins"
               target="_blank"><?php _e('What data We Collect', 'hugeit-photo-gallery'); ?></a>
            <a href="https://huge-it.com/privacy-policy"
               target="_blank"><?php _e('Privacy Policy', 'hugeit-photo-gallery'); ?></a>
        </div>
    </div>
</div>