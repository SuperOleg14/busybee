<div class="map">
    <div class="container">
        <div class="map__content d-flex --just-space --align-center">
            <div class="map__content_info">
                <div class="block-title">
                    Always ready to serve you right where you are
                </div>
                <div class="block-subtitle">
                    We'll address your cleaning and maintenance issues promptly in major London areas areas:
                </div>
                <ul class="map__content_list d-flex f-wrap">
                    <li>
                        City of Westminster
                    </li>
                    <li>
                        Canary Wharf
                    </li>
                    <li>
                        Chelsea and Kensington
                    </li>
                    <li>
                        Tower Hamlets
                    </li>
                    <li>
                        Greenwich
                    </li>
                    <li>
                        Lambeth
                    </li>
                    <li>
                        Camden
                    </li>
                    <li>
                        Bromley
                    </li>
                </ul>
                <div class="map__content_photo visible-mob block-text-align">
                    <?php echo file_get_contents(get_theme_file_path("./img/content/map.svg")); ?>
                </div>
                <div class="first-section__content_info--search">
                    <form method="" id="searchregion" class="searchregion" action="" >
                        <input type="text" placeholder="Enter your postcode" class="searchregioninput" id="searchregioninput" />
                        <input class="searchregionsubmit" type="submit" id="searchregionsubmit" value="Find your area" />
                        <span class="search-message"></span>
                    </form>
                </div>
            </div>
            <div class="map__content_photo visible-desktop">
                <?php echo file_get_contents(get_theme_file_path("./img/content/map.svg")); ?>
            </div>
        </div>
    </div>
</div>
