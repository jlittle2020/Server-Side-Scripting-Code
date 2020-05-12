<!--
   Author: Jonathon Little
   Date: 4/25/2020
   Purpose: Verifies the user Log In and logs the user in.
-->
<?php                                                                                             /* Uses a php delimiter to open up the php script */
session_start();                                                                                  /* Starts or opens a session in php */
?>                                                                                                <!-- Uses a php delimiter to close the php script -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>Verify Intern Login</title>                                                             <!-- Sets the title of the page to Verify Intern Login -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <h1>College Internship</h1>                                                                    <!-- Sets the h1 size header of the page to College Internship -->
   <h2>Verify Intern Login</h2>                                                                   <!-- Sets the h2 size header of the page to Verify Intern Login -->
   <?php                                                                                          /* Uses a php delimiter to open up the php script */
   $errors = 0;                                                                                   /* Initializes the $errors variable for an error counter and sets it to 0 */
   $DBConnect = @mysqli_connect("localhost", "root", "");                                         /* Connects to the database server using root credentials */
   if ($DBConnect === FALSE) {                                                                    /* Checks to see if the connection to the database server was unsuccessful */
      echo "<p>Unable to connect to the database server. " .
      "Error code " . mysqli_errno() . ": " . mysqli_error() .
      "</p>\n";                                                                                   /* If the connection was unsuccessful, then outputs an error message to the user that says the database connection was unsuccessful */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   } else {                                                                                       /* Routes to the else if the connection was successful */
      $DBName = "internships";                                                                    /* Sets the variable $DBName to retain the name of the database internships */
      $result = @mysqli_select_db($DBConnect, $DBName);                                           /* Sets the variable $result to the result of the query that selects the database to use */
      if ($result === FALSE) {                                                                    /* Checks to see if the connection to the database was unsuccessful */
         echo "<p>Unable to select the database. " .
         "Error code " . mysqli_errno($DBConnect) . ": " .
         mysqli_error($DBConnect) . "</p>\n";                                                     /* If the connection to the database failed, then outputs a message to the user that says the database failed to be selected */
         ++$errors;                                                                               /* Increments the error counter by 1 */
      }                                                                                           /* Closes the if statement */
   }                                                                                              /* Closes the else statement */
   $TableName = "interns";                                                                        /* Sets the variable $TableName to interns */
   if ($errors == 0) {                                                                            /* Checks to make sure there weren't any errors */
      $SQLstring = "SELECT internID, first, last FROM $TableName" .
      " where email='" . stripslashes($_POST['email']) . "' and
      password_md5='" . md5(stripslashes($_POST['password'])) . "'";                              /* Sets the variable $SQLstring to retain the query string that will get the data from the table and return it */
      $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                       /* Sets the variable $QueryResult to retain the result of the query */
      if (mysqli_num_rows($QueryResult) == 0) {                                                   /* Checks the rows of the data returned to see if there weren't any rows in the table */
         echo "<p>The e-mail address/password " . " combination entered
         is not valid.</p>\n";                                                                    /* Outputs an error message to the user that says the login input combination was invalid */
         ++$errors;                                                                               /* Increments the error counter by 1 */
      } else {                                                                                    /* Routes to the else if the returned rows were successful */
         $Row = mysqli_fetch_assoc($QueryResult);                                                 /* Sets the variable $Row to the returned data from the table */
         $_SESSION['internID'] = $Row['internID'];                                                /* Makes sure the internID in the session is equal to the internID in the row of data returned */
         $InternName = $Row['first'] . " " . $Row['last'];                                        /* Sets the variable $InternName to the first and last name of the intern that logged in */
         echo "<p>Welcome back, $InternName!</p>\n";                                              /* Outputs a message that welcomes back the user */
      }                                                                                           /* Closes the else statement */
   }                                                                                              /* Closes the if statement */
   if ($errors > 0) {                                                                             /* Checks to see if the errors were greater than 0 */
      echo "<p>Please use your browser's BACK button to return " .
      " to the form and fix the errors indicated.</p>\n";                                         /* Outputs a message to the user that tells them to utilize the BACK button to go back and fix the form for any errors */
   }                                                                                              /* Closes the if statement */
   if ($errors == 0) {                                                                            /* Checks to make sure there aren't any errors */
      echo "<p><a href='Little_Ch9_AvailableOpportunities.php?" .
      SID . "'>Available Opportunities</a></p>\n";                                                /* Outputs a message with a link for the returned user to go to the available intern opportunities */
   }                                                                                              /* Closes the if statement */
   ?>                                                                                             <!-- Uses a php delimiter to close the php script -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->