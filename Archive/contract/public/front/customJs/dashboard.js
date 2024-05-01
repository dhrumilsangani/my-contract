$('.checkout-button').on('click', function() {
    var getPayUrl = baseurl+'/front/product_checkout';	
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        method: "post",
        data: {
            product_price: $(this).attr('product_id')
        },
        url: getPayUrl,
        success: function(result) {
            stripe.redirectToCheckout({
                sessionId: result
              }).then(function (result) {
                });
           //stripe.redirectToCheckout({ sessionId: result })
        }
    });
})