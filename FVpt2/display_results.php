<?php
    // get the data from the form
    $investment = filter_input(INPUT_POST, 'investment', 
            FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate', 
            FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years', 
            FILTER_VALIDATE_INT);
        
    // validate investment inputs here
    //must be valid number
    if( $investment == NULL || $investment === FALSE['investment']) {
        $error_message = "Must be a valid number.";
    } else if($investment <= 0){
        $error_message = "Not greater than 0.";
    }
    // make sure it is greater than 0 and less than or equal to 15
    else if(  $interest_rate == NULL || $interest_rate === FALSE['interest_rate']) {
        $error_message = "Must be a valid Interest rate.";
    } else if($interest_rate <= 0){
        $error_message = "Interest rate must be greater than 0";
    } else if($interest_rate > 15){
        $error_message = "Interest rate no higher than 15.";
    }
     // be valid number, greater than 0, less than 31
     else if( $years == NULL || $years === FALSE['years']) {
         $error_message = "Must be a valid amount of years.";
     } else if($years <= 0){
         $error_message = "years must be greater than 0.";
     } else if($years > 31){
         $error_message = "years must be less than 31";
     }
    // make empty so it can run the errors.
    else {
    $error_message = '';
}
    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');
        exit(); }

    // calculate the future value
    $future_value = $investment;
    for ($i = 1; $i <= $years; $i++) {
        $future_value = 
            $future_value + ($future_value * $interest_rate * .01); 
    }

    // apply currency and percent formatting
    $investment_f = '$'.number_format($investment , 2);
    $yearly_rate_f = $interest_rate.'%';
    $future_value_f = '$'.number_format($future_value, 2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo $investment_f; ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $yearly_rate_f; ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $years; ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $future_value_f; ?></span><br>
    </main>
</body>
</html>
