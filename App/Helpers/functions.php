<?php

function goBack() {
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

function dd($toCheck) {
    echo '<pre>';
    var_dump($toCheck);
    echo '</pre>';
    die();
}