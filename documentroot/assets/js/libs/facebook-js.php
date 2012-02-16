<?php
defined('INCLUDE_DIR') or
    define('INCLUDE_DIR', realpath(dirname(__FILE__) .'/../../../../include'));

header('Content-Type: application/x-javascript; charset=utf-8');

// include the facebook-js-sdk files
require INCLUDE_DIR .'/facebook-js/all.js.php';