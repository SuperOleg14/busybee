<?php

$serviceInformation = [
    [
        'icon' => '1',
        'title' => 'Trusted Team',
        'text' => 'All our cleaners have at least 6 months of hands-on expertise. They undergo rigorous DBS checks and stringent tests.',
    ],
    [
        'icon' => '2',
        'title' => 'Customer Experience',
        'text' => 'We guarantee 100% satisfaction. If you are not pleased with the results of our work, we offer a free return visit within 48 hours.',
    ],
    [
        'icon' => '3',
        'title' => 'You are protected',
        'text' => 'Get 100% coverage with our cleaning service – we’ll find a replacement for your regular cleaner if they’re unwell.',
    ],
    [
        'icon' => '4',
        'title' => 'Rest easy',
        'text' => 'All our cleaners have at least 6 months of hands-on expertise. They undergo rigorous DBS checks and stringent tests.',
    ],
    [
        'icon' => '5',
        'title' => 'High-quality service',
        'text' => 'All our cleaners have at least 6 months of hands-on expertise. They undergo rigorous DBS checks and stringent tests.',
    ],
    [
        'icon' => '6',
        'title' => 'Customer satisfaction',
        'text' => 'All our cleaners have at least 6 months of hands-on expertise. They undergo rigorous DBS checks and stringent tests.',
    ],
]
?>

<div class="service-information">
    <div class="container">
        <div class="block-title block-text-align">
            Busy Bee Clean
        </div>
        <div class="block-subtitle block-text-align">
            See why others are switching to our cleaning services
        </div>
        <div class="service-information__content d-flex --just-space --align-stretch f-wrap">
            <?php foreach ($serviceInformation as $item) : ?>
                <div class="service-information__content_item --basis-3">
                    <div class="service-information__content_item--icon block-btn-margin">
                        <?php echo file_get_contents(get_theme_file_path("./img/content/services-information/services-information-photo-$item[icon].svg")); ?>
                    </div>
                    <div class="service-information__content_item--title block-text-align">
                        <?= $item['title']; ?>
                    </div>
                    <div class="service-information__content_item--text block-text-align">
                        <?= $item['text']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
