<!--
   Author: Jonathon Little
   Date: 4/25/2020
   Purpose: Allows the user to request an internship at one of the available internships.
-->
<?php                                                                                             /* Uses a php delimiter to open up the php script */
session_start();                                                                                  /* Starts or opens a session in php */
$Body = "";                                                                                       /* Initializes the $Body variable and sets it to an empty string */
$errors = 0;                                                                                      /* Initializes the $errors variable for an error counter and sets it to 0 */
$InternID = 0;                                                                                    /* Initializes the $InternID variable and sets it to 0 */
if (!isset($_SESSION['internID'])) {                                                              /* Checks to see if the internID has been set */
   $Body .= "<p>You have not logged in or registered. " .
   " Please return to the " . " <a href='Little_Ch9_InternLogin.
   php'>Registration / " . " Log In page</a>.</p>";                                               /* Sets the $Body variable to display a message to the user that tells them to go back and register/log in */
   ++$errors;                                                                                     /* Increments the error counter by 1 */
}                                                                                                 /* Closes the if statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   if (isset($_GET['opportunityID'])) {                                                           /* Checks to see if the opportunityID has been set */
      $OpportunityID = $_GET['opportunityID'];                                                    /* If the opportunityID has been set, then sets the $OpportunityID variable to the opportunityID returned */
   } else {                                                                                       /* Routes to the else statement, if the opportunityID has not been set */
      $Body .= "<p>You have not selected an opportunity. " .
      " Please return to the " . " <a href='Little_Ch9_AvailableOpportunities.
      php?" . SID . "'>Available " . " Opportunities page</a>.</p>";                              /* Sets the $Body variable to display a message to the user that tells the user they have not selected an opportunity */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   }                                                                                              /* Closes the else statement */
}                                                                                                 /* Closes the if statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   $DBConnect = mysqli_connect("localhost","root", "");                                           /* Connects to the database server using root credentials */
   if ($DBConnect === FALSE) {                                                                    /* Checks to see if the database server connection failed */
      $Body .= "<p>Unable to connect to the database " . " server. Error code " .
      mysqli_errno() . ": " . mysqli_error() . "</p>\n";                                          /* Sets the $Body variable to display a message to the user that tells the user the database server failed to connect */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   } else {                                                                                       /* Routes to the else if the connection to the database server succeeded */
      $DBName = "internships";                                                                    /* Sets the variable $DBName to the database name of internships */
      $result = mysqli_select_db($DBConnect, $DBName);                                            /* Sets the $result variable to the result returned from the query */
      if ($result === FALSE) {                                                                    /* Checks to see if the connection to the database failed */
         $Body .= "<p>Unable to select the database. " . "Error code " .
         mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";                   /* Sets the $Body variable to display a message to the user which says that the database was unable to be selected */
         ++$errors;                                                                               /* Increments the error counter by 1 */
      }                                                                                           /* Closes the if statement */
   }                                                                                              /* Closes the else statement */
}                                                                                                 /* Closes the if statement */
$DisplayDate = date("l, F j, Y, g:i A");                                                          /* Sets the display date to the variable $DisplayDate */
$DatabaseDate = date("Y-m-d H:i:s");                                                              /* Sets the database date to the variable $DatabaseDate */
if ($errors == 0){                                                                                /* Checks to make sure there weren't any errors */
   $TableName = "assigned_opportunities";                                                         /* Sets the $TableName variable to the name of the table which is assigned_opportunities */
   $SQLstring = "INSERT INTO $TableName " . " (opportunityID, internID, " .
   " date_selected) VALUES " . " ($OpportunityID, " . $_SESSION['internID'] .
   ", '$DatabaseDate')";                                                                          /* Sets the $SQLstring variable to the query to insert data into the table */
   $QueryResult = mysqli_query($DBConnect, $SQLstring);                                           /* Sets the variable $QueryResult to the result of the query */
   if ($QueryResult === FALSE) {                                                                  /* Checks to see if the query failed */
      $Body .= "<p>Unable to execute the query. " . " Error code " .
      mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";                      /* Sets the $Body variable to display a message to the use that says the query failed to execute */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   } else {                                                                                       /* Routes to the else if the query was successful */
      $Body .= "<p>Your request for opportunity # " .
      " $OpportunityID has been entered " . " on $DisplayDate.</p>\n";                            /* Sets the $Body variable to display a message to the user that tells the user that their request for the opportunity has been entered */
   }                                                                                              /* Closes the else statement */
   mysqli_close($DBConnect);                                                                      /* Closes the database connection */
}                                                                                                 /* Closes the if statement */
if ($_SESSION['internID'] > 0) {                                                                  /* Checks the session internID to see if it is present */
   $Body .= "<p>Return to the <a href='" .
   "Little_Ch9_AvailableOpportunities.php?" . SID . "'>" .
   "Available Opportunities</a> page.</p>\n";                                                     /* Sets the $Body variable to display a message and link to the user for them to return to the available opportunities page */
} else {                                                                                          /* Routes to the else if there was no internID in the session */
   $Body .= "<p>Please <a href='Little_Ch9_InternLogin.php'>Register " .
   " or Log In</a> to use this page.</p>\n";                                                      /* Sets the $Body variable to display a message to the user which tells them to register or log in to view the page */
}                                                                                                 /* Closes the else statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   setcookie("LastRequestDate", $DisplayDate, time()+60*60*24*7);                                 /* Sets a cookie for the last request date for the user */
}                                                                                                 /* Closes the if statement */
?>                                                                                                <!-- Uses a php delimiter to close the php script -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>Request Opportunity</title>                                                             <!-- Sets the title of the page to Request Opportunity -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <h1>College Internship</h1>                                                                    <!-- Sets the h1 size header of the page to College Internship -->
   <h2>Opportunity Requested</h2>                                                                 <!-- Sets the h2 size header of the page to Opportunity Requested -->
   <?php                                                                                          /* Uses a php delimiter to open up the php script */
      echo $Body;                                                                                 /* Outputs the value assigned to $Body onto the web page */
   ?>                                                                                             <!-- Uses a php delimiter to close the php script -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->