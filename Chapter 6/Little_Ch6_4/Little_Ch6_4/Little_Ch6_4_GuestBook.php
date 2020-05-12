<!--
   Author: Jonathon Little
   Date: 4/02/2020
   Purpose: Stores visitor's names and e-mail adresses in a text file, 
            then allows users to see the guest book information displayed on the page.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                                     <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                                          <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                               <!-- Opens the head portion of the document -->
   <title>Guest Book</title>                                                                                         <!-- Sets the title of the page to Guest Book -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                                         <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                              <!-- Closes the head portion of the document -->
<body>                                                                                                               <!-- Opens the body portion of the document -->
   <h1>Guest Book</h1>                                                                                               <!-- Sets a header for the web page and sets it to Guest Book -->
   <?php                                                                                                             /* Utilizes a php script delimiter to open up the script for php */
      if (isset($_GET['action'])) {                                                                                  /* Sets an if that determines if an action was set and gets the action specified */
         if ((file_exists("guest-book.txt"))                                                                         /* Sets an if that checks to see if the guest-book.txt file exists */
            && (filesize("guest-book.txt") != 0)) {                                                                  /* Checks the file size of the guest-book.txt file */
            $GuestArray = file("guest-book.txt");                                                                    /* Sets the variable $GuestArray to the guest-book.txt file */
            switch ($_GET['action']) {                                                                               /* Gets the action that was performed from the form */
               case 'Remove Duplicates':                                                                             /* Sets a case statement for if the user selected to Remove Duplicates from the guest list */
                     $GuestArray = array_unique($GuestArray);                                                        /* Used to remove duplicate values from an array */
                     $GuestArray = array_values($GuestArray);                                                        /* Assigns the values received to an array with numeric values */
                  break;                                                                                             /* Breaks from the Remove Duplicates case */
               case 'Sort Ascending':                                                                                /* Sets a case statement for if the user selected to Sort the guest list in Ascending order */
                     sort($GuestArray);                                                                              /* Takes the values assigned in the array and sorts them */
                  break;                                                                                             /* Breaks from the Sort Ascending case */
            }                                                                                                        /* Closes the Switch statement */
            if (count($GuestArray) > 0) {                                                                            /* Sets an if statement that counts the values in $GuestArray and checks to see if the value is greater than 0 */
               $NewGuests = implode($GuestArray);                                                                    /* Sets the variable $NewGuests to be the new value that was from the joining elements of an array that were in string format */
               $GuestStore = fopen("guest-book.txt", "wb");                                                          /* Sets a resource for the guest-book.txt file that is opened */
               if ($GuestStore === false) {                                                                          /* Sets an if statement to check to see if the guest-book.txt file failed to open or assign itself to the resource */
                  echo "There was an error updating the guest file\n";                                               /* Outputs an error message to the user that tells the user that there was a problem updating the guest information */
               } else {                                                                                              /* Sets an else statement in the case that the resource succeeds in acquiring the guest-book.txt file */
                  fwrite($GuestStore, $NewGuests);                                                                   /* Writes to the resource which is the opened guest-book.txt file */
                  fclose($GuestStore);                                                                               /* Closes the guest-book.txt file */
               }                                                                                                     /* Closes the else statement */
            } else {                                                                                                 /* Sets an else statement */
               unlink("guest-book.txt");                                                                             /* Unlinks from the guest-book.txt file */
            }                                                                                                        /* Closes the else statement */
         }                                                                                                           /* Closes the if statement on line 17 */
      }                                                                                                              /* Closes the if statement on line 16 */
      if (isset($_POST['submit'])) {                                                                                 /* Sets an if to check the form after the submit button has been pressed and action has been taken */
         $GuestToAdd = "Name: ".stripslashes($_POST['GuestName']).
                       " | E-Mail: ".stripslashes($_POST['GuestEmail'])."\n";                                        /* Removes an slashes from the entered Guest Name and E-Mail and assigns it in a string format to $GuestToAdd */
         $ExistingGuests = array();                                                                                  /* Sets the variable $ExistingGuests to a new array */
         if (file_exists("guest-book.txt")
            && filesize("guest-book.txt") > 0) {                                                                     /* Sets an if statement that checks to see if the guest-book.txt file exists and the size of the file */
            $ExistingGuests = file("guest-book.txt");                                                                /* Sets the resource of $ExistingGuests to the guest-book.txt file */
         }                                                                                                           /* Closes the if statement */
         if (in_array($GuestToAdd, $ExistingGuests)) {                                                               /* Sets an if statement that checks whether any values exist in the array or not */
            echo "<p>The guest information you entered already exists!<br/>\n";                                      /* Outputs a message to the user that tells the user that the guest information they tried to enter already exists */
            echo "Your guest information was not added to the list.</p>";                                            /* Outputs a message to the user that tells the user that their guest information was not added to the list */
         } else {                                                                                                    /* Routes to the else statement if the guest information can be added to the list */
            $GuestFile = fopen("guest-book.txt", "ab");                                                              /* Opens the guest-book.txt file and assigns it to the resource of $GuestFile */
            if ($GuestFile === false) {                                                                              /* Sets an if statement to check to see if the resource successfully opened the guest-book.txt file */
               echo "There was an error saving your information!\n";                                                 /* Outputs an error message to the user that tells the user there was an error saving their guest information to the file */
            } else {                                                                                                 /* Sets an else if the resource was successful in opening the guest-book.txt file */
               fwrite($GuestFile, $GuestToAdd);                                                                      /* Writes or adds data to the guest-book.txt file */
               fclose($GuestFile);                                                                                   /* Closes the guest-book.txt file */
               echo "Your guest information has been added to the list.\n";                                          /* Outputs a message to the user that tells the user their guest information has been added to the list */
            }                                                                                                        /* Closes the else statement on line 60 */
         }                                                                                                           /* Closes the else statement on line 56 */
      }                                                                                                              /* Closes the if statement on line 46 */
	  if ((!file_exists("guest-book.txt"))
         || (filesize("guest-book.txt") == 0)) {                                                                     /* Sets an if statement that checks to see if the file exists as well as the size of the file */
         echo "<p>There is no guest information in the list.</p>\n";                                                 /* Outputs a message to the user that tells the user there is no guest information in the list */
      } else {                                                                                                       /* Routes to the else if there is guest information in the list */
         $GuestArray = file("guest-book.txt");                                                                       /* Sets the variable $GuestArray to the guest-book.txt file */
         echo "<table border=\"1\" width=\"100%\" style=\"background-color: #E0BBE4\">\n";                           /* Sets a table border and colors the table in a pastel purple color */
         foreach ($GuestArray as $Guest) {                                                                           /* Sets a foreach loop to display each value that was written in the guest-book.txt file */
            echo "<tr>\n";                                                                                           /* Opens the table row */
            echo "<td>".htmlentities($Guest)."</td>";                                                                /* Outputs the data to the table on the web page */
            echo "</tr>\n";                                                                                          /* Closes the table row */
         }                                                                                                           /* Closes the foreach loop */
         echo "</table>\n";                                                                                          /* Closes the table */
      }                                                                                                              /* Closes the else statement */
   ?>                                                                                                                <!-- Uses a closing php script delimiter to close the php script -->
   <p>                                                                                                               <!-- Opens a paragraph on the web page to display the links for the user to make modifications to the guest list -->
      <a href="Little_Ch6_4_GuestBook.php?action=Sort%20Ascending">Sort Guest List</a><br/>                          <!-- Sets a link for the option to have the guest list sorted -->
      <a href="Little_Ch6_4_GuestBook.php?action=Remove%20Duplicates">Remove Duplicate Guest Information</a><br/>    <!-- Sets a link for the option to have the guest list remove any duplicate guest information -->
   </p>                                                                                                              <!-- Closes the paragraph section on the web page -->
   <form action="Little_Ch6_4_GuestBook.php" method="post">                                                          <!-- Opens and creates a form for the user to be able to enter new guest information if desired -->
      <p>Add a New Guest</p>                                                                                         <!-- Outputs a heading to the user that asks them to Add a New Guest -->
      <p>Guest Name: <input type="text" name="GuestName"/></p>                                                       <!-- Sets an input for the user to be able to enter the guest name they wish to add -->
	  <p>Guest E-Mail: <input type="text" name="GuestEmail"/></p>                                                    <!-- Sets an input for the user to be able to enter the guest e-mail they wish to add -->
	  <p><input type="submit" name="submit" value="Add Guest to List"/>                                              <!-- Sets a submit button so the user can submit the guest information they desired to enter -->
      <input type="reset" name="reset" value="Reset Guest Information"/></p>                                         <!-- Sets a reset button to clear the entries in the input fields if the user changes their mind about adding the guest information they chose -->
   </form>                                                                                                           <!-- Closes the form -->
</body>                                                                                                              <!-- Closes the body portion of the document -->
</html>                                                                                                              <!-- Closes the document -->