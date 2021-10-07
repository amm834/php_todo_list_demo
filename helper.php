<?php

function dump($result) {
    echo '<pre>'.print_r($result, 1).'</pre>';
}

function message($message) {
    $_SESSION['message'] = $message;
}

