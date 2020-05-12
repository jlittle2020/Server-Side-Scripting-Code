<!--
   Author: Jonathon Little
   Date: 4/25/2020
   Purpose: Verifies a user's registered information and provides them with a new Log In id once registered into the system.
-->
<?php                                                                                             /* Uses a php delimiter to open up the php script */
session_start();                                                                                  /* Starts or opens a session in php */
$Body = "";                                                                                       /* Initializes a variable by the name of $Body and sets it to an empty string */
$errors = 0;                                                                                      /* Initializes a variable that will act as an error counter by the name of $errors and sets it to 0 */
$email = "";                                                                                      /* Initializes a variable by the name of $email and sets it to an empty string */
if (empty($_POST['email'])) {                                                                     /* Checks to see if the input for the e-mail address was empty when submitted */
   ++$errors;                                                                                     /* If it was empty, then increment the error counter by 1 */
   $Body .= "<p>You need to enter an e-mail address.</p>\n";                                      /* Sets the $Body variable to a string that will tell the user to enter an e-mail address */
} else {                                                                                          /* Routes to the else if the e-mail address was entered */
   $email = stripslashes($_POST['email']);                                                        /* Sets the entered e-mail address to the variable $email */
   if (preg_match("/^[\w-]+(\.[\w-]+)*@" .
      "[\w-]+(\.[\w-]+)*(\.[a-zA-Z]{2,})$/i",
      $email) == 0) {                                                                             /* Validates the entered e-mail to see if it is a valid e-mail address */
      ++$errors;                                                                                  /* If the e-mail address is not valid, then increment the error counter by 1 */
      $Body .= "<p>You need to enter a valid " .
      "e-mail address.</p>\n";                                                                    /* Sets the $Body variable to a string that will tell the user the e-mail address entered was not valid */
      $email = "";                                                                                /* Sets the $email variable to an empty string */
   }                                                                                              /* Closes the if statement */
}                                                                                                 /* Closes the else statement */
if (empty($_POST['password'])) {                                                                  /* Sets an if statement to check if the password input was empty */
   ++$errors;                                                                                     /* If the password input was empty, then increment the error counter by 1 */
   $Body .= "<p>You need to enter a password.</p>\n";                                             /* Sets the $Body variable to a string that will tell the user to enter a password */
   $password = "";                                                                                /* Sets the $password variable to an empty string */
} else {                                                                                          /* Routes to the else statement if a password was supplied */
   $password = stripslashes($_POST['password']);                                                  /* Sets the $password to the entered value */
}                                                                                                 /* Closes the else statement */
if (empty($_POST['password2'])) {                                                                 /* Sets an if statement that will check the confirmation password input to see if it is empty */
   ++$errors;                                                                                     /* If the confirmation password input was empty, then increment the error counter by 1 */
   $Body .= "<p>You need to enter a confirmation password.</p>\n";                                /* Sets the $Body variable to a string that tells the user to enter a confirmation password */
   $password2 = "";                                                                               /* Sets the variable $password2 to an empty string */
} else {                                                                                          /* Routes to the else statement if the confirmation password was supplied in the input */
   $password2 = stripslashes($_POST['password2']);                                                /* Sets the variable $password2 to the entered confirmation password */
}                                                                                                 /* Closes the else statement */
if ((!(empty($password))) && (!(empty($password2)))) {                                            /* Checks to see if either $password or $password2 is empty */
   if (strlen($password) < 6) {                                                                   /* Checks the length of the entered password to make sure that it is greater than 6 characters */
      ++$errors;                                                                                  /* If the password is less than 6 characters, then increment the error counter by 1 */
      $Body .= "<p>The password is too short.</p>\n";                                             /* Sets the $Body variable to a string which tells the user that the password entered is too short */
      $password = "";                                                                             /* Sets $password to an empty string */
      $password2 = "";                                                                            /* Sets $password2 to an empty string */
   }                                                                                              /* Closes the if statement */
   if ($password <> $password2) {                                                                 /* Checks to make sure that the password is equal to the confirmation password */
      ++$errors;                                                                                  /* If the passwords are not equal, increment the error counter by 1 */
      $Body .= "<p>The passwords do not match.</p>\n";                                            /* Sets the $Body variable to a string which tells the user that the passwords do not match */
      $password = "";                                                                             /* Sets $password to an empty string */
      $password2 = "";                                                                            /* Sets $password2 to an empty string */
   }                                                                                              /* Closes the if statement */
}                                                                                                 /* Closes the if statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   $DBConnect = @mysqli_connect("localhost", "root", "");                                         /* Connects to the database server using login credentials from root */
   if ($DBConnect === FALSE) {                                                                    /* Checks to see if the database server connection failed */
      $Body .= "<p>Unable to connect to the database server. " .
      "Error code " . mysqli_errno() . ": " . mysqli_error() .
      "</p>\n";                                                                                   /* If the database connection failed, then sets the $Body variable to display a message that says the database server failed to connect */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   } else {                                                                                       /* Routes to the else if the connection was successful */
      $DBName = "internships";                                                                    /* Sets a variable $DBName to internships */
      $result = @mysqli_select_db($DBConnect, $DBName);                                           /* Sets a variable $result to the result of running the query to connect to the database */
      if ($result === FALSE) {                                                                    /* Checks to see if the $result indicated an unsuccessful connection to the database */
         $Body .= "<p>Unable to select the database. " .
         "Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) .
         "</p>\n";                                                                                /* If the connection to the database failed, then sets the $Body variable to display a message to the user that says the database failed to be selected */
         ++$errors;                                                                               /* Increments the error counter by 1 */
      }                                                                                           /* Closes the if statement */
   }                                                                                              /* Closes the else statement */
}                                                                                                 /* Closes the if statement */
$TableName = "interns";                                                                           /* Sets the variable $TableName to interns */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   $SQLstring = "SELECT count(*) FROM $TableName" . "where email=$email";                         /* Sets a query to get the count of all e-mail addresses in the database */
   $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                          /* Sets the result of the query to $QueryResult */
   if ($QueryResult !== FALSE) {                                                                  /* Checks to see if the Query Result was successful */
      $Row = mysqli_fetch_row($QueryResult);                                                      /* Returns every row that was returned by the query */
      if ($Row[0]>0) {                                                                            /* Checks to see if any rows occur more than once */
         $Body .= "<p>The email address entered (" .
         htmlentities($email) . ") is already registered.</p>\n";                                 /* If their are duplicate e-mails, then sets the $Body variable to display a message that tells the user the e-mail has already been used to register */
         ++$errors;                                                                               /* Increments the error counter by 1 */
      }                                                                                           /* Closes the if statement */
   }                                                                                              /* Closes the if statement */
}                                                                                                 /* Closes the if statement */
if ($errors > 0) {                                                                                /* Checks to see if there were any errors */
   $Body .= "<p>Please use your browser's BACK button to return" .
   " to the form and fix the errors indicated.</p>\n";                                            /* Sets the $Body variable to a string that will tell the user to utilize the BACK button to go back to the form and fix any errors */
}                                                                                                 /* Closes the if statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   $first = stripslashes($_POST['first']);                                                        /* Sets the $first variable to the first name of the registered intern */
   $last = stripslashes($_POST['last']);                                                          /* Sets the $last variable to the last name of the registered intern */
   $SQLstring = "INSERT INTO $TableName " . " (first, last, email, password_md5) " .
   " VALUES('$first', '$last', '$email', " . " '" . md5($password) . "')";                        /* Sets a query to insert the newly entered values into the table in the database */
   $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                          /* Gets the result of the query */
   if ($QueryResult === FALSE) {                                                                  /* Checks to see if the query was unsuccessful */
      $Body .= "<p>Unable to save your registration " . " information. Error code " .
      mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";                      /* If the query was unsuccessful, then sets the $Body variable to display a message to the user that says their information failed to be saved to the database */
      ++$errors;                                                                                  /* Increments the error counter by 1 */
   } else {                                                                                       /* Routes to the else statement if the query was successful */
      $_SESSION['internID'] = mysqli_insert_id($DBConnect);                                       /* Gets the InternID which is set to the session and inserts it */
   }                                                                                              /* Closes the else statement */
   mysqli_close($DBConnect);                                                                      /* Closes the connection to the database */
}                                                                                                 /* Closes the if statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   $InternName = $first . " " . $last;                                                            /* Sets the variable $InternName to the first and last name of the newly registered intern */
   $Body .= "<p>Thank you, $InternName. ";                                                        /* Sets the $Body variable to output a thank you message to the user that registered and display their name */
   $Body .= "Your new Intern ID is <strong>" . $_SESSION['internID'] . "</strong>.</p>\n";        /* Sets the $Body variable to display the InternID to the user that registered */
}                                                                                                 /* Closes the if statement */
if ($errors == 0) {                                                                               /* Checks to make sure there weren't any errors */
   $Body .= "<p><a href='Little_Ch9_AvailableOpportunities.php?" .
   SID . "'>View Available Opportunities</a></p>\n";                                              /* If there are no errors, then sets the $Body variable to a string that supplies a link to the available opportunities for the newly registered intern */
}                                                                                                 /* Closes the if statement */
setcookie("internID", $InternID);                                                                 /* Sets a cookie that retains the InternID */
?>                                                                                                <!-- Uses a php delimiter to close the php script -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>Intern Registration</title>                                                             <!-- Sets the title of the page to Intern Registration -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <h1>College Internship</h1>                                                                    <!-- Sets the header of the page to h1 size and to College Internship -->
   <h2>Intern Registration</h2>                                                                   <!-- Sets another header on the page to h2 size and to Intern Registration -->
   <?php                                                                                          /* Uses a php delimiter to open up the php script */
   echo $Body;                                                                                    /* Outputs the value assigned to $Body onto the web page */
   ?>                                                                                             <!-- Uses a php delimiter to close the php script -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->