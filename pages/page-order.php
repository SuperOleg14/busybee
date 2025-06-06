<?php /* Template Name: Page Order */?>

<?php get_header(); ?>

<div class="main-wrapper order-wrapper">
    <div class="container">
        <h1 class="block-service-title">
            Customise your clean
        </h1>
        <form
                action="<?php echo admin_url('admin-ajax.php?action=receive_order')?>"
                method="post"
                class="main-form d-flex --just-space"
                id="main-form"
        >
            <div class="main-form__left">
                <div class="main-form__left_item postcode">
                    <div class="form-control">
                        <input name="postcode" type="text" value="" placeholder="Enter your postcode" required>
                        <div class="error-message"></div>
                    </div>
                </div>
                <div class="main-form__left_item type_cleaning">
                    <div class="main-form__left-title" >
                        Type of cleaning
                    </div>
                    <div class="form-radios d-flex --align-stretch f-wrap">
                        <label class="checked">
                            <input type="radio" name="type_cleaning" class="all_cleaning often_work_cleaning" value=" End of tenancy" data-type_cleaning="1" checked="">
                            End of tenancy cleaning
                        </label>
                        <label class="">
                            <input type="radio" name="type_cleaning" class="deep_cleaning" data-type_cleaning="2" value="Deep">
                            Deep cleaning
                        </label>
                        <label class="">
                            <input type="radio" name="type_cleaning" class="all_cleaning often_work_cleaning" data-type_cleaning="3" value="After construction">
                            After construction cleaning
                        </label>
                        <label class="">
                            <input type="radio" name="type_cleaning" class="carpet_cleaning" data-type_cleaning="4" value="Carpet">
                            Carpet cleaning
                        </label>
                        <label class="">
                            <input type="radio" name="type_cleaning" class="domestic_cleaning" data-type_cleaning="5" value="Domestic">
                            Domestic cleaning
                        </label>
                        <label class="">
                            <input type="radio" name="type_cleaning" class="commercial_cleaning" data-type_cleaning="6" value="Commercial">
                            Commercial cleaning
                        </label>
                    </div>
                    <div class="main-form__left-subtitle" >
                        To book this cleaning service, please provide us with the square footage in square meters or call us for a <strong>FREE</strong> estimate.
                    </div>
                    <div class="form-control">
                        <label class="control-label" for="square_footage">
                            Enter your square footage in m2
                        </label>
                        <input name="square_footage" type="number" min="0" value="">
                    </div>
                </div>
                <div class="main-form__left_item space-option">
                    <div class="main-form__left-title">
                        Select your option
                    </div>
                    <!--                    <div class="form-checkbox d-flex">-->
                    <!--                        <div class="form-checkbox-item d-flex --align-center --basis-2">-->
                    <!--                            <input type="checkbox" class="extras_label" id="space_furnished" name="space_furnished" value="">-->
                    <!--                            <label for="space_furnished" class="extras_label">My space is furnished</label>-->
                    <!--                        </div>-->
                    <!--                        <div class="form-checkbox-item d-flex --align-center --basis-2">-->
                    <!--                            <input type="checkbox" class="extras_label" id="space_unfurnished" name="space_unfurnished" value="">-->
                    <!--                            <label for="space_unfurnished" class="extras_label">My space is unfurnished</label>-->
                    <!--                        </div>-->
                    <!--                    </div>-->

                    <div class="form-radios form-radios-furnished d-flex --just-space --align-stretch">
                        <label class="checked --basis-2">
                            <input type="radio" name="space_furnished" data-furinshed="1" value="" checked="">
                            My space is furnished
                        </label>
                        <label class="--basis-2">
                            <input type="radio" name="space_furnished" data-furinshed="0" value="">
                            My space is unfurnished
                        </label>
                    </div>
                    <div class="form-number d-flex --just-space --align-stretch">
                        <div class="form-number-item --basis-2">
                            <div class="control-label">
                                How many bedrooms
                            </div>
                            <div class="quantity-block d-flex --align-center">
                                <div class="quantity-arrow quantity-arrow-minus"></div>
                                <input class="quantity-num" type="number" name="bedrooms" value="0" />
                                <div class="quantity-arrow quantity-arrow-plus"></div>
                            </div>
                        </div>
                        <div class="form-number-item form-number-item-bathrooms --basis-2">
                            <div class="control-label">
                                How many bathrooms
                            </div>
                            <div class="quantity-block d-flex --align-center">
                                <div class="quantity-arrow quantity-arrow-minus"></div>
                                <input class="quantity-num" type="number" name="bathrooms" value="1" />
                                <div class="quantity-arrow quantity-arrow-plus"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-form__left-subtitle">
                        Choose 0 bedrooms and 1 bathrooms if you have a studio flat.
                    </div>
                </div>
                <div class="main-form__left_item extras">
                    <div class="main-form__left-title">
                        Extras
                    </div>
                    <div class="form-checkbox">
                        <div class="form-checkbox-item d-flex --just-space --align-center all_cleaning deep_cleaning" data-form_cleaning="1">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_carpet" name="extras_carpet" value="">
                                <label for="extras_carpet" class="extras_label">Carpet / per room</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_carpet" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_carpet_price'), 2); ?>"
                                      data-extras="extras_carpet">+£<?php echo number_format(get_option('extras_carpet_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center all_cleaning deep_cleaning" data-form_cleaning="2">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_sofa" name="extras_sofa" value="">
                                <label for="extras_sofa" class="extras_label">Sofa cleaning</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_sofa" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_sofa_price'), 2); ?>"
                                      data-extras="extras_sofa">+£<?php echo number_format(get_option('extras_sofa_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center all_cleaning domestic_cleaning deep_cleaning" data-form_cleaning="3">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_balcony" name="extras_balcony" value="">
                                <label for="extras_balcony" class="extras_label">Balcony (outside)</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_balcony" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_balcony_price'), 2); ?>"
                                      data-extras="extras_balcony">+£<?php echo number_format(get_option('extras_balcony_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center all_cleaning deep_cleaning" data-form_cleaning="4">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_curtains" name="extras_curtains" value="">
                                <label for="extras_curtains" class="extras_label">Сurtains cleaning /per item</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_curtains" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_curtains_price'), 2); ?>"
                                      data-extras="extras_curtains">+£<?php echo number_format(get_option('extras_curtains_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center all_cleaning deep_cleaning" data-form_cleaning="5">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_chair" name="extras_chair" value="">
                                <label for="extras_chair" class="extras_label">Chair cleaning</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_chair" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_chair_price'), 2); ?>"
                                      data-extras="extras_chair">+£<?php echo number_format(get_option('extras_chair_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center deep_cleaning" style="display: none" data-form_cleaning="6">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_inside" name="extras_inside" value="">
                                <label for="extras_inside" class="extras_label">Inside cupboard cleaning</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_inside" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_inside_price'), 2); ?>"
                                      data-extras="extras_inside">+£<?php echo number_format(get_option('extras_inside_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center all_cleaning deep_cleaning" data-form_cleaning="7">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_armchair" name="extras_armchair" value="">
                                <label for="extras_armchair" class="extras_label">Armchair cleaning</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_armchair" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_armchair_price'), 2); ?>"
                                      data-extras="extras_armchair">+£<?php echo number_format(get_option('extras_armchair_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center carpet_cleaning" style="display: none" data-form_cleaning="8">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_ldl" name="extras_ldl" value="">
                                <label for="extras_ldl" class="extras_label">Living / Dining / Lounge</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_ldl" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_ldl_price'), 2); ?>"
                                      data-extras="extras_ldl">+£<?php echo number_format(get_option('extras_ldl_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center carpet_cleaning" style="display: none" data-form_cleaning="9">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_hallway" name="extras_hallway" value="">
                                <label for="extras_hallway" class="extras_label">Hallway</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_hallway" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_hallway_price'), 2); ?>"
                                      data-extras="extras_hallway">+£<?php echo number_format(get_option('extras_hallway_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center carpet_cleaning" style="display: none" data-form_cleaning="10">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_landing" name="extras_landing" value="">
                                <label for="extras_landing" class="extras_label">Landing</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_landing" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_landing_price'), 2); ?>"
                                      data-extras="extras_landing">+£<?php echo number_format(get_option('extras_landing_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center carpet_cleaning" style="display: none" data-form_cleaning="11">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_steps" name="extras_steps" value="">
                                <label for="extras_steps" class="extras_label">Steps from £2 ( per step )</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_steps" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_steps_price'), 2); ?>"
                                      data-extras="extras_steps">+£<?php echo number_format(get_option('extras_steps_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center domestic_cleaning" style="display: none" data-form_cleaning="12">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_inside_fridge" name="extras_inside_fridge" value="">
                                <label for="extras_inside_fridge" class="extras_label">Inside fridge cleaning</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_inside_fridge" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_inside_fridge_price'), 2); ?>"
                                      data-extras="extras_inside">+£<?php echo number_format(get_option('extras_inside_fridge_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center domestic_cleaning" style="display: none" data-form_cleaning="13">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_oven" name="extras_oven" value="">
                                <label for="extras_oven" class="extras_label">Oven cleaning</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_oven" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_oven_price'), 2); ?>"
                                      data-extras="extras_oven">+£<?php echo number_format(get_option('extras_oven_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center domestic_cleaning" style="display: none" data-form_cleaning="14">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_windows" name="extras_windows" value="">
                                <label for="extras_windows" class="extras_label">Inside windows cleaning</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_windows" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_windows_price'), 2); ?>"
                                      data-extras="extras_windows">+£<?php echo number_format(get_option('extras_windows_price'), 2); ?></span>
                            </div>
                        </div>
                        <div class="form-checkbox-item d-flex --just-space --align-center domestic_cleaning" style="display: none" data-form_cleaning="15">
                            <div class="d-flex --align-center">
                                <input type="checkbox" class="extras_label" id="extras_ironing" name="extras_ironing" value="">
                                <label for="extras_ironing" class="extras_label">Ironing</label>
                            </div>
                            <div class="d-flex --align-center">
                                <div class="form-number">
                                    <div class="quantity-block d-flex --align-center">
                                        <div class="quantity-arrow quantity-arrow-minus"></div>
                                        <input class="quantity-num" type="number" value="1" data-extras="extras_ironing" />
                                        <div class="quantity-arrow quantity-arrow-plus"></div>
                                    </div>
                                </div>
                                <span data-price="<?php echo number_format(get_option('extras_ironing_price'), 2); ?>"
                                      data-extras="extras_ironing">+£<?php echo number_format(get_option('extras_ironing_price'), 2); ?>/h</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-form__left_item cleaning_products" style="display: none">
                    <div class="main-form__left-title" >
                        Cleaning products
                    </div>
                    <div class="main-form__left-subtitle" >
                        Please choose if you would like us to provide any cleaning chemicals and cloth.
                        We would expect you to provide hoover and mop.
                    </div>
                    <div class="form-radios d-flex --just-space --align-stretch">
                        <label class="checked">
                            <input type="radio" name="cleaning_products" data-cleaning_products="1" value="" checked="">
                            Include cleaning products (+£15.00)
                        </label>
                        <label class="">
                            <input type="radio" name="cleaning_products" data-cleaning_products="0" value="">
                            I will provide mine
                        </label>
                    </div>
                </div>
                <div class="main-form__left_item often_work" style="display:none;">
                    <div class="main-form__left-title" >
                        How often?
                    </div>
                    <div class="main-form__left-subtitle" >
                        You can keep the same cleaner for the next cleans. Your plan can be changed or cancel anytime.
                    </div>
                    <div class="form-radios d-flex --just-space --align-stretch f-wrap">
                        <label class="checked --basis-2">
                            <input type="radio" name="often_work" value="Weekly" checked="">
                            Weekly
                        </label>
                        <label class="--basis-2">
                            <input type="radio" name="often_work" value="Fortnightly">
                            Fortnightly
                        </label>
                        <label class="--basis-2">
                            <input type="radio" name="often_work" value="Monthly">
                            Monthly
                        </label>
                        <label class="--basis-2">
                            <input type="radio" name="often_work" value="One off">
                            One off
                        </label>
                    </div>
                </div>
                <div class="main-form__left_item">
                    <div class="main-form__left-title">
                        Select Date
                    </div>
                    <div class="main-form__left_contacts">
                        <div class="form-control">
                            <input name="date" type="text" id="datepick_selector" class="datepick_selector"/>
                        </div>
                    </div>
                </div>
                <div class="main-form__left_item">
                    <div class="main-form__left-title">
                        Your contacts
                    </div>
                    <div class="main-form__left_contacts">
                        <div class="form-control">
                            <label class="control-label" for="name">
                                Full name *
                            </label>
                            <input name="name" type="text" value="" pattern="[A-Za-zА-Яа-яЁё\s]+" required>
                        </div>
                        <div class="form-control">
                            <label class="control-label" for="phone">
                                Phone number *
                            </label>
                            <input name="phone" type="tel" value="" pattern="\+?[0-9]{4,11}" required>
                        </div>
                        <div class="form-control">
                            <label class="control-label" for="email">
                                Email *
                            </label>
                            <input name="email" type="email" value="" required>
                        </div>
                        <div class="form-control">
                            <label class="control-label" for="adress">
                                Full Address *
                            </label>
                            <input id="adress" name="adress" type="text" value="" required>
                        </div>
                    </div>
                </div>
                <div class="main-form__left_item payment-method" style="display: none">
                    <div class="main-form__left-title" >
                        Payment method
                    </div>
                    <div class="form-radios d-flex --just-space --align-stretch">
                        <label class="checked --basis-3">
                            <input type="radio" name="payment_method" value="">
                            Online
                        </label>
                        <label class="--basis-3">
                            <input type="radio" name="payment_method" value="" checked="">
                            Stripe
                        </label>
                        <label class="--basis-3">
                            <input type="radio" name="payment_method" value="">
                            PayPal
                        </label>
                    </div>
                </div>
                <div class="main-form__left_warning">
                    <p>
                        <span>Please note:</span> we do not wash the following items: chandeliers, blinds,
                        wall sconces, walls, and the entire ceiling (unless there is a specific request).
                    </p>
                    <p>
                        <span>Please note:</span> we do not handle the moving of large items such as sofas,
                        cabinets, refrigerators, etc.
                    </p>
                    <p>
                        <span>Price:</span> applies to standard-sized properties. The service duration and
                        cost may vary based on property conditions. Additional charges may apply for poor
                        conditions. Transportation fees apply to properties outside Greater London, and
                        the customer is responsible for the congestion charge.
                    </p>
                </div>
            </div>
            <div class="main-form__right">
                <div class="main-form__right_title">
                    Your booking summary
                </div>
                <div class="main-form__right_preview">
                    <div class="main-form__right_preview--item d-flex --just-space">
                        <div class="main-form__right_preview--title">
                            Type
                        </div>
                        <div class="main-form__right_preview--text preview-type-cleaning">
                            End of tenancy
                        </div>
                    </div>
                    <div class="summary-preview-service">
                        <!--                        <div class="main-form__right_preview--item d-flex --just-space">-->
                        <!--                            <div class="main-form__right_preview--title">-->
                        <!--                                Extras-->
                        <!--                            </div>-->
                        <!--                            <div class="main-form__right_preview--text">-->
                        <!--                                £0.00-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                </div>
                <div class="main-form__right_postcode"></div>
                <div class="main-form__right_price d-flex --just-space --align-center">
                    <div class="main-form__right_price--title">
                        Total
                    </div>
                    <div id="order_total_price" class="main-form__right_price--total">
                        £0.00
                    </div>
                </div>
                <button class="block-btn order_submit" type="submit" id="order_submit">Book now</button>
                <div id="error-price"></div>
            </div>
        </form>
    </div>
</div>

<?php get_footer(); ?>
