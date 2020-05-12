<!--
   Author: Jonathon Little
   Date: 4/27/2020
   Purpose: Displays the ticket prices for different ages for a movie.
-->
<?php                                                                                             /* Utilizes a php script delimiter to open a php script */
session_start();                                                                                  /* Starts a session in mysqli */
require_once("Little_Ch10_Ex4_class_Movies.php");                                                 /* Requires the class page to get the class object for the page */
if (class_exists("Movies")) {                                                                     /* Checks to make sure the class exists */
   if (isset($_SESSION['moviePrices'])) {                                                         /* Checks if there is already a moviePrices session set */
      $MoviePrices = unserialize($_SESSION['moviePrices']);                                       /* If there is already a connection, then unserializes and opens that connection */
   } else {                                                                                       /* Routes to the else if there was not already a session running */
      $MoviePrices = new Movies();                                                                /* Starts a new class object session */
   }                                                                                              /* Closes the else statement */
} else {                                                                                          /* Routes to the else if the class object does not exist */
   echo "The Movies class is not available.";                                                     /* Outputs a message to the user that says the Movies class is not available */
   $MoviePrices = NULL;                                                                           /* Sets the $MoviePrices variable to NULL */
}                                                                                                 /* Closes the else statement */
?>                                                                                                <!-- Utilizes a php script delimiter to close the php script -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>Movie Ticket Prices</title>                                                             <!-- Sets the title of the page to Movie Ticket Prices -->
   <link rel="stylesheet" type="text/css" href="Little_Ch10_Ex4_MoviePrices.css"/>                <!-- Links a stylesheet to add some detail to the web page output -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <h1>Movie Ticket Prices</h1>                                                                   <!-- Sets a h1 size header with the name of Movie Ticket Prices -->
   <p>Here is our current list of movie ticket prices!</p>                                        <!-- Sets a paragraph message to the user -->
   <?php                                                                                          /* Utilizes a php script delimiter to open a php script */
   $MoviePrices->GetPriceList();                                                                  /* Calls the GetPriceList() function to get the data to return to the web page */
   $_SESSION['moviePrices'] = serialize($MoviePrices);                                            /* Serializes the connection and closes it */
   ?>                                                                                             <!-- Utilizes a php script delimiter to close the php script -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->