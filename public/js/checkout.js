/**
 * Created by oskar on 02.08.17.
 */
Stripe.setPublishableKey('pk_test_Cm5d4vHnR2vOCkkw5h72TrGn');

var $form =$('#checkout-form');

$form.submit(function (event) {
    $('#charge-error').addClass('hidden');
    //$('#confirm-spinner').fadeIn();
    $form.find('button').prop('disabled', true);
    $form.find('button').fadeOut('fast', function () {
        $('#confirm-spinner').removeClass('hidden');
    });
    Stripe.card.createToken({
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val(),
        name: $('#card-name').val()
    }, stripeResponseHandler);
    return false;
});

function stripeResponseHandler(status, response) {
    if(response.error) {
        $('#charge-error').removeClass('hidden');
        $('#confirm-spinner').addClass('hidden');
        $form.find('button').fadeIn();
        $('#charge-error').text(response.error.message);
        $form.find('button').prop('disabled', false);
    } else {
        var token = response.id;

        // Insert the token into the form so it gets submitted to the server:
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));

        // Submit the form:
        $form.get(0).submit();

    }
}

