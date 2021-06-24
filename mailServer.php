<?php

$to = "emmanuelaku@gmail.com, emmanuel_aku@yahoo.com.com";
$subject = "Hi!";
$message = " Hi,\n\nHow are you?";
$headers = "From: emmanuelaku@gmail";
mail($to, $subject, $message, $headers);
echo("<p>Email successfully sent!</p>");
} else {
echo("<p>Email delivery failed…</p>");
}

?>

