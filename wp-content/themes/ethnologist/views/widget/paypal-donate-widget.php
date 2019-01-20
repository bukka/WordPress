<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business" value="<?php echo $params['business']; ?>" />

    <!-- Specify a Donate button. -->
    <input type="hidden" name="cmd" value="_donations" />

    <!-- Specify details about the contribution -->
    <input type="hidden" name="item_name" value="<?php echo $params['name']; ?>" />
    <input type="hidden" name="item_number" value="<?php echo $params['number']; ?>" />
    <input type="hidden" name="currency_code" value="<?php echo $params['currency']; ?>" />

    <!-- Display the payment button. -->
    <input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="Donate">
    <img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>