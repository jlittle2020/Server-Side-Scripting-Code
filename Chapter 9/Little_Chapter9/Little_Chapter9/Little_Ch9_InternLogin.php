<!--
   Author: Jonathon Little
   Date: 4/25/2020
   Purpose: Gets a user to Log In if they have registered previously or to register a new Log In.
-->
<?php                                                                                             /* Uses a php delimiter to open up the php script before the !DOCTYPE declaration */
session_start();                                                                                  /* Starts or opens a session in php */
$_SESSION = array();                                                                              /* Sets a unique link within the session variables between the user's web page and the server */
session_destroy();                                                                                /* Stops or closes a session in php */
?>                                                                                                <!-- Uses a php delimiter to close the php script -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title>College Internships</title>                                                             <!-- Sets the title of the page to College Internships -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <h1>College Internships</h1>                                                                   <!-- Sets a header in the h1 size to College Internships -->
   <h2>Register / Log In</h2>                                                                     <!-- Sets a header in the h2 size to Register / Log In -->
   <p>New interns, please complete the top form to
   register as a user. Returning users, please complete
   the second form to log in.</p>                                                                 <!-- Puts a message for the users for whether or not they are new users or returning users -->
   <hr/>                                                                                          <!-- Sets a horizontal line across the page to separate the header information from the forms -->
   <h3>New Intern Registration</h3>                                                               <!-- Puts a header for the name of the form for the new user to register a log in -->
   <form method="post" action="Little_Ch9_RegisterIntern.php?<?php echo SID; ?>">                 <!-- Opens up a form and routes it to be sent to Little_Ch9_RegisterIntern.php after submittal -->
   <p>Enter your name: First <input type="text" name="first"/>                                    <!-- Sets an input for the user's first name -->
   Last: <input type="text" name="last"/></p>                                                     <!-- Sets an input for the user's last name -->
   <p>Enter your e-mail address: <input type="text" name="email"/></p>                            <!-- Sets an input for the user's e-mail address -->
   <p>Enter a password for your account: <input type="password" name="password"/></p>             <!-- Sets an input for the user's password -->
   <p>Confirm your password: <input type="password" name="password2"/></p>                        <!-- Sets an input for the user to confirm their password again -->
   <p><em>(Passwords are case-sensitive and must be at least 6 characters long)</em></p>          <!-- Puts a little tidbit of information for the specification of the password -->
   <input type="reset" name="reset" value="Reset Registration Form"/>                             <!-- Sets a button to reset the input fields all at once -->
   <input type="submit" name="register" value="Register"/>                                        <!-- Sets a button to submit the form -->
   </form>                                                                                        <!-- Closes the form -->
   <hr/>                                                                                          <!-- Sets a horizontal line across the page to separate the register form from the log in form -->
   <h3>Returning Intern Login</h3>                                                                <!-- Sets a header for the log in form -->
   <form method="post" action="Little_Ch9_VerifyLogin.php?<?php echo SID; ?>">                    <!-- Opens up a form and routes it to be sent to Little_Ch9_VerifyLogin.php after submittal -->
   <p>Enter your e-mail address: <input type="text" name="email"/></p>                            <!-- Sets an input for the user to enter their registered e-mail address -->
   <p>Enter your password: <input type="password" name="password"/></p>                           <!-- Sets an input for the user to input their password -->
   <p><em>(Passwords are case-sensitive and must be at least 6 characters long)</em></p>          <!-- Puts a little tidbit of information for the specification of the password -->
   <input type="reset" name="reset" value="Reset Login Form"/>                                    <!-- Sets a button to reset the input fields all at once -->
   <input type="submit" name="login" value="Log In"/>                                             <!-- Sets a submit button to submit the form and log the user in -->
   </form>                                                                                        <!-- Closes the form -->
   <hr/>                                                                                          <!-- Sets a horizontal line at the bottom of the page -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->