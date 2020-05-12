<!--
   Author: Jonathon Little
   Date: 2/1/20
   Purpose: Using a while loop to count and display the numbers 1-100.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>While Logic</title>                                                                            <!-- Sets the title of the page to While Logic -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <?php                                                                                                 /* Uses a php script delimiter to open the code declaration block */
      $Count = 1;                                                                                        /* Sets the variable $Count to the value of 1 */
      while ($Count <= 100) {                                                                            /* Creates a while conditional statement to append $Count until it is equal to 100 */
         $Numbers[] = $Count;                                                                            /* Sends the numbers from $Count into an array named Numbers */
         ++$Count;                                                                                       /* Adds one time to the value assigned to $Count */
      }                                                                                                  /* Repeats until $Count is equal to 100 and then closes the loop */
      foreach ($Numbers as $CurNum) {                                                                    /* Utilizes the foreach function loop to assign each number within the array to CurNum */
         echo "<p>$CurNum</p>";                                                                          /* Displays each number from CurNum each time on a new line*/
      }                                                                                                  /* Closes the foreach function loop */
   ?>                                                                                                    <!-- Uses a php script delimiter to close the code declaration block -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->