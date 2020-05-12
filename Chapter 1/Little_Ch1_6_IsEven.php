<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way. -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document. -->
<head>                                                                                                   <!-- Opens the head portion of the document. -->
   <!--
      Author: Jonathon Little
	  Date: 1/26/20
	  Purpose: Uses the is_numeric() and round() function with a conditional 
               operator to determine if a string of characters is numeric and 
               whether it is an even or odd number. Floating numbers are rounded to 
               the nearest whole number.
   -->
   <title>Is Even</title>                                                                                <!-- Sets the title of the page to Is Even. -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use. -->
</head>                                                                                                  <!-- Closes the head portion of the document. -->
<body>                                                                                                   <!-- Opens the body portion of the document. -->
   <?php                                                                                                 /* Uses a php script delimiter to open the code declaration block. */
      $Number = 3.7;                                                                                     /* Declares the variable $Number to be 3.7. */
	  $RoundedNumber = round($Number);                                                                   /* Uses the round() function to declare the variable $RoundedNumber as a rounded numeric whole number from $Number. */
      if (is_numeric($Number)) {                                                                         /* Creates a conditional statement to check if the $Number variable is numeric. */
         $Result = "";                                                                                   /* Creates an open declared variable named $Result for the ending result statement. */
         if ($RoundedNumber & 1) {                                                                       /* Creates a conditional statement to check if the variable is an odd number. */
            $Result = "The number $RoundedNumber is numeric and an odd number!";                         /* Assigns the statement to $Result on the screen if the number is odd. */
         } else  {                                                                                       /* Creates a secondary conditional statement if the number is not odd but an even number. */
            $Result = "The number $RoundedNumber is numeric and an even number!";                        /* Assigns the statement to $Result on the screen if the number is even. */
         }                                                                                               /* Closes the conditional statement for the even or odd validation */
      } else {                                                                                           /* Routes to the second conditional if the variable is not numeric */
         $Result = "This number is not numeric!";                                                        /* Assigns the statement to $Result if the variable is not numeric */
      }                                                                                                  /* Closes the conditional statement for the numeric or not numeric validation */
      echo $Result;                                                                                      /* Displays the statement assigned to $Result onscreen */
   ?>                                                                                                    <!-- Uses a php script delimiter to close the code declaration block. -->
</body>                                                                                                  <!-- Closes the body portion of the document. -->
</html>                                                                                                  <!-- Closes the document -->