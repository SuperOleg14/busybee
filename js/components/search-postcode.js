$('.searchregion').on('submit', function(e) {
    e.preventDefault();

    var currentForm = $(this);
    var enteredPostcode = currentForm.find('.searchregioninput').val().toUpperCase();
    var searchMessage = currentForm.find('.search-message');

    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        method: 'POST',
        dataType: 'json',
        data: {
            action: 'busy_bee_get_supported_postcodes'
        },
        success: function(postcodes) {
            var validationStatus = isValidPostcode(enteredPostcode, postcodes.supported, postcodes.unsupported);
            if (validationStatus === 'supported') {
                var redirectURL = '/order/?postcode=' + encodeURIComponent(enteredPostcode);
                window.location.href = redirectURL;
            } else if (validationStatus === 'unsupported') {
                searchMessage.text('Unfortunately we don’t cover your area').removeClass('search-success').addClass('search-error');
            } else {
                searchMessage.text('Please enter a valid postcode').removeClass('search-success').addClass('search-error');
            }
        },
        error: function(error) {
            console.error(error);
        }
    });
});

// function isValidPostcode(postcode, supportedPostcodes, unsupportedPostcodes) {
//     if (supportedPostcodes.includes(postcode.toUpperCase())) {
//         return 'supported';
//     } else if (unsupportedPostcodes.includes(postcode.toUpperCase())) {
//         return 'unsupported';
//     }
//     return 'invalid';
// }

function isValidPostcode(postcode, supportedPostcodes, unsupportedPostcodes) {
    var uppercasePostcode = postcode.toUpperCase();

    if (supportedPostcodes.includes(uppercasePostcode)) {
        return 'supported';
    }

    if (unsupportedPostcodes.includes(uppercasePostcode)) {
        return 'unsupported';
    }

    if (uppercasePostcode.length >= 4) {
        var firstFour = uppercasePostcode.substring(0, 4);

        if (supportedPostcodes.includes(firstFour)) {
            return 'supported';
        }

        if (unsupportedPostcodes.includes(firstFour)) {
            return 'unsupported';
        }
    }

    if (uppercasePostcode.length >= 3) {
        var firstThree = uppercasePostcode.substring(0, 3);

        if (supportedPostcodes.includes(firstThree)) {
            return 'supported';
        }

        if (unsupportedPostcodes.includes(firstThree)) {
            return 'unsupported';
        }
    }

    return 'invalid';
}

