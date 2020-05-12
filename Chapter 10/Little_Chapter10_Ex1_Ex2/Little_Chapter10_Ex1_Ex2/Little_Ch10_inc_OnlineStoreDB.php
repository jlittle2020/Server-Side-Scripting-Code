<!--
   Author: Jonathon Little
   Date: 4/26/2020
   Purpose: Connects the online store to a new instance of mysqli.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <?php                                                                                          /* Utilizes a php script delimiter to open the php script */
   $ErrorMsgs = array();                                                                          /* Initializes a new array by the name of $ErrorMsgs */
   $DBConnect = @new mysqli("localhost", "root", "", "online_stores");                            /* Connects a new instance of mysqli to the database server */
   if ($DBConnect->connect_errno) {                                                               /* Checks to see if the connection to the database server failed */
      $ErrorMsgs[] = "Unable to connect to the database server." .
      "Error code " . $DBConnect->connect_errno . ": " .
      $DBConnect->connect_error;                                                                  /* Outputs an error message if the connection to the database server failed */
   }                                                                                              /* Closes the if statement */
   ?>                                                                                             <!-- Utilizes a php script delimiter to close the php script -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->