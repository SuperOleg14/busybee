<?php
$aboutContent = [
    [
        'title' => '100+',
        'text' => 'Trusted clients in London'
    ],
    [
        'title' => '98%',
        'text' => 'Customer satisfaction rate'
    ],
    [
        'title' => '9 years',
        'text' => 'In the cleaning industry'
    ],
]
?>
<div class="about">
    <div class="container">
        <div class="about__content d-flex --just-space --align-stretch f-wrap">
            <?php foreach ($aboutContent as $item) : ?>
                <div class="about__content_item --basis-3">
                    <div class="about__content_item--title">
                        <?= $item['title']; ?>
                    </div>
                    <div class="about__content_item--text">
                        <?= $item['text']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
