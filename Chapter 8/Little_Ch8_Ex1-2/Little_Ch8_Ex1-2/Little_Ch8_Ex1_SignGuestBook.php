<!--
   Author: Jonathon Little
   Date: 4/15/2020
   Purpose: Gets the data from the form and processes it to put the user's signature into the database.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>Sign Guest Book</title>                                                                 <!-- Sets the title of the page to Sign Guest Book -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <?php                                                                                          /* Utilizes a php script delimiter to open up the script for php */
   if (empty($_POST['first_name']) || empty($_POST['last_name'])) {                               /* Checks the submitted inputs to ensure that they are not empty */
      echo "<p>You must enter your first and last name! Click your browser's
      Back button to return to the Guest Book form.</p>";                                         /* If the values for the submitted inputs are empty, then outputs an error message that tells the user to go back and fill in the necessary fields */
   } else {                                                                                       /* If all values have been entered, then routes to the else statement */
      $DBConnect = @mysqli_connect("localhost", "root", "");                                      /* Connects to the database */
      if ($DBConnect === FALSE) {                                                                 /* Checks to see if the connection to the database server failed */
         echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " .
         mysqli_errno() . ": " . mysqli_error() . "</p>";                                         /* If the database server failed to connect, then outputs an error message to the user that tells the user it failed to connect to the database server */
         $DBName = "guestbook";                                                                   /* Sets a variable that holds the name of the database and sets it to "guestbook" */
         if (!@mysqli_select_db($DBConnect, $DBName)) {                                           /* Checks to see if the database does not exist */
            $SQLstring = "CREATE DATABASE $DBName";                                               /* If the database does not exist, then it sets a variable that will hold the query statement to create the database */
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                 /* Commands a query statement to process by connecting to the database server and sending it the query that is held in the variable */
            if ($QueryResult === FALSE) {                                                         /* Checks to see if the Query failed */
               echo "<p>Unable to execute the query.</p>" . "<p>Error code " .
               mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";               /* If the query failed, then it sends an output message to the user that tells the user the query failed */
            } else {                                                                              /* If the query was successful, then it routes to the else statement */
               echo "<p>You are the first visitor!</p>";                                          /* Outputs a message to the user that alerts the user to them being the first visitor as the database has been created */
            }                                                                                     /* Closes the else statement */
         }                                                                                        /* Closes the if statement on line 24 */
         mysqli_select_db($DBConnect, $DBName);                                                   /* Selects the database */
         $TableName = "visitors";                                                                 /* Creates a variable that holds the name of the table which is "visitors" */
         $SQLstring = "SHOW TABLES LIKE '$TableName'";                                            /* Creates a variable that holds the statement for the query to be executed */
         $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                    /* Checks database for the table by using the query */
         if (mysqli_num_rows($QueryResult) == 0) {                                                /* Checks to see if any rows are returned from the query */
            $SQLstring = "CREATE TABLE $TableName(countID SMALLINT
            NOT NULL AUTO_INCREMENT PRIMARY KEY, last_name VARCHAR(40),
            first_name VARCHAR(40))";                                                             /* If no table data is returned, then it uses a query to create the table in the database */
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                 /* Attempts to connect to the table */
            if ($QueryResult === FALSE) {                                                         /* Checks to see if the query failed to execute */
               echo "<p>Unable to create the table.</p>" . "<p>Error code " . 
               mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";               /* Outputs an error message to the user that says that there was an error creating the table */
            }                                                                                     /* Closes the if statement */
         }                                                                                        /* Closes the if statement on line 38 */
         $LastName = stripslashes($_POST['last_name']);                                           /* Sets a variable to hold the value for last name */
         $FirstName = stripslashes($_POST['first_name']);                                         /* Sets a variable to hold the value for first name */
		 $SQLstring = "INSERT INTO $TableName VALUES(NULL, '$LastName', '$FirstName')";           /* Creates a query string to insert the values into the visitors table */
         $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                    /* Attempts to execute the query */
         if ($QueryResult === FALSE) {                                                            /* Checks to see if the query failed */
            echo "<p>Unable to execute the query.</p>" . "<p>Error code " .
            mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";                  /* Outputs an error message that says the query failed to execute */
         } else {                                                                                 /* Routes to the else statement if the query was successful */
            echo "<h1>Thank you for signing our guest book!</h1>";                                /* Outputs a message to the user that thanks the user for signing the guest book */
         }                                                                                        /* Closes the else */
      }                                                                                           /* Closes the else on line 18 */
      mysqli_close($DBConnect);                                                                   /* Closes the connection to the database */
   }                                                                                              /* Closes the if statement on line 15 */
   ?>                                                                                             <!-- Uses a closing php script delimiter to close the php script -->                                                                                            <!-- Closes the form -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->