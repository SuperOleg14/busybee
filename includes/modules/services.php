<?php

$servicesBlock = [
    [
        'photo' => '1',
        'title' => 'Commercial cleaning',
        'subtitle' => 'Revitalize your space with Busy Bee London\'s Expert Commercial Cleaning Services',
        'list' => [
            'School cleaning ',
            'Restaurant cleaning',
            'Office cleaning',
            'Showroom cleaning',
            'Pub cleaning',
            'Retail cleaning',
        ],
        'linkTitle' => 'All commercial services',
        'link' => '/services-category/commercial-cleaning/',

    ],
    [
        'photo' => '2',
        'title' => 'Domestic cleaning',
        'subtitle' => 'Transforming homes with impeccable domestic cleaning services in London.',
        'list' => [
            'Deep cleaning',
            'Oven cleaning',
            'End of tenancy cleaning',
            'Pressure washing',
            'Oven cleaning',
            'Pressure washing',
        ],
        'linkTitle' => 'All domestic services',
        'link' => '/services-category/domestic-cleaning/',

    ]
]

?>
<div class="services">
    <div class="container">
        <div class="services__content d-flex --just-space --align-stretch">
            <?php foreach ($servicesBlock as $key => $item) : ?>
                <div class="services__content_item d-flex --dir-col --just-space --align-stretch">
                   <div>
                       <div class="services__content_item--info">
                           <div class="services__content_item--photo">
                               <img src="<?php bloginfo('template_url'); ?>/img/content/services-photo-<?= $item['photo']; ?>.png">
                           </div>
                           <div>
                               <div class="services__content_item--title">
                                   <?= $item['title']; ?>
                               </div>
                               <div class="services__content_item--subtitle">
                                   <?= $item['subtitle']; ?>
                               </div>
                           </div>
                       </div>
                       <ul class="services__content_item--list d-flex f-wrap --just-space">
                           <?php foreach ($item['list'] as $listItem) : ?>
                               <li class="--basis-2">
                                   <?= $listItem; ?>
                               </li>
                           <?php endforeach; ?>
                       </ul>
                   </div>
                    <a class="block-btn" href="<?php echo preg_replace('@^(https?://)?([^/?]+)([/?].*)?$@', 'https://${2}', get_site_url()), $item['link']; ?>"><?= $item['linkTitle']; ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
