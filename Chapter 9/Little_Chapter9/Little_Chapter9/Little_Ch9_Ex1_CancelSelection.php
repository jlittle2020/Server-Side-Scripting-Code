<!--
   Author: Jonathon Little
   Date: 4/25/2020
   Purpose: Cancels a selection of an opportunity for internship that has been selected previously.
-->
<?php                                                                                             /* Uses a php delimiter to open up the php script */
session_start();                                                                                  /* Starts or opens a session in php */
$Body = "";                                                                                       /* Initializes the $Body variable and sets it to an empty string */
$errors = 0;                                                                                      /* Initializes the $errors variable for an error counter and sets it to 0 */
if (!isset($_SESSION['internID'])) {                                                              /* Checks to see if the internID has been set */
   $Body .= "<p>You have not logged in or registered." .
   " Please return to the " . "<a href='Little_Ch9_InternLogin.php'>
   Registration / " . " Log In page</a>.</p>\n";                                                  /* Sets the $Body variable to display a message to the user that tells the user that they have not logged in or registered */
   ++$errors;                                                                                     /* Increments the error counter by 1 */
}                                                                                                 /* Closes the if statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   if (isset($_GET['opportunityID'])) {                                                           /* Checks to see if the opportunityID has been set */
      $OpportunityID = $_GET['opportunityID'];                                                    /* If the opportunityID has been set, then sets the variable $OpportunityID to the opportunityID that was returned */
   } else {                                                                                       /* Routes to the else statement if the opportunityID if it has not been set */
      $Body .= "<p>You have not selected an opportunity. " .
      " Please return to the " . " <a href='Little_Ch9_AvailableOpportunities.php?" .
      SID . "'>Available Opportunities page</a>.</p>\n";                                          /* Sets the $Body variable to display a message to the user that they have not selected an opportunity and supplies a link to go back to choose an available opportunity */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   }                                                                                              /* Closes the else statement */
}                                                                                                 /* Closes the if statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   $DBConnect = mysqli_connect("localhost", "root", "");                                          /* Connects to the database server using the root credentials */
   if ($DBConnect === FALSE) {                                                                    /* Checks to see if the connection was unsuccessful */
      $Body .= "<p>Unable to connect to the database server. Error code " .
      mysqli_errno() . ": " . mysqli_error() . "</p>\n";                                          /* If the connection failed, then sets the $Body variable to display a message to the user which says the connection to the database server failed */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   } else {                                                                                       /* Routes to the else statement if the connection was successful */
      $DBName = "internships";                                                                    /* Sets the variable $DBName to the database name to be selected which is internships */
      $result = mysqli_select_db($DBConnect, $DBName);                                            /* Sets the variable $result to the result of the database connection */
      if ($result === FALSE) {                                                                    /* Checks to see if the connection failed */
         $Body .= "<p>Unable to select the database. Error code " .
         mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";                   /* If the connection failed, then sets the variable $Body to display a message to the user that tells the user the database failed to be selected */
         ++$errors;                                                                               /* Increments the error counter by 1 */
      }                                                                                           /* Closes the if statement */
   }                                                                                              /* Closes the else statement */
}                                                                                                 /* Closes the if statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   $TableName = "assigned_opportunities";                                                         /* Sets the variable $TableName to retain the name of the table assigned_opportunities */
   $SQLstring = "DELETE FROM $TableName WHERE opportunityID=$OpportunityID " .
   " AND internID=" . $_SESSION['internID'] . " AND date_approved IS NULL";                       /* Sets the variable $SQLstring to retain the query string to remove the user's selected opportunity from the database */
   $QueryResult = mysqli_query($DBConnect, $SQLstring);                                           /* Sets the variable $QueryResult to the result of the query */
   if ($QueryResult === FALSE) {                                                                  /* Checks to see if the query failed */
      $Body .= "<p>Unable to execute the query. Error code " .
      mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";                      /* If the query failed, then sets the $Body variable to display a message to the user that says the query failed to execute */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   } else {                                                                                       /* Routes to the else if the query succeeded */
      $AffectedRows = mysqli_affected_rows($DBConnect);                                           /* Sets the $AffectedRows variable to each affected row in the table */
      if ($AffectedRows == 0) {                                                                   /* Checks to see if there weren't any opportunities selected */
         $Body .= "<p>You had not previously selected opportunity # " .
         $OpportunityID . ".</p>\n";                                                              /* Sets the $Body variable to display a message to the user that says they haven't previously selected an opportunity */
      } else {                                                                                    /* Routes to the else if the user has selected an opportunity and had it canceled */
         $Body .= "<p>Your request for opportunity # " . " $OpportunityID has been " .
         " removed.</p>\n";                                                                       /* Sets the $Body variable to display a message to the user that says that the request for the opportunity they selected has been removed */
      }                                                                                           /* Closes the else statement */
   }                                                                                              /* Closes the else statement */
   mysqli_close($DBConnect);                                                                      /* Closes the database connection */
}                                                                                                 /* Closes the if statement */
if ($_SESSION['internID'] > 0) {                                                                  /* Checks to make sure that the session internID is active */
   $Body .= "<p>Return to the <a href='Little_Ch9_AvailableOpportunities.php?" .
   SID . "'>Available Opportunities</a> page.</p>\n";                                             /* Sets the $Body variable to display a message and link to the user that tells them to go back to the available opportunities page */
} else {                                                                                          /* Routes to the else statement if the user was not registered or logged in */
   $Body .= "<p>Please <a href='Little_Ch9_InternLogin.php'>Register " .
   " or Log In</a> to use this page.</p>\n";                                                      /* Sets the $Body variable to display a message to the user that tells them to register or log in to view the page */
}                                                                                                 /* Closes the else statement */
?>                                                                                                <!-- Uses a php delimiter to close the php script -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>Cancel Selection</title>                                                                <!-- Sets the title of the page to Cancel Selection -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <h1>College Internship</h1>                                                                    <!--  -->
   <h2>Cancel Selection</h2>                                                                      <!--  -->
   <?php                                                                                          /* Uses a php delimiter to open up the php script */
      echo $Body;                                                                                 /* Outputs the value assigned to $Body onto the web page */
   ?>                                                                                             <!-- Uses a php delimiter to close the php script -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->