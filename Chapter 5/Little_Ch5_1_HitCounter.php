<!--
   Author: Jonathon Little
   Date: 3/19/2020
   Purpose: Creates a hit counter script that keeps track of the number of hits a Web page receives.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>Hit Counter</title>                                                                            <!-- Sets the title of the page to Hit Counter -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <?php                                                                                                 /* Utilizes a php script delimiter to open up the script for php */
      $CounterFile = "hitcount.txt";                                                                     /* Declares a variable named $CounterFile that contains the name of the file where the hits will be stored */

      if (file_exists($CounterFile)) {                                                                   /* Sets an if statement to check if the hitcount.txt file already exists */
         $Hits = file_get_contents($CounterFile);                                                        /* If the file does exist then it retrieves the value from the file */
         ++$Hits;                                                                                        /* Increments the value retrieved into $Hits and increments it by 1 */
      } else {                                                                                           /* Closes the if statement and sets an else statement in the event that the hitcount.txt file has not been created */
         $Hits = 1;                                                                                      /* Assigns a value of 1 to the $Hits variable */
      }                                                                                                  /* Closes the else statement */

      echo "<h1>There have been $Hits hits to this page.</h1>\n";                                        /* Outputs a message to the user on the page that displays how many times the page has been loaded or accessed */

      if (file_put_contents($CounterFile, $Hits)) {                                                      /* Sets an if statement to update the value in the hitcount.txt file or creates the file if it has not been created already and then updates it */
         echo "<p> The counter file has been updated.</p>\n";                                            /* Outputs a message to the user that displays that the hitcount.txt file has been updated */
      }                                                                                                  /* Closes the if statement */
   ?>                                                                                                    <!-- Uses a closing php script delimiter to close the php script -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->