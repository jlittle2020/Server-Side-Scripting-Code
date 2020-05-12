<!--
   Author: Jonathon Little
   Date: 4/25/2020
   Purpose: Sets a cookie program that will store the date and time of the user's last visit to the web page.
-->
<?php                                                                                             /* Uses a php script delimiter to open the php script */
   if (isset($_COOKIE['lastVisit'])) {                                                            /* Sets an if to check if a cookie has been set already */
      $LastVisit = "<p>Your last visit was on " . $_COOKIE['lastVisit'];                          /* If a cookie has already been set previously, then displays the time and date of the last visit */
   } else {                                                                                       /* Routes to the else if the cookie has not been set previously */
      $LastVisit = "<p>This is your first visit!</p>\n";                                          /* If this is the cookie's first time being set, then displays that it is the first visit for the user */
   }                                                                                              /* Closes the else statement */
   setcookie("lastVisit", date("F j, Y, g:i a"), time()+60*60*24*365);                            /* Sets the cookie for the last visit the user made to the page */
?>                                                                                                <!-- Uses a php script delimiter to close the php script -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>Last Visit</title>                                                                      <!-- Sets the title of the page to Last Visit -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <?php echo $LastVisit; ?>                                                                      <!-- Displays the visitation information to the user on the web page from the cookie that was created when they last visited -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->