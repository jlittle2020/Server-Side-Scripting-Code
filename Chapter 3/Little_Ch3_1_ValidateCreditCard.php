<!--
   Author: Jonathon Little
   Date: 2/21/20
   Purpose: Validating Credit Card numbers.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>Validate Credit Card</title>                                                                   <!-- Sets the title of the page to Validate Credit Card -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <h1>Validate Credit Card</h1><hr />                                                                   <!-- Sets a page header named Validate Credit Card and then sets a horizontal line on the page to separate it from the outputted data -->
   <?php                                                                                                 /* Uses a php script delimiter to open the code declaration block */
      $CreditCard = array(                                                                               /* Creates an array by the name of $CreditCard and assigns it three values: an empty string, a string of numbers, and a mixed string of characters and numbers */
         "",
         "8910-1234-5678-6543",
         "OOOO-9123-4567-0123");
      foreach ($CreditCard as $CardNumber) {                                                             /* Sets a loop to run through each array value and run it through validation for a Credit Card number */
         if (empty($CardNumber)) {                                                                       /* Checks to see if the value given was empty */
            echo "<p>This Credit Card Number is
                  invalid because it contains an empty
                  string.</p>";                                                                          /* If the value was empty then it returns a statement that says the Credit Card number is invalid because of it being an empty string */
         } else {                                                                                        /* Routes to the else if the the $CardNumber value is not empty */
            $CreditCardNumber = $CardNumber;                                                             /* Sets the variable of $CreditCardNumber to the value of $CardNumber */
            $CreditCardNumber = str_replace("-", "",
               $CreditCardNumber);                                                                       /* Takes the string value and eliminates any dashes between the numbers and/or characters */
            $CreditCardNumber = str_replace(" ", "",
               $CreditCardNumber);                                                                       /* Takes the string value and eliminates any spaces between the numbers and/or characters */
            if (!is_numeric($CreditCardNumber)) {                                                        /* Checks the string value to validate that it is numeric or all numbers */
               echo "<p>Credit Card Number ".
                     $CreditCardNumber . " is not a valid
                     Credit Card number because it contains
                     a non-numeric character. </p>";                                                     /* If the string value contains anything other than numbers, then it will output that the Credit Card number is not valid */
            } else {                                                                                     /* Routes to the else if the string value is all numbers */
               echo "<p>Credit Card Number " .
                     $CreditCardNumber . " is a valid
                     Credit Card number.</p>";                                                           /* If the string value is all numeric, then it outputs that the Credit Card number is valid. */
            }                                                                                            /* Closes the else */
         }                                                                                               /* Closes the else on line 25 */
      }                                                                                                  /* Closes the foreach loop */
   ?>                                                                                                    <!-- Uses a php script delimiter to close the code declaration block -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->