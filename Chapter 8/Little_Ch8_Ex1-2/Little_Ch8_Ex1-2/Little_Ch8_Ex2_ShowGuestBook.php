<!--
   Author: Jonathon Little
   Date: 4/15/2020
   Purpose: Gets the data from the form and processes it to show every user's signature in the database.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                               <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                    <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                         <!-- Opens the head portion of the document -->
   <title>Guest Book Posts</title>                                                             <!-- Sets the title of the page to Guest Book Posts -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                   <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                        <!-- Closes the head portion of the document -->
<body>                                                                                         <!-- Opens the body portion of the document -->
   <?php                                                                                       /* Utilizes a php script delimiter to open up the script for php */
   $DBConnect = @mysqli_connect("localhost", "root", "");                                      /* Attempts to connect to the database server */
   if ($DBConnect === FALSE) {                                                                 /* Checks if the connection to the database server failed */
      echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " .
      mysqli_errno() . ": " . mysqli_error() . "</p>";                                         /* Outputs an error message to the user if the database server failed to connect */
   } else {                                                                                    /* Routes to the else if the database connection was successful */
      $DBName = "guestbook";                                                                   /* Creates a variable to hold the database name */
      if (!@mysqli_select_db($DBConnect, $DBName)) {                                           /* Checks to see if the database can't be selected */
         echo "<p>There are no entries in the guest book!</p>";                                /* If there is no database or it wasn't selected, then it outputs a message that says there are no entries in the guest book */
      } else {                                                                                 /* Routes to the else if the database selects the database */
         $TableName = "visitors";                                                              /* Creates a variable that holds the table name */
		 $SQLstring = "SELECT * FROM $TableName";                                              /* Creates a variable to hold the query statement */
         $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                 /* Attempts to use the query on the table */
         if (mysqli_num_rows($QueryResult) == 0) {                                             /* Checks to see if the query returned any data */
            echo "<p>There are no entries in the guest book!</p>";                             /* Outputs a message to the user if there is no data in the table */
         } else {                                                                              /* Routes to the else if there is data in the table */
            echo "<p>The following visitors have signed our guest book:</p>";                  /* Outputs a message to the user which lets them know it is displaying the users that have signed the guest book */
            echo "<table width='100%' border='1'>";                                            /* Creates a table to display the data in */
            echo "<tr><th>First Name</th><th>Last Name</th></tr>";                             /* Inserts the headers for the table data into the table */
            while (($Row = mysqli_fetch_assoc($QueryResult)) !== FALSE) {                      /* Sets a while loop that will insert and display each value in the table data */
               echo "<tr><td>{$Row['first_name']}</td>";                                       /* Displays the first name from the user in the table data */
               echo "<td>{$Row['last_name']}</td></tr>";                                       /* Displays the last name from the user in the table data */
            }                                                                                  /* Closes the while loop */
            mysqli_free_result($QueryResult);                                                  /* Exits the result for the query */
         }                                                                                     /* Closes the else on line 29 */
      }                                                                                        /* Closes the else on line 23 */
      mysqli_close($DBConnect);                                                                /* Closes the connection to the database */
   }                                                                                           /* Closes the else on line 19 */
   ?>                                                                                          <!-- Uses a closing php script delimiter to close the php script -->                                                                                            <!-- Closes the form -->
</body>                                                                                        <!-- Closes the body portion of the document -->
</html>                                                                                        <!-- Closes the file -->