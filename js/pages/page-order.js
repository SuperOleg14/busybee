$('.form-radios input[type="radio"]').change(function() {
    const $formRadios = $(this).closest('.form-radios');
    $formRadios.find('label').removeClass('checked');

    if ($(this).is(':checked')) {
        $(this).closest('label').addClass('checked');
    }
});

$(function() {
    (function quantityProducts() {
        var $quantityArrowMinus = $('.quantity-arrow-minus');
        var $quantityArrowPlus = $('.quantity-arrow-plus');

        $quantityArrowMinus.click(quantityMinus);
        $quantityArrowPlus.click(quantityPlus);

        function quantityMinus() {
            var $quantityNum = $(this).siblings('.quantity-num');
            var currentValue = +$quantityNum.val();

            if ($quantityNum.attr('name') !== 'bedrooms' && currentValue <= 1) {
                return;
            }
            if ($quantityNum.attr('name') === 'bedrooms' && currentValue <= 0) {
                return;
            }

            if (currentValue > 0) {
                $quantityNum.val(currentValue - 1);
            }
        }

        function quantityPlus() {
            var $quantityNum = $(this).siblings('.quantity-num');
            $quantityNum.val(+$quantityNum.val() + 1);
        }
    })();
});

$(document).ready(() => {
    flatpickr(
        '#datepick_selector',
        {
            altInput: true,
            altFormat: 'Y-m-d',
            dateFormat: 'Y-m-d',
            defaultDate: new Date(),
            minDate: new Date(),
        }
    );

    $('input[name="square_footage"]').on('input', function() {
        var squareFootage = $(this).val();
        $('.main-form__right_preview--item--square .main-form__right_preview--text').text(squareFootage + ' m2');
    });

    $('input[name="date"]').on('input', function() {
        var dateCommercial = $(this).val();
        $('.main-form__right_preview--item--date .main-form__right_preview--text').text(dateCommercial);
    });

    $('input[name="often_work"]').change(function() {
        var oftenWorkInputValue = $('input[name="often_work"]:checked').val();
        $('.main-form__right_preview--item--often .main-form__right_preview--text').text(oftenWorkInputValue);
    });

    let squarePreviewText = '';
    let savedSquarePreviewText = '';

    $('input[name="square_footage"]').on('input', function() {
        const squareFootage = parseFloat($(this).val());

        if (squareFootage > 1) {
            squarePreviewText = squareFootage.toString() + ' m²';
        } else {
            squarePreviewText = '';
        }

        const selectedValue = $('input[name="type_cleaning"]:checked').data('type_cleaning');

        if (selectedValue !== 6) {
            savedSquarePreviewText = $(this).val();
        }

        $('.summary-preview-service .main-form__right_preview--item[data-form_cleaning="square"]').remove();
        if ((selectedValue !== 6 && squarePreviewText !== '') || savedSquarePreviewText !== '') {
            const textToShow = savedSquarePreviewText !== '' ? savedSquarePreviewText + ' m²' : squarePreviewText;
            const newSquarePreview = `
            <div class="main-form__right_preview--item d-flex --just-space" data-form_cleaning="square">
                <div class="main-form__right_preview--title">
                    Square
                </div>
                <div class="main-form__right_preview--text">
                    ${textToShow}
                </div>
            </div>
        `;
            if (selectedValue !== 6) {
                $('.summary-preview-service').append(newSquarePreview);
            }
        }
    });

    $('input[name="type_cleaning"]').change(function() {
        const selectedValue = $(this).data('type_cleaning');

        if (selectedValue !== 6) {
            const squareFootageValue = $('input[name="square_footage"]').val();
            if (squareFootageValue !== '') {
                const existingSquareBlock = $('.summary-preview-service .main-form__right_preview--item[data-form_cleaning="square"]');
                if (existingSquareBlock.length === 0) {
                    const newSquarePreview = `
                    <div class="main-form__right_preview--item d-flex --just-space" data-form_cleaning="square">
                        <div class="main-form__right_preview--title">
                            Square
                        </div>
                        <div class="main-form__right_preview--text">
                            ${squareFootageValue} m²
                        </div>
                    </div>
                `;
                    $('.summary-preview-service').append(newSquarePreview);
                } else {
                    existingSquareBlock.find('.main-form__right_preview--text').text(squareFootageValue + ' m²');
                }
            }
        } else {
            $('.summary-preview-service .main-form__right_preview--item[data-form_cleaning="square"]').remove();
        }
    });

    $('input[name="type_cleaning"]').change(function() {
        var selectedValue = $(this).data('type_cleaning');
        var previewItems = $('.summary-preview-service .main-form__right_preview--item');

        if (selectedValue === 6) {
            previewItems.hide();
            $('.summary-commercial-preview').remove();
            $('.summary-preview-service').append('<div class="summary-commercial-preview main-form__right_preview--item main-form__right_preview--item--square d-flex --just-space">' +
                '<div class="main-form__right_preview--title">Square</div>' +
                '<div class="main-form__right_preview--text">' + $('input[name="square_footage"]').val() + ' m2</div>' +
                '</div><div class="summary-commercial-preview main-form__right_preview--item main-form__right_preview--item--date d-flex --just-space">' +
                '<div class="main-form__right_preview--title">Date</div>' +
                '<div class="main-form__right_preview--text">' + $('input[name="date"]').val() + '</div>' +
                '</div><div class="summary-commercial-preview main-form__right_preview--item main-form__right_preview--item--often d-flex --just-space">' +
                '<div class="main-form__right_preview--title">How Often</div>' +
                '<div class="main-form__right_preview--text">' + $('input[name="often_work"]:checked').val() + '</div>' +
                '</div>');
        } else {
            previewItems.show();
            $('.summary-commercial-preview').remove();
        }
    });

    $('.extras_label').change(function() {
        var isChecked = $(this).is(':checked');
        var extras = $(this).attr('id');
        var numberInput = $('input[data-extras="' + extras + '"]');
        var formNumber = numberInput.closest('.form-checkbox-item').find('.form-number');

        if (isChecked) {
            formNumber.show();
        } else {
            formNumber.hide();
        }
    });

    function toggleCleaningItems(showClass, hideSelector, hideBathrooms = false) {
        $(showClass).show();
        $(hideSelector).hide();
        if (hideBathrooms) {
            $('.form-number-item-bathrooms').hide();
        } else {
            $('.form-number-item-bathrooms').show();
        }
    }

    $('input[name="type_cleaning"]').change(function() {
        var selectedValue = $(this).attr('class');
        var ActiveInputValue = $(this).val();

        if (selectedValue.includes('all_cleaning')) {
            toggleCleaningItems('.form-checkbox-item.all_cleaning', '.form-checkbox-item:not(.all_cleaning)');
        } else if (selectedValue.includes('deep_cleaning')) {
            toggleCleaningItems('.form-checkbox-item.deep_cleaning', '.form-checkbox-item:not(.deep_cleaning)');
        } else if (selectedValue.includes('domestic_cleaning')) {
            toggleCleaningItems('.form-checkbox-item.domestic_cleaning', '.form-checkbox-item:not(.domestic_cleaning)');
        } else if (selectedValue.includes('carpet_cleaning')) {
            toggleCleaningItems('.form-checkbox-item.carpet_cleaning', '.form-checkbox-item:not(.carpet_cleaning)', true);
        }

        if ($(this).hasClass('often_work_cleaning')) {
            $('.often_work').hide();
        } else {
            $('.often_work').show();
        }

        if ($(this).hasClass('domestic_cleaning')) {
            $('.form-radios-furnished').hide();
            $('.cleaning_products').show();
        } else {
            $('.form-radios-furnished').show();
            $('.cleaning_products').hide();
        }

        if ($(this).hasClass('commercial_cleaning')) {
            $('.extras, .space-option, .main-form__right_price, .payment-method').hide();
        } else {
            $('.extras, .space-option, .main-form__right_price, .payment-method').show();
        }

        $('.preview-type-cleaning').text(ActiveInputValue);
    });

    $('input[name="postcode"]').on('blur', function() {
        validatePostcode();
    });

    $('input[name="type_cleaning"]').on('change', function() {
        $('.main-form__right_postcode').text('');
        $('.error-message').text('').removeClass('search-success search-error');
        validatePostcode();
    });

    $('input[name="postcode"]').on('keydown', function(event) {
        if (event.which === 13) {
            event.preventDefault();
            validatePostcode();
        }
    });

    function validatePostcode() {
        var enteredPostcode = $('input[name="postcode"]').val().toUpperCase();
        var typeCleaning = $('input[name="type_cleaning"]:checked').data('type_cleaning');

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'busy_bee_get_supported_postcodes'
            },
            success: function(postcodes) {

                var validationStatus = isValidPostcode(enteredPostcode, postcodes.supported, postcodes.unsupported, typeCleaning);

                if (validationStatus === 'supported') {
                    $('.main-form__right_postcode').text(enteredPostcode);
                    $('.error-message').text('Cleaner is available in your area').removeClass('search-error').addClass('search-success');
                } else if (validationStatus === 'unsupported') {
                    $('.main-form__right_postcode').text('');
                    $('.error-message').text('Unfortunately we don’t cover your area').removeClass('search-success').addClass('search-error');
                } else {
                    $('.main-form__right_postcode').text('');
                    $('.error-message').text('Please enter a valid postcode').removeClass('search-success').addClass('search-error');
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function isValidPostcode(postcode, supportedPostcodes, unsupportedPostcodes, typeCleaning) {
        var uppercasePostcode = postcode.toUpperCase();

        if (supportedPostcodes.includes(uppercasePostcode)) {
            return 'supported';
        }

        if (unsupportedPostcodes.includes(uppercasePostcode)) {
            if (typeCleaning === 6) {
                return 'supported';
            } else {
                return 'unsupported';
            }
        }

        if (uppercasePostcode.length >= 4) {
            var firstFour = uppercasePostcode.substring(0, 4);

            if (supportedPostcodes.includes(firstFour)) {
                return 'supported';
            } else if (unsupportedPostcodes.includes(firstFour)) {
                if (typeCleaning === 6) {
                    return 'supported';
                } else {
                    return 'unsupported';
                }
            }
        }

        if (uppercasePostcode.length >= 3) {
            var firstThree = uppercasePostcode.substring(0, 3);

            if (supportedPostcodes.includes(firstThree)) {
                return 'supported';
            } else if (unsupportedPostcodes.includes(firstThree)) {
                if (typeCleaning === 6) {
                    return 'supported';
                } else {
                    return 'unsupported';
                }
            }
        }

        return 'invalid';
    }

    function setPostcodeFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const postcode = urlParams.get('postcode');

        if (postcode) {
            $('input[name="postcode"]').val(postcode);
            $('.main-form__right_postcode').text(postcode);
            $('.error-message').text('Cleaner is available in your area').removeClass('search-error').addClass('search-success');
        }
    }

    setPostcodeFromURL();

    $('input[name="type_cleaning"]').on('change', function() {
        const checkboxes = document.querySelectorAll('.form-checkbox-item[data-form_cleaning]');
        checkboxes.forEach((checkbox) => {
            const checkboxStyle = window.getComputedStyle(checkbox);
            if (checkboxStyle.display === 'none') {
                const cleaningValue = checkbox.getAttribute('data-form_cleaning');
                const itemsToHide = document.querySelectorAll(`.main-form__right_preview--item[data-form_cleaning="${cleaningValue}"]`);
                itemsToHide.forEach((item) => {
                    item.style.display = 'none';
                });
            }
        });
    });

});

function updateSummaryPreview(extrasName, labelText, totalCost, formCleaning) {
    const summaryService = document.querySelector('.summary-preview-service');
    const existingItem = summaryService.querySelector(`[data-extras="${extrasName}"]`);

    if (existingItem) {
        const textElement = existingItem.querySelector('.main-form__right_preview--text');
        textElement.textContent = `£${totalCost.toFixed(2)}`;
    } else {
        const previewHTML = `
            <div class="main-form__right_preview--item d-flex --just-space" data-extras="${extrasName}" ${formCleaning ? `data-form_cleaning="${formCleaning}"` : ''}>
                <div class="main-form__right_preview--title">${labelText}</div>
                <div class="main-form__right_preview--text">£${totalCost.toFixed(2)}</div>
            </div>
        `;
        summaryService.insertAdjacentHTML('beforeend', previewHTML);
    }
}

function handleQuantityNumChange(event) {
    const input = event.target;
    const checkboxItem = input.closest('.form-checkbox-item');
    const priceElement = checkboxItem.querySelector('[data-price]');
    const price = parseFloat(priceElement.dataset.price);
    const extrasName = input.dataset.extras;
    let quantity = parseFloat(input.value);

    let extrasQuantity = quantity;

    if (quantity < 1 || isNaN(quantity)) {
        extrasQuantity = 1;
        input.value = 1;
    }

    const labelText = checkboxItem.querySelector('.extras_label').textContent.trim();
    const totalCost = price * extrasQuantity;
    updateSummaryPreview(extrasName, labelText, totalCost);
}

function getSelectedExtras() {
    const checkboxes = document.querySelectorAll('.extras_label');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', (event) => {
            const extrasName = event.target.name;
            const inputExtrasValue = document.querySelector(`[data-extras="${extrasName}"]`).value;
            const isSelected = event.target.checked;
            const labelText = event.target.nextElementSibling.textContent.trim();
            const priceElement = event.target.closest('.form-checkbox-item').querySelector('[data-price]');
            const price = parseFloat(priceElement.dataset.price);
            const quantity = parseFloat(document.querySelector(`[data-extras="${extrasName}"].quantity-num`).value);
            const formCleaningElement = event.target.closest('.form-checkbox-item').getAttribute('data-form_cleaning');
            const formCleaning = formCleaningElement ? parseInt(formCleaningElement, 10) : undefined;

            if (isSelected) {
                const totalCost = price * quantity;
                updateSummaryPreview(extrasName, labelText, totalCost, formCleaning);
                // console.log(`Выбрано: ${extrasName} - ${inputExtrasValue} - Label Text: ${labelText} - Price: £${totalCost.toFixed(2)}`);
            } else {
                // console.log(`Не выбрано: ${extrasName}`);
                const existingItem = document.querySelector(`.main-form__right_preview--item[data-extras="${extrasName}"]`);
                if (existingItem) {
                    existingItem.remove();
                }
            }
        });
    });

    const quantityNums = document.querySelectorAll('.quantity-num');

    quantityNums.forEach((input) => {
        input.addEventListener('input', handleQuantityNumChange);
    });

    const quantityArrows = document.querySelectorAll('.extras .quantity-arrow');
    quantityArrows.forEach((arrow) => {
        arrow.addEventListener('click', (event) => {

            const checkboxItem = event.target.closest('.form-checkbox-item');
            const priceElement = checkboxItem.querySelector('[data-price]');
            const price = parseFloat(priceElement.dataset.price);
            const input = checkboxItem.querySelector('.quantity-num');
            const extrasName = input.dataset.extras;
            let quantity = parseFloat(input.value);
            let extrasQuantity = quantity + 1;

            if (event.target.classList.contains('quantity-arrow-plus')) {
                extrasQuantity = quantity + 1;
            } else if (event.target.classList.contains('quantity-arrow-minus')) {
                if (quantity > 1) {
                    extrasQuantity = quantity - 1;
                } else {
                    extrasQuantity = 1;
                }
            }

            const labelText = checkboxItem.querySelector('.extras_label').textContent.trim();
            const totalCost = price * extrasQuantity;
            updateSummaryPreview(extrasName, labelText, totalCost);
        });
    });

}

getSelectedExtras();

