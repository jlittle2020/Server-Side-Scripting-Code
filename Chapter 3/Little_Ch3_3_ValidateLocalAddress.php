<!--
   Author: Jonathon Little
   Date: 2/21/20
   Purpose: Determines whether an E-Mail Address is valid or not valid.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>Validate Local Address</title>                                                                 <!-- Sets the title of the page to Validate Local Address -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <h1>Validate Local Address</h1><hr/>                                                                  <!-- Sets a header for the web page to Validate Local Address and sets a horizontal line to separate the header from the output -->
   <?php                                                                                                 /* Uses a php script delimiter to open the code declaration block */
      $email = array(                                                                                    /* Creates an array with the name of email and gives it the values to add to the array */
         "jsmith123@example.org",
         "john.smith.mail@example.org",
         "john.smith@example.org",
         "john.smith@example",
         "jsmith123@mail.example.org");
      foreach ($email as $emailAddress) {                                                                /* Sets a loop for each array value */
         echo "The email address &ldquo;" . $emailAddress .
              "&rdquo;";                                                                                 /* Creates and outputs the first section of the output statement with the given $emailAddress value from $email */
         if (preg_match("/^(([A-Za-z]+\d+)|" .                                                           /* Checks the value given to $emailAddress to check if it is a validated email address. This is done by checking the characters and making sure that "mail" comes after the @ sign and that .org is included as a requirement */
                        "([A-Za-z]+\.[A-Za-z]+))" .
                        "@((mail\.)?)example\.org$/i",
                         $emailAddress)==1) {
            echo " is a valid e-mail address.<br/>";                                                     /* Creates and outputs the last section of the output statement if the email is valid and then breaks the line to the next one after output. */
         } else {                                                                                        /* Routes to the else if the email address is not valid */
            echo " is not a valid e-mail address.<br/>";                                                 /* Creates and outputs the last section of the output statement if the email is not valid and then breaks the line to the next one after output. */
         }                                                                                               /* Closes the else on line 30 */
      }                                                                                                  /* Closes the foreach loop */
   ?>                                                                                                    <!-- Uses a php script delimiter to close the code declaration block -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->