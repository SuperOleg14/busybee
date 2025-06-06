<div class="first-section">
    <div class="container">
        <div class="first-section__content d-flex --just-space">
            <div class="first-section__content_info">
                <a href="#" class="first-section__content_info--trustpilot">
                    <?php echo file_get_contents(get_theme_file_path("./img/content/trustpilot-logo.svg")); ?>
                </a>
                <h1 class="first-section__content_info--title">
                    Busy Bee Clean
                </h1>
                <div class="first-section__content_info--subtitle">
                    Cleaning company you can <span>TRUST</span>.
                </div>
                <div class="first-section__content_info--text">
                    Skilled cleaning experts and professionals equipped with multifunctional cleaning equipment.
                </div>
                <div class="first-section__content_info--search">
                    <form method="" id="searchregion" class="searchregion" action="" >
                        <input type="text" placeholder="Enter your postcode" class="searchregioninput" id="searchregioninput" name="searchregioninput"/>
                        <input class="searchregionsubmit" type="submit" id="searchregionsubmit" value="Find your area" />
                        <span class="search-message"></span>
                    </form>
                </div>
                <ul class="first-section__content_info--description d-flex --just-space f-wrap">
                    <li>Commercial and Office cleaning in London</li>
                    <li>Trained and vetted staff</li>
                    <li>Environmental and sustainability policy</li>
                    <li>7 days-a-week availability</li>
                </ul>
            </div>
            <div class="first-section__content_photo">
<!--                <img src="--><?php //bloginfo('template_url'); ?><!--/img/content/first-section-photo.png">-->
            </div>
        </div>
    </div>
    <div class="first-section__warning">
        <div class="container">
            ️War in Ukraine: We're actively aiding our team, clients, and all affected by the <a href="<?php echo preg_replace('@^(https?://)?([^/?]+)([/?].*)?$@', 'https://${2}', get_site_url()); ?>/war-in-ukraine/">#WarInUkraine</a> war.
        </div>
    </div>
</div>
