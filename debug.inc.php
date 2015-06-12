<?php
// Turn debugging on FALSE  TRUE
define('CB_DEBUG', FALSE);

// generic debugging function
// Sample:
//     pc_debug(__FILE__, __LINE__, "This is a debug message.");

function pc_debug($file, $line, $message) {
  if (defined('CB_DEBUG') && CB_DEBUG) {
    error_log("---DEBUG-". $sitename .": [$file][$line]: $message");
  }
  else {
    error_log("CB_DEBUG disabled");
  }
}
