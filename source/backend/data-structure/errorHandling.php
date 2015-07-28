<?php

register_shutdown_function("quit");

function quit() {
  $error = error_get_last();

  if ($error['type'] == E_ERROR) {
    $message = $error['message'] . "\n";
    error_log($message, 3, $_SERVER['DOCUMENT_ROOT'] . "/logg.txt");
  }
}

set_error_handler("custom_warning_handler", E_ALL);

function custom_warning_handler($errno, $errstr, $errfile, $errline) {
  $date = date('d-m-Y H:i');

  $error = $date . " " . $errfile . " " . $errline . " " . $errno . " " . $errstr . "\r\n";
  error_log($error, 3, $_SERVER['DOCUMENT_ROOT'] . "/logg.txt");
}