<div class="album-container wpdev-settings-disabled-container">
    <img src="<?php echo PHOTO_GALLERY_WP_IMAGES_URL . "/admin_images/album_options.png" ?>"
         alt="album optins"/>
    <div class="album-overlay">
        <p>This section is disabled for current version of plugin</p>
        <a class="album_purchase_link" href="https://goo.gl/LwtCFf">Get Full Version</a>
    </div>
</div>

<style>

    .album-container {
        width: 99%;
        position: relative;
        margin-top: 15px;
    }

    .album-container img {
        max-width: 100%;
    }

    .album-overlay {
        background: rgba(255, 255, 255, 0.5);
        position: absolute;
        top: 0;
        left: 0;
        width: 98%;
        padding: 15px;
        height: 100%;
        text-align: center;
        padding-top: 12%;
    }

    .album-overlay p {
        font-size: 18px;
        color: #1b1a1a;
        font-family: 'Open Sans', sans-serif;
    }

    .album_purchase_link {
        color: #fff;
        background-color: #b21919;
        margin: 30px 0;
        padding: 11px 59px;
        border-radius: 3px;
        font-size: 18px;
        font-family: 'Open Sans', sans-serif;
        font-weight: 600;
        height: 50px;
        line-height: 50px;
        text-decoration: none;
        transition: text-shadow 0.15s ease-in-out;
    }

    .album_purchase_link:hover {
        color: #fff;
        cursor: pointer;
    }
</style>