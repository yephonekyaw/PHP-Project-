<?php
    // $randomPassword = bin2hex(random_bytes(5));
    $randomPassword = substr( password_hash( 'dupa.8', PASSWORD_DEFAULT ), 8, 15 );
    echo $randomPassword;
?>