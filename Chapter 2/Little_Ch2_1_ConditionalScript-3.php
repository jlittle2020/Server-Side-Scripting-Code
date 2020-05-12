<!--
   Author: Jonathon Little
   Date: 2/1/20
   Purpose: Using an if/else conditional to determine if $IntVariable is greater than or less than 100.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>Conditional Script</title>                                                                     <!-- Sets the title of the page to Conditional Script -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <?php                                                                                                 /* Uses a php script delimiter to open the code declaration block */
      $IntVariable = 75;                                                                                 /* Declares the variable $IntVariable to have the value of 75 */
      if ($IntVariable > 100) {                                                                          /* Creates a conditional statement to check if $IntVariable is less than or greater than 100 */
         $Result = '$IntVariable is greater than 100';                                                   /* Sets the statement for $Result if $IntVariable is greater than 100 */
      } else {                                                                                           /* Sets a secondary conditional statement if the $IntVariable is less than or equal to 100 */
         $Result = '$IntVariable is less than or equal to 100';                                          /* Sets the statement for $Result if $IntVariable is less than or equal to 100 */
      }                                                                                                  /* Closes the conditional statement that tests whether the $IntVariable is less than or greater than 100 */
      echo "<p>$Result</p>";                                                                             /* Displays the statement assigned to $Result */
   ?>                                                                                                    <!-- Uses a php script delimiter to close the code declaration block -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->