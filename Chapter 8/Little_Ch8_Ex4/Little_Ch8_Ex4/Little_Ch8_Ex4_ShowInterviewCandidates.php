<!--
   Author: Jonathon Little
   Date: 4/22/2020
   Purpose: Gets the data from the form and processes it to show all data on the candidate interview evaluations.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>Show Interview Information</title>                                                      <!-- Sets the title of the page to Show Interview Information -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <?php                                                                                          /* Utilizes a php script delimiter to open up the script for php */
   $DBConnect = @mysqli_connect("localhost", "root", "");                                         /* Attempts to connect to the database server */
   if ($DBConnect === FALSE) {                                                                    /* Checks if the connection to the database server failed */
      echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " .
      mysqli_errno() . ": " . mysqli_error() . "</p>";                                            /* Outputs an error message to the user if the database server failed to connect */
   } else {                                                                                       /* Routes to the else if the database connection was successful */
      $DBName = "candidates";                                                                     /* Creates a variable to hold the database name */
      if (!@mysqli_select_db($DBConnect, $DBName)) {                                              /* Checks to see if the database can't be selected */
         echo "<p>There are no entries for any interviews!</p>";                                  /* If there is no database or it wasn't selected, then it outputs a message that says there are no entries for any interviews */
      } else {                                                                                    /* Routes to the else if the database selects the database */
         $TableName = "interviewinfo";                                                            /* Creates a variable that holds the table name */
		 $SQLstring = "SELECT * FROM $TableName";                                                 /* Creates a variable to hold the query statement */
         $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                    /* Attempts to use the query on the table */
         if (mysqli_num_rows($QueryResult) == 0) {                                                /* Checks to see if the query returned any data */
            echo "<p>There are no entries for any interviews!</p>";                               /* Outputs a message to the user if there is no data in the table */
         } else {                                                                                 /* Routes to the else if there is data in the table */
            echo "<p>The following interview evaluations that have been submitted:</p>";          /* Outputs a message to the user which lets them know it is displaying the data for each candidate's interview evaluation */
            echo "<table width='100%' border='1'>";                                               /* Creates a table to display the data in */
            echo "<tr><th>Interviewer</th><th>Position</th><th>Date of Interview</th>
            <th>Candidate</th><th>Communication Abilities</th><th>Professional Appearance</th>
            <th>Computer Skills</th><th>Business Knowledge</th><th>Comments</th></tr>";           /* Inserts the headers for the table data into the table */
            while (($Row = mysqli_fetch_assoc($QueryResult)) !== FALSE) {                         /* Sets a while loop that will insert and display each value in the table data */
               echo "<tr><td>{$Row['interviewer_name']}</td>";                                    /* Displays the interviewer's name in the table data */
               echo "<td>{$Row['position']}</td>";                                                /* Displays the work position in the table data */
               echo "<td>{$Row['interview_date']}</td>";                                          /* Displays the interview date in the table data */
               echo "<td>{$Row['candidate_name']}</td>";                                          /* Displays the candidate's name in the table data */
               echo "<td>{$Row['comm_ability']}</td>";                                            /* Displays the description of the candidate's communication ability in the table data */
               echo "<td>{$Row['appearance']}</td>";                                              /* Displays whether or not the candidate had a professional appearance in the table data */
               echo "<td>{$Row['comp_skill']}</td>";                                              /* Displays the description of the candidate's computer skill in the table data */
               echo "<td>{$Row['bus_knowledge']}</td>";                                           /* Displays the description of the candidate's business knowledge in the table data */
               echo "<td>{$Row['comments']}</td></tr>";                                           /* Displays any extra comments about the candidate that the interviewer has made in the table data */
            }                                                                                     /* Closes the while loop */
            mysqli_free_result($QueryResult);                                                     /* Exits the result for the query */
         }                                                                                        /* Closes the else on line 29 */
      }                                                                                           /* Closes the else on line 23 */
      mysqli_close($DBConnect);                                                                   /* Closes the connection to the database */
   }                                                                                              /* Closes the else on line 19 */
   ?>                                                                                             <!-- Uses a closing php script delimiter to close the php script -->                                                                                            <!-- Closes the form -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->