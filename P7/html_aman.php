<?php
$input = $_POST['input'];
$input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
 // Memeriksa apakah input adalah email yang valid
$email = $_POST[ 'email'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
// Lanjutkan dengan pengolahan email yang aman
} else {
// Tangani input yang tidak valid
}
?>