<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buy cool new product</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
   
    <button id="checkout-button">Checkout</button>
    
    <script type="text/javascript">
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe('pk_test_51HWhDIIRLNCSplOloRx97zVipWF2mcZeNkK6dLocZ2W8OVfpDHUYI8JoeEYE7YCHT4R7A9Sb9Qw5JAkde25Mo5LM003jXz2YMC');
        

$('#checkout-button').on('click',function(){
   
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        method:"post",
        url: "{{url('/stripe')}}",
        success: function(result){
            stripe.redirectToCheckout({ sessionId: result })

        }
      });
})
</script>

  </body>
  
  
</html>
