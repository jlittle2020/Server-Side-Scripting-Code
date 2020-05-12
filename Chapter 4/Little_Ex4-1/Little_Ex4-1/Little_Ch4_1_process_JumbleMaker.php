<!--
   Author: Jonathon Little
   Date: 2/25/20
   Purpose: Takes the words inputted by the form and then processes them to output a jumbled version of the word.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>Jumble Maker</title>                                                                           <!-- Sets the title of the page to Jumble Maker -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <?php                                                                                                 /* Utilizes a php script delimiter to open up the script for php */
      function displayError($fieldName, $errorMsg) {                                                     /* Creates the displayError function and calls forth the fieldName data and errorMsg data */
         global $errorCount;                                                                             /* Calls the global variable for the error count's value to be able to process its value and initialize it within the function */
         echo "Error for \"$fieldName\": $errorMsg<br/>\n";                                              /* Outputs an error message with the error that happened in regards to the data that was entered within its designated field */
         ++$errorCount;                                                                                  /* Adds to the error count each time an error is encountered */
      }                                                                                                  /* Closes the displayError function */
      
      function validateWord($data, $fieldName) {                                                         /* Creates the validateWord function and calls forth the data data and fieldName data */
         global $errorCount;                                                                             /* Calls the global variable for the error count's value to be able to process its value and initialize it within the function */
         if (empty($data)) {                                                                             /* Creates an if that checks all fields to see if any were left empty */
            displayError($fieldName, "This field is required");                                          /* Outputs an error message if the input was not entered within any field that it was required */
            $retval = "";                                                                                /* Returns the value which would be an empty string */
         } else {                                                                                        /* Routes to the else statement if all fields were submitted with values and closes the if statement */
            $retval = trim($data);                                                                       /* Takes the data that was entered and removes the white space from around the entered data */
            $retval = stripslashes($retval);                                                             /* Takes the data and removes any backslashes within the inputted data */
            if ((strlen($retval)<4) || (strlen($retval)>7)) {                                            /* Creates an if statement to check the input and make sure it is between four to seven letters */
               displayError($fieldName, "Words must be at least
                                         four and at most seven
                                         letters long");                                                 /* Outputs an error message if the input is not between four to seven letters */
            }                                                                                            /* Closes the if statement */
            
            if (preg_match("/^[a-z]+$/i",$retval)==0) {                                                  /* Creates an if statement to check the input for any numbers */
               displayError($fieldName, "Words must be only letters");                                   /* Outputs an error if there are numbers within the input from the user */
            }                                                                                            /* Closes the if statement */
         }                                                                                               /* Closes the else statement */
         $retval = strtoupper($retval);                                                                  /* Takes the data and converts any lowercase letters to uppercase */
         $retval = str_shuffle($retval);                                                                 /* Takes the data and randomly shuffles all the characters within the data and rearranges them */
         return($retval);                                                                                /* Returns the value assigned to retval after all the changes have been made to the data */
      }                                                                                                  /* Closes the validateWord function */
      $errorCount = 0;                                                                                   /* Initializes error count and sets it to 0 */
      $words = array();                                                                                  /* Creates a new array named $words */
      
      $words[] = validateWord($_POST['Word1'], "Word 1");                                                /* Creates a space for Word 1 in the array and for the value when entered to be validated for acceptable input from the validateWord function */
      $words[] = validateWord($_POST['Word2'], "Word 2");                                                /* Creates a space for Word 2 in the array and for the value when entered to be validated for acceptable input from the validateWord function */
      $words[] = validateWord($_POST['Word3'], "Word 3");                                                /* Creates a space for Word 3 in the array and for the value when entered to be validated for acceptable input from the validateWord function */
      $words[] = validateWord($_POST['Word4'], "Word 4");                                                /* Creates a space for Word 4 in the array and for the value when entered to be validated for acceptable input from the validateWord function */

      if ($errorCount>0) {                                                                               /* Sets an if statement to check if any errors were encountered during the process */
         echo "Please use the \"Back\" button to re-enter the data.<br/>\n";                             /* Outputs an error message if the if statement is true and tells the user to go back and re-enter the data into the form */
      } else {                                                                                           /* Opens up an else statement for the successful output and closes the if statement */
         $wordNum = 0;                                                                                   /* Initializes the counter for the loop and sets it to 0 */
         foreach ($words as $word) {                                                                     /* Sets a foreach loop to process each number within the array and output the jumbled word to the user */
            echo "Word ".++$wordNum.": $word<br/>\n";                                                    /* Outputs the jumbled word for each word entered */
         }                                                                                               /* Closes the foreach loop arguments */
      }                                                                                                  /* Closes the else statement */
   ?>                                                                                                    <!-- Uses a closing php script delimiter to close the php script -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->