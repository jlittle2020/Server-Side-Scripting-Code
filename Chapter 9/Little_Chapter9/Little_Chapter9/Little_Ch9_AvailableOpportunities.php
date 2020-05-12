<!--
   Author: Jonathon Little
   Date: 4/25/2020
   Purpose: Shows the available opportunities for internship.
-->
<?php                                                                                             /* Uses a php delimiter to open up the php script */
session_start();                                                                                  /* Starts or opens a session in php */
?>                                                                                                <!-- Uses a php delimiter to close the php script -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>Available Opportunities</title>                                                         <!-- Sets the title of the page to Available Opportunities -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <h1>College Internship</h1>                                                                    <!-- Sets the h1 size header of the page to College Internship -->
   <h2>Available Opportunities</h2>                                                               <!-- Sets the h2 size header of the page to Available Opportunities -->
   <?php                                                                                          /* Uses a php delimiter to open up the php script */
   if (isset($_COOKIE['LastRequestDate'])) {                                                      /* Checks to see if the LastRequestDate cookie was set */
      $LastRequestDate = $_COOKIE['LastRequestDate'];                                             /* Sets the $LastRequestDate variable to the cookie data */
   } else {                                                                                       /* Routes to the else statement if no cookie was set */
      $LastRequestDate = "";                                                                      /* Sets the $LastRequestDate variable to an empty string */
   }                                                                                              /* Closes the else statement */
   $errors = 0;                                                                                   /* Sets the $errors variable for an error counter to 0 */
   $DBConnect = mysqli_connect("localhost","root", "");                                           /* Connects to the database server with the root credentials */
   if ($DBConnect === FALSE) {                                                                    /* Checks to see if the connection to the database server failed */
      echo "<p>Unable to connect to the database server. " . "Error code " .
      mysqli_errno() . ": " . mysqli_error() . "</p>\n";                                          /* Outputs an error message to the user that says there was a failure connecting to the database server */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   } else {                                                                                       /* Routes to the else statement if the connection to the database server succeeded */
      $DBName = "internships";                                                                    /* Sets the $DBName variable to internships to retain the database name */
	  $result = mysqli_select_db($DBConnect, $DBName);                                            /* Sets the $result variable to the result of the query */
	  if ($result === FALSE) {                                                                    /* Checks to see if the database failed to be selected */
         echo "<p>Unable to select the database. " . "Error code " .
         mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";                   /* Outputs an error message to the user that says the database was unable to be selected */
         ++$errors;                                                                               /* Increments the error counter by 1 */
	  }                                                                                           /* Closes the if statement */
   }                                                                                              /* Closes the else statement */
   $TableName = "interns";                                                                        /* Sets the $TableName to the name of the table interns */
   if ($errors == 0) {                                                                            /* Checks to make sure there weren't any errors */
      $SQLstring = "SELECT * FROM $TableName WHERE " .
      " internID='" . $_SESSION['internID'] . "'";                                                /* Sets the variable $SQLstring to the query to be executed */
      $QueryResult = mysqli_query($DBConnect, $SQLstring);                                        /* Sets the variable $QueryResult to the result of the query that was executed */
      if ($QueryResult === FALSE) {                                                               /* Checks to see if the query failed */
         echo "<p>Unable to execute the query. " . "Error code " .
         mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";                   /* If the query failed, then sends an error message to the user that says the query failed to execute */
         ++$errors;                                                                               /* Increments the error counter by 1 */
      } else {                                                                                    /* Routes to the else if the query succeeded */
         if (mysqli_num_rows($QueryResult) == 0) {                                                /* Checks to see if no rows were returned by the query */
            echo "<p>Invalid Intern ID!</p>";                                                     /* If no rows were returned, then outputs an error message to the user that says the intern ID is invalid */
            ++$errors;                                                                            /* Increments the error counter by 1 */
         }                                                                                        /* Closes the if statment */
      }                                                                                           /* Closes the else statement */
   }                                                                                              /* Closes the if statement */
   if ($errors == 0) {                                                                            /* Checks to make sure there weren't any errors */
      $Row = mysqli_fetch_assoc($QueryResult);                                                    /* Sets the $Row to the data returned */
      $InternName = $Row['first'] . " " . $Row['last'];                                           /* Sets $InternName to the first and last name entered for the intern */
   } else {                                                                                       /* Routes to the else if there were errors */
      $InternName = "";                                                                           /* Sets the $InternName variable to an empty string */
   }                                                                                              /* Closes the else statement */
   $TableName = "assigned_opportunities";                                                         /* Sets the $TableName variable to the name of the table which is assigned_opportunities */
   $ApprovedOpportunities = 0;                                                                    /* Sets $ApprovedOpportunities to the value of 0 */
   $SQLstring = "SELECT COUNT(opportunityID) FROM $TableName " .
   " WHERE internID='" . $_SESSION['internID'] . "' " . " AND date_approved IS NOT NULL";         /* Sets $SQLstring to the query to execute */
   $QueryResult = mysqli_query($DBConnect, $SQLstring);                                           /* Sets the result of the query to $QueryResult */
   if (mysqli_num_rows($QueryResult) > 0) {                                                       /* Checks to see if any rows of data were returned */
      $Row = mysqli_fetch_row($QueryResult);                                                      /* Gets each row from the query executed and sets it to the $Row */
      $ApprovedOpportunities = $Row[0];                                                           /* Inserts the row data into $ApprovedOpportunities */
      mysqli_free_result($QueryResult);                                                           /* Frees the result after the iterations of the query has ran through */
   }                                                                                              /* Closes the if statement */
   $SelectedOpportunities = array();                                                              /* Sets a new array by the name of $SelectedOpportunities */
   $SQLstring = "SELECT opportunityID FROM $TableName " .
   " WHERE internID='" . $_SESSION['internID'] . "'";                                             /* Sets the $SQLstring to the query to be executed */
   $QueryResult = mysqli_query($DBConnect, $SQLstring);                                           /* Sets the $QueryResult to the result returned by executing the query */
   if (mysqli_num_rows($QueryResult) > 0) {                                                       /* Checks to see if any rows of data were returned */
      while (($Row = mysqli_fetch_row($QueryResult)) !== NULL) {                                  /* Sets a while loop to get each row of data */
         $SelectedOpportunities[] = $Row[0];                                                      /* Puts each row of data into the $SelectedOpportunities array */
      }                                                                                           /* Closes the while loop */
	  mysqli_free_result($QueryResult);                                                           /* Frees the result after all iterations have ran through */
   }                                                                                              /* Closes the if statement */
   $AssignedOpportunities = array();                                                              /* Sets a new array by the name of $AssignedOpportunities */
   $SQLstring = "SELECT opportunityID FROM $TableName " .
   " WHERE date_approved IS NOT NULL";                                                            /* Sets the $SQLstring variable to hold the query to execute */
   $QueryResult = mysqli_query($DBConnect, $SQLstring);                                           /* Sets the result to be retained by $QueryResult */
   if (mysqli_num_rows($QueryResult) > 0) {                                                       /* Checks to see if any rows were returned by the query */
      while (($Row = mysqli_fetch_row($QueryResult)) !== NULL) {                                  /* Sets a while loop to return each row of data */
         $AssignedOpportunities[] = $Row[0];                                                      /* Sets each row of data from the result into the array */
      }                                                                                           /* Closes the while loop */
      mysqli_free_result($QueryResult);                                                           /* Frees the result after all iterations have ran through */
   }                                                                                              /* Closes the if statement */
   $TableName = "opportunities";                                                                  /* Sets the $TableName variable to opportunities */
   $Opportunities = array();                                                                      /* Sets $Opportunities to an array */
   $SQLstring = "SELECT opportunityID, company, city, " .
   " start_date, end_date, position, description " .
   " FROM $TableName";                                                                            /* Sets the $SQLstring to the query to be executed in the database */
   $QueryResult = mysqli_query($DBConnect, $SQLstring);                                           /* Sets the result of the query to $QueryResult */
   if (mysqli_num_rows($QueryResult) > 0) {                                                       /* Checks to see if the query returned any rows */
      while (($Row = mysqli_fetch_assoc($QueryResult)) !== NULL) {                                /* Sets a while loop to get each row of opportunities */
         $Opportunities[] = $Row;                                                                 /* Sets each row of opportunities in the array */
      }                                                                                           /* Closes the while loop */
	  mysqli_free_result($QueryResult);                                                           /* Frees the result after all iterations have ran through */
   }                                                                                              /* Closes the if statement */
   mysqli_close($DBConnect);                                                                      /* Closes the database connection */
   if (!empty($LastRequestDate)) {                                                                /* Checks to see if the LastRequestDate cookie is empty */
      echo "<p>You last requested an internship opportunity " .
      " on $LastRequestDate.</p>\n";                                                              /* Outputs the last requested internship opportunity date and time the user made to the user */
   }                                                                                              /* Closes the if statement */
   echo "<table border='1' width='100%'>\n";                                                      /* Sets a border for the headers in the table */
   echo "<tr>\n";                                                                                 /* Opens the table row for the headers */
   echo "<th style='background-color:cyan'>Company</th>\n";                                       /* Sets a table header to Company */
   echo "<th style='background-color:cyan'>City</th>\n";                                          /* Sets a table header to City */
   echo "<th style='background-color:cyan'>Start Date</th>\n";                                    /* Sets a table header to Start Date */
   echo "<th style='background-color:cyan'>End Date</th>\n";                                      /* Sets a table header to End Date */
   echo "<th style='background-color:cyan'>Position</th>\n";                                      /* Sets a table header to Position */
   echo "<th style='background-color:cyan'>Description</th>\n";                                   /* Sets a table header to Description */
   echo "<th style='background-color:cyan'>Status</th>\n";                                        /* Sets a table header to Status */
   echo "</tr>\n";                                                                                /* Closes the table row for the headers */
   foreach ($Opportunities as $Opportunity) {                                                     /* Sets a foreach loop to output each row of data for each opportunity */
      if (!in_array($Opportunity['opportunityID'], $AssignedOpportunities)) {                     /* Checks to see the opportunities in the array */
         echo "<tr>\n";                                                                           /* Opens the table row */
         echo "<td>" . htmlentities($Opportunity['company']) . "</td>\n";                         /* Displays the company of the opportunity in the table data */
		 echo "<td>" . htmlentities($Opportunity['city']) . "</td>\n";                            /* Displays the city of the opportunity in the table data */
		 echo "<td>" . htmlentities($Opportunity['start_date']) . "</td>\n";                      /* Displays the start date of the opportunity in the table data */
		 echo "<td>" . htmlentities($Opportunity['end_date']) . "</td>\n";                        /* Displays the end date of the opportunity in the table data */
		 echo "<td>" . htmlentities($Opportunity['position']) . "</td>\n";                        /* Displays the position of the opportunity in the table data */
		 echo "<td>" . htmlentities($Opportunity['description']) . "</td>\n";                     /* Displays the description of the opportunity in the table data */
		 echo "<td>";                                                                             /* Opens another table data portion of the table */
		 if (in_array($Opportunity['opportunityID'], $SelectedOpportunities)) {                   /* Checks to see if any of the opportunities are selected */
            echo "Selected<br/><a href='Little_Ch9_Ex1_CancelSelection.php?" .
            SID . "&opportunityID=" . $Opportunity['opportunityID'] .
            "'>Cancel Selection</a>";                                                             /* Outputs selected to the user and displays an option that will cancel the request if clicked on */
		 } else {                                                                                 /* Routes to the else for a different output on the selection page if it has not been selected */
            if ($ApprovedOpportunities > 0) {                                                     /* Checks to see if approved opportunities are greater than 0 */
               echo "Open";                                                                       /* Outputs open to the web page */
            } else {                                                                              /* Routes to the else statement if an opportunity hasn't been selected */
               echo "<a href='Little_Ch9_RequestOpportunity.php?" . SID .
               "&opportunityID=" . $Opportunity['opportunityID'] . "'>Available</a>";             /* Sets a link for the user to click on that will select the opportunity and request it */
            }                                                                                     /* Closes the else statement */
		 }                                                                                        /* Closes the else statement */
         echo "</td>\n";                                                                          /* Closes the table data */
		 echo "</tr>\n";                                                                          /* Closes the table row */
      }                                                                                           /* Closes the if statement */
   }                                                                                              /* Closes the foreach loop */
   echo "</table>\n";                                                                             /* Closes the table on the web page */
   echo "<p><a href='Little_Ch9_InternLogin.php'>Log Out</a></p>\n";                              /* Sets a Log Out option for the logged in user */
   ?>                                                                                             <!-- Uses a php delimiter to close the php script -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->