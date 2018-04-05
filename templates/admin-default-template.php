<?php

if( ! defined( 'ABSPATH' ) )
    exit;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php print __DIR__; ?>/admin-default-ticket.css" />
    </head>
    <body>
        <?php print $tickets; ?>
    </body>
</html>