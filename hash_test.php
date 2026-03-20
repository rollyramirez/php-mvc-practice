<?php

/* Set plain password */
$password = "1234";

/* Create secure hashed password */
$hash = password_hash($password, PASSWORD_DEFAULT);

/* Display hashed password */
echo $hash;