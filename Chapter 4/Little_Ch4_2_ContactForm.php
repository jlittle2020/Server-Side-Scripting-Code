<!--
   Author: Jonathon Little
   Date: 2/29/20
   Purpose: To create a contact form that will send an E-mail out from the user.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>Contact Me</title>                                                                             <!-- Sets the title of the page to Contact Me -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <?php                                                                                                 /* Utilizes a php script delimiter to open up the script for php */
      function validateInput($data, $fieldName) {                                                        /* Creates a function for validating input */
         global $errorCount;                                                                             /* Initializes the $errorCount variable within the function and assigns it to global power */
         if (empty($data)) {                                                                             /* Checks to see if any date in the fields were left empty */
            echo "\"$fieldName\" is a required field.<br/>\n";                                           /* Outputs an error message to the user telling the user that it is a required field that needs to be filled in */
            ++$errorCount;                                                                               /* Takes the value assigned to $errorCount and increments it by 1 */
            $retval = "";                                                                                /* Sets the return value to an empty string */
         } else {                                                                                        /* Routes to the else if all fields were filled in */
            $retval = trim($data);                                                                       /* Removes any white space around the data given */
            $retval = stripslashes($retval);                                                             /* Removes any slashes in the data given */
         }                                                                                               /* Closes the else statement */
         return($retval);                                                                                /* Returns the return value after validating it */
      }                                                                                                  /* Closes the function that validates input */

	  function validateEmail($data, $fieldName) {                                                        /* Creates a function for validating E-mail */
         global $errorCount;                                                                             /* Initializes the $errorCount variable within the function and assigns it to global power */
         if (empty($data)) {                                                                             /* Checks to see if the E-mail field was left empty */
            echo "\"$fieldName\" is a required field.<br/>\n";                                           /* Outputs an error message to the user that tells the user the E-mail space in the form is a required field if any fields are left empty */
            ++$errorCount;                                                                               /* Takes the value assigned to $errorCount and increments it by 1 */
            $retval = "";                                                                                /* Sets the return value to an empty string */
         } else {                                                                                        /* Routes to the else if all fields were filled in correctly */
            $retval = trim($data);                                                                       /* Clears any white space that surrounds the data given */
			$retval = stripslashes($retval);                                                             /* Removes slashes within the value given */
            $pattern = "/^[\w-]+(\.[\w-]+)*@" .
                       "[\w-]+(\.[\w-]+)*" .
                       "(\.[a-z]{2,})$/i";                                                               /* Checks the E-mail format to make sure it is correct */
            if (preg_match($pattern, $retval)==0) {                                                      /* Checks to see if the E-mail is not valid */
               echo "\"$fieldName\" is not a valid e-mail address.<br/>\n";                              /* Outputs an error message to the user that lets the user know that the E-mail entered was not valid */
               ++$errorCount;                                                                            /* Takes the value assigned to $errorCount and adds to it by 1 */
            }                                                                                            /* Closes the if statement */
         }                                                                                               /* Closes the else statement */
         return($retval);                                                                                /* Returns back the return value for E-mail after validating it */
      }                                                                                                  /* Closes the function that validates the E-mail */

      function displayForm($Sender, $Email, $Subject, $Message) {                                        /* Creates a function to create the Contact Me form */
         ?>                                                                                              <!-- Uses a php script delimiter to close the script in php -->
         <h2 style="text-align:center">Contact Me</h2>                                                   <!-- Creates a header for the form called Contact Me and aligns it in the center of the web page document -->
         <form name="contact" action="Little_Ch4_2_ContactForm.php" method="post">                       <!-- Opens up a form and sets it to run through the PHP file once submitted -->
            <p>Your Name: <input type="text" name="Sender" value="<?php echo $Sender; ?>"/></p>          <!-- Creates a space for the user to enter their name -->
            <p>Your E-mail: <input type="text" name="Email" value="<?php echo $Email; ?>"/></p>          <!-- Creates a space for the user to enter their E-mail -->
            <p>Subject: <input type="text" name="Subject" value="<?php echo $Subject; ?>"/></p>          <!-- Creates a space for the user to enter the subject for their message-->
            <p>Message: <br/><textarea name="Message"><?php echo $Message; ?></textarea></p>             <!-- Creates a textarea space so the user can type their message within the space provided -->
            <p><input type="reset" value="Clear Form"/>&nbsp;                                            <!-- Creates a reset button for the user to reset the form -->
            &nbsp;<input type="submit" name="Submit" value="Send Form"/></p>                             <!-- Creates a submit button for the user to submit the form -->
         </form>                                                                                         <!-- Closes the form -->
         <?php                                                                                           /* Uses a php script delimiter and uses it to reopen the script in php */
      }                                                                                                  /* Closes the displayForm function */
      
      $ShowForm = TRUE;                                                                                  /* Initializes the $ShowForm to a boolean format and sets it to TRUE */
      $errorCount = 0;                                                                                   /* Initializes $errorCount to a number format and sets it to 0 */
      $Sender = "";                                                                                      /* Initializes $Sender to a string format */
      $Email = "";                                                                                       /* Initializes $Email to a string format */
      $Subject = "";                                                                                     /* Initializes $Subject to a string format */
      $Message = "";                                                                                     /* Initializes $Message to a string format */

      if (isset($_POST['Submit'])) {                                                                     /* If the user hit submit, then it checks the form values for validation */
         $Sender = validateInput($_POST['Sender'],"Your Name");                                          /* Validates the input for $Sender */
         $Email = validateEmail($_POST['Email'],"Your E-mail");                                          /* Validates the input for $Email */
         $Subject = validateInput($_POST['Subject'],"Subject");                                          /* Validates the input for $Subject */
         $Message = validateInput($_POST['Message'],"Message");                                          /* Validates the input for $Message */
      }                                                                                                  /* Closes the if statement */

      if ($errorCount == 0) {                                                                            /* Checks to see if $errorCount is equal to 0 */
         $ShowForm = TRUE;                                                                               /* Sets $ShowForm to TRUE */
      } else {                                                                                           /* Routes to the else if $errorCount is not equal to 0 */
         $ShowForm = FALSE;                                                                              /* Sets $ShowForm to FALSE */
      }                                                                                                  /* Closes the else statement */

      if ($ShowForm == TRUE) {                                                                           /* Checks to see if $ShowForm is set to TRUE */
         if ($errorCount > 0) {                                                                          /* Checks to see if $errorCount is greater than 0 to see if there were any errors with the form */
            echo "<p>Please re-enter the form information below.</p>\n";                                 /* Outputs a message to the user that tells the user to re-enter the information provided */
            displayForm($Sender, $Email, $Subject, $Message);                                            /* If there any errors then it diplays the form fields again */
         } else {                                                                                        /* Routes to the else if there were no errors with the form being sent */
            $SenderAddress = "$Sender <$Email>";                                                         /* Sets the sender address from the sender name and E-mail */
            $Headers = "From: $SenderAddress\nCC: $SenderAddress\n";                                     /* Sets the header of the message that displays who it was from */
            $result = mail("recipient@example.com", $Subject, $Message, $Headers);                       /* Sets the result to the Sender's email, the subject of the message, message, and any headers of the E-mail */
            if ($result) {                                                                               /* Checks the result to see if the E-mail was sent */
               echo "<p>Your message has been sent. Thank you, " . $Sender . ".</p>\n";                  /* Outputs a thank you message to the user if the E-mail was sent successfully */
            } else {                                                                                     /* Routes to the else if the result wasn't successful */
               echo "<p>There was an error sending your message, " . $Sender . ".</p>\n";                /* Outputs an error message to the user if there was an error sending the E-mail */
            }                                                                                            /* Closes the else statement */
         }                                                                                               /* Closes the else statement */
      }                                                                                                  /* Closes the if statement */
   ?>                                                                                                    <!-- Uses a closing php script delimiter to close the php script -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->