<!--
   Author: Jonathon Little
   Date: 3/8/2020
   Purpose: Takes the values sent in from the form that the user used to input
            the amount of hours they worked during the week and their hourly wage
            to calculate the weekly gross salary for the user.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>Paycheck</title>                                                                               <!-- Sets the title of the page to Paycheck -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <?php                                                                                                 /* Utilizes a php script delimiter to open up the script for php */
      $errorCount = 0;                                                                                   /* Initializes the $errorCount counter variable and sets it to 0 */
      $hours = $_POST['Hours'];                                                                          /* Sets $hours to the value that was assigned to Hours in the form that was submitted */
      $wage =  $_POST['Wage'];                                                                           /* Sets $wage to the value that was assigned to Wage in the form that was submitted */

      if (Is_Numeric($hours)) {                                                                          /* Sets an if statement to make sure the value for hours entered is numeric */
         if ($hours > 168) {                                                                             /* Sets an if statement to ensure the user did not enter more hours than what were possible within a week */
            echo "You cannot work that many hours in a week! That is more than the
                  amount of hours that can be in a week!<br/>";                                          /* Outputs an error message to the user if the user entered more hours than what were possible in a week */
            ++$errorCount;                                                                               /* Increments the $errorCount counter if there was an error with the hours provided */
         } else if ($hours < 0) {                                                                        /* Sets an else if statement to ensure the hours entered were not negative whilst closing the previous if statement */
            echo "You cannot work negative hours in a week!<br/>";                                       /* Outputs an error message if the user entered negative work hours */
            ++$errorCount;                                                                               /* Increments the $errorCount counter if there was an error with the hours provided */
         }                                                                                               /* Closes the else if statement */
      } else {                                                                                           /* Routes to the else statement if hours is not numeric */
         echo "The hours you entered were not a numeric!<br/>";                                          /* Outputs an error message to the user if the value for hours entered was not numeric */
         ++$errorCount;                                                                                  /* Increments the $errorCount counter if there was an error with the hours value provided */
      }                                                                                                  /* Closes the else statement */

      if (Is_Numeric($wage)) {                                                                           /* Sets an if statement to check the $wage value to ensure it is numeric */
         if ($wage < 0) {                                                                                /* Sets an if statement that checks the wage to make sure it is not negative */
            echo "You cannot have a negative pay rate!<br/>";                                            /* Outputs an error message to the user if the user entered a negative pay rate */
            ++$errorCount;                                                                               /* Increments the $errorCount counter if there was an error with the wage provided */
         }                                                                                               /* Closes the if statement */
      } else {                                                                                           /* Routes to the else if $wage is not numeric */
         echo "The wage you entered was not numeric!<br/>";                                              /* Outputs an error message to the user if the value entered was not numeric */
         ++$errorCount;                                                                                  /* Increments the $errorCount counter if there was an error with the wage value provided */
      }                                                                                                  /* Closes the else statement */

      if (Is_Numeric($hours) AND Is_Numeric($wage)) {                                                    /* Sets an if statement that ensures that $hours and $wage are numeric before starting the calculations in run-time. This is to make sure that no run-time errors are displayed if the values are not numeric. */
         $overtime = max($hours - 40, 0);                                                                /* Sets overtime if there are more than 40 hours, if not then it sets overtime to 0 */
         if ($overtime > 0) {                                                                            /* Sets an if statement to check if the user had any overtime */
            $overtimePay = $overtime * $wage * 1.5;                                                      /* If the user had overtime, then calculates the overtime pay that is due to the user by multiplying their overtime hours by their pay rate times one and a half */
         } else {                                                                                        /* Routes to the else statement if the user had no overtime */
            $overtimePay = 0;                                                                            /* Sets $overtimePay to 0 if the user had no overtime */
         }                                                                                               /* Closes the else statement */
         $pay = $hours * $wage;                                                                          /* Calculates the amount of pay due to the user by multiplying their pay rate by the amount of hours they worked */
      }                                                                                                  /* Closes the if statement */

      if ($errorCount > 0) {                                                                             /* Creates an if statement to check if there were any errors with the values provided */
         echo "Press the Back button to re-enter your information!<br/>";                                /* Outputs a message to the user to return to the form to re-enter their information if errors are found in the values provided */
      } else {                                                                                           /* Routes to the else statement if no errors were found within the submitted values */
         echo "Hours Worked This Week: ".$hours."<br/>";                                                 /* Outputs the total amount of hours the user worked to the user */
         echo "Hourly Wage: $".number_format($wage, 2)."<br/>";                                          /* Outputs the total amount of hourly wage the user earns to the user */
         echo "Overtime Hours Worked: ".$overtime."<br/>";                                               /* Outputs the total amount of overtime the user worked to the user */
         echo "Your Paycheck is: $".number_format($pay + $overtimePay, 2)."<br/>";                       /* Outputs the total amount of the paycheck the user earned to the user */
      }                                                                                                  /* Closes the else statement */
   ?>                                                                                                    <!-- Uses a closing php script delimiter to close the php script -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->