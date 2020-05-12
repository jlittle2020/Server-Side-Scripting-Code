<!--
   Author: Jonathon Little
   Date: 4/27/2020
   Purpose: Sets a class object to contain fields, methods, and functions for the web page to utilize.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <?php                                                                                          /* Utilizes a php script delimiter to open a php script */
   class Movies {                                                                                 /* Opens a new class object by the name of Movies */
      private $DBConnect = NULL;                                                                  /* Sets a private $DBConnect field and sets it to NULL */
      private $age = 0;                                                                           /* Sets a private $age field and sets it to 0 */
	  private $BasePrice = 10;                                                                    /* Sets a private $BasePrice field and sets it to 10 */
      function __construct() {                                                                    /* Opens a function named __construct */
         include("Little_Ch10_Ex4_inc_Movies.php");                                               /* Includes the Little_Ch10_Ex4_inc_Movies.php file */
         $this->DBConnect = $DBConnect;                                                           /* Sets the current $DBConnect field to equal the $DBConnect on the file */
      }                                                                                           /* Closes the __construct() function */
      function __destruct() {                                                                     /* Opens a function named __destruct */
         if ($this->DBConnect->connect_error) {                                                   /* Checks to see if there was an error with the connection to the database server */
            $this->DBConnect->close();                                                            /* If there was an error with the connection, then closes the connection */
         }                                                                                        /* Closes the if statement */
      }                                                                                           /* Closes the __destruct() function */
      function __wakeup() {                                                                       /* Opens a function named __wakeup */
         include("Little_Ch10_Ex4_inc_Movies.php");                                               /* Includes the Little_Ch10_Ex4_inc_Movies.php file */
         $this->DBConnect = $DBConnect;                                                           /* Sets the current $DBConnect field to equal the $DBConnect on the file */
      }                                                                                           /* Closes the __wakeup() function */
	  public function SetAge($age) {                                                              /* Opens a function by the name of SetAge */
         $this->age=round($age);                                                                  /* Sets the object's age field to the age value given in the variable $age */
	  }                                                                                           /* Closes the SetAge($age) function */
      public function GetPrice() {                                                                /* Opens a function by the name of GetPrice */
         $retval = 0;                                                                             /* Initializes the variable $retval and sets it to 0 */
         if($this->age < 5) {                                                                     /* Checks to see if age is less than 5 */
            $retval = 0;                                                                          /* If the age is less than 5, then sets the $retval variable to 0 */
         } else if ($this->age < 18) {                                                            /* Checks to see if age is less than 18 */
            $retval = ($this->BasePrice / 2);                                                     /* If the age is less than 18, then sets the $retval to half the base price */
		 } else if ($this->age > 55) {                                                            /* Checks to see if age is greater than 55 */
            $retval = ($this->BasePrice - 2);                                                     /* If the age is greater than 55, then sets the $retval to base price minus 2 */
		 } else {                                                                                 /* Sets an else statement */
            $retval = $this->BasePrice;                                                           /* Sets $retval to the the current object's base price */
		 }                                                                                        /* Closes the else statement */
         return($retval);                                                                         /* returns the value assigned to $retval */
      }                                                                                           /* Closes the GetPrice() function */
      public function GetPriceList() {                                                            /* Opens a function by the name of GetPriceList */
         $retval = FALSE;                                                                         /* Initializes the $retval variable and sets it to FALSE */
         echo "<table cellspacing='0' cellpadding='0' align='left'>\n";                           /* Opens a table aligned to the left and sets the cell spacing and padding to 0 */
         echo "<tr><th>Age</th><th>Price</th></tr>\n";                                            /* Sets the table headers to age and price */
		 echo "<tr><td>Under 5</td><td>Free</td></tr>\n";                                         /* Sets the row to be outputted for ages under 5 */
         echo "<tr><td>5 to 17</td><td>Half price</td></tr>\n";                                   /* Sets the row to be outputted for ages 5 to 17 */
         echo "<tr><td>18 to 55</td><td>Full price</td></tr>\n";                                  /* Sets the row to be outputted for ages 18 to 55 */
         echo "<tr><td>Over 55</td><td>$2 off</td></tr>\n";                                       /* Sets the row to be outputted for ages over 55 */
         echo "</table>";                                                                         /* Closes the table */
         echo"<table cellspacing='0' cellpadding='0' align='right'>\n";                           /* Opens a table aligned to the right and sets the cell spacing and padding to 0 */
         echo "<tr><th>Age</th><th>Price</th></tr>\n";                                            /* Sets the table headers to age and price */
         echo "<tr><td>Under 5</td>";                                                             /* Sets the first column in the first row name to be under 5 */
         printf("<td>$%.2f</td></tr>\n", $this->GetPrice($this->SetAge(3)));                      /* Sets the price of the ticket for ages under 5 in the second column first row */
         echo "<tr><td>5 to 17</td>";                                                             /* Sets the first column in the second row name to be 5 to 17 */
         printf("<td>$%.2f</td></tr>\n", $this->GetPrice($this->SetAge(12)));                     /* Sets the price of the ticket for ages 5 to 17 in the second column second row */
         echo "<tr><td>18 to 55</td>";                                                            /* Sets the first column in the third row name to be 18 to 55 */
         printf("<td>$%.2f</td></tr>\n", $this->GetPrice($this->SetAge(45)));                     /* Sets the price of the ticket for ages 18 to 55 in the second column third row */
         echo "<tr><td>Over 55</td>";                                                             /* Sets the first column in the fourth row name to be over 55 */
         printf("<td>$%.2f</td></tr>\n", $this->GetPrice($this->SetAge(70)));                     /* Sets the price of the ticket for ages over 55 in the second column fourth row */
         echo "</table>";                                                                         /* Closes the table */
         $retval = TRUE;                                                                          /* Sets the $retval variable to TRUE */
      }                                                                                           /* Closes the GetPriceList() function */
   }                                                                                              /* Closes the class object */
   ?>                                                                                             <!-- Utilizes a php script delimiter to close the php script -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->