<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/** @var int $size */
/** @var string[] $errors */
?>

<div class="bf-alert error is-dismissible">
    <strong class="alert-heading"><?php echo _n( 'The following error was found:', 'The following errors were found:', $size, 'buddyforms' ) ?></strong>
    <ul style="padding: 0; padding-inline-start: 40px;">
        <li><?php echo $errors_string ?></li>
    </ul>
</div>
