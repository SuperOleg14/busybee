$(document).ready(() => {

    let form = document.getElementById('main-form');
    form.addEventListener('submit', (event) => {
        let formData = new FormData(form);
        fillFormData(formData);

        $.ajax({
            url: form.getAttribute('action'),
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: (data) => {
                // console.log(data);
                window.location.href = 'https://busybeeclean.co.uk/thank-you/';
                data = JSON.parse(data);
                if (data.errors && data.errors.price) {
                    $('#error-price').text(data.errors.price).show();
                } else {
                    $('#error-price').hide();
                }
            },
        });
        event.preventDefault();
    });


    function getSelectedExtras() {
        const checkboxes = document.querySelectorAll('.extras_label:checked');

        const selectedExtras = [];
        checkboxes.forEach((checkbox) => {
            if (checkbox.parentElement.parentElement.style.display !== 'none') {
                const extrasName = checkbox.name;
                const inputExtrasValue = document.querySelector(`[data-extras="${extrasName}"]`).value;
                selectedExtras.push({
                    name: extrasName,
                    value: inputExtrasValue
                });
            }
        });

        return selectedExtras;
    }

    function fillFormData(formData) {
        let typeCleaning = document.querySelector('input[name="type_cleaning"]:checked').dataset.type_cleaning;
        let spaceFurnished = document
            .querySelector('input[name="space_furnished"]:checked')
            .dataset
            .furinshed;
        let bedrooms = document.querySelector('input[name="bedrooms"]').value;
        let bathrooms = document.querySelector('input[name="bathrooms"]').value;
        let extras = getSelectedExtras();
        let cleaningProducts = document.querySelector('input[name="cleaning_products"]:checked')
            .dataset
            .cleaning_products;
        let oftenWork = document.querySelector('input[name="often_work"]:checked').value;

        formData.append('type_cleaning', typeCleaning);
        formData.append('space_furnished', spaceFurnished);
        formData.append('bedrooms', bedrooms);
        formData.append('bathrooms', bathrooms);
        extras.forEach((element) => formData.append('extras[' + element.name + ']', element.value));
        formData.append('cleaning_products', cleaningProducts);
        formData.append('often_work', oftenWork);

        return formData;
    }

    function transferPriceFields() {
        let formData = new FormData();
        fillFormData(formData);

        $.ajax({
            url: '/wp-admin/admin-ajax.php?action=calculate_order',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: (data) => {
                data = JSON.parse(data);
                if (data.price !== undefined) {
                    document.getElementById('order_total_price').innerHTML = '£' + data.price;
                }
            }
        });
    }
    transferPriceFields();

    let typesCleaning = document.getElementsByName('type_cleaning');
    typesCleaning.forEach((element) => element.addEventListener('change', transferPriceFields));

    let spaceFurnished = document.getElementsByName('space_furnished');
    spaceFurnished.forEach((element) => element.addEventListener('change', transferPriceFields));

    let minuses = document.getElementsByClassName('quantity-arrow quantity-arrow-minus');
    for (let minus of minuses) {
        setTimeout(() => minus.addEventListener('click', transferPriceFields), 300);
    }
    let pluses = document.getElementsByClassName('quantity-arrow quantity-arrow-plus');
    for (let plus of pluses) {
        setTimeout(() => plus.addEventListener('click', transferPriceFields), 300);
    }

    let checkboxes = document.querySelectorAll('input[type="checkbox"][id^="extras"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            transferPriceFields();
        });
    });

    let instruments = document.querySelectorAll('input[name="cleaning_products"]');
    instruments.forEach((element) => element.addEventListener('change', transferPriceFields));

    let quantityInputs = document.querySelectorAll('input[class="quantity-num"]');
    quantityInputs.forEach((element) => element.addEventListener('keyup', transferPriceFields));

    let oftenWorks = document.getElementsByName('often_work');
    oftenWorks.forEach((element) => element.addEventListener('change', transferPriceFields));
});
