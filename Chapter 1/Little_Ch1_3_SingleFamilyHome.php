<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <!--
      Author: Jonathon Little
	  Date: 1/26/20
	  Purpose: Using the number_format() function to format the appearance of a number.
   -->
   <title>Single Family Home</title>                                                                     <!-- Sets the title of the page to Single Family Home -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <?php                                                                                                 /* Uses a php script delimiter to open the code declaration block */
      $SingleFamilyHome = 399500;                                                                        /* Assigns an integer value to the variable SingleFamilyHome */
      $SingleFamilyHome_Display = number_format($SingleFamilyHome, 2);                                   /* Formats the value assigned to SingleFamilyHome and then assigns the formatted number to SingleFamilyHome_Display */
      echo "<p>The current median price of a single family
            home in Pleasanton, CA is $$SingleFamilyHome_Display.</p>";                                  /* Displays the formatted number on the page along with the sentence */
   ?>                                                                                                    <!-- Uses a php script delimiter to close the code declaration block -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->