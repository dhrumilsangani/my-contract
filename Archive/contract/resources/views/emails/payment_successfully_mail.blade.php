<div>
    <?php if(!empty($name)){?>
        <p>Hello {{ $name }},</p>
    <?php }else{ ?>
        <p>Hello</p>
    <?php } ?> 
    <p>Payment confirmed - thank you for your payment! </p>
    <p>Your account can be accessed <a href="{{$login}}">Click Here!</a></p>
    <p>If you have any issues with your account, please contact us at  <a href="mailto:support@createmycontract.com">support@createmycontract.com</a> </p>
    <br>
    <p>Best wishes</p>
    <p>The CMC Team</p>
    <br>
</div>
