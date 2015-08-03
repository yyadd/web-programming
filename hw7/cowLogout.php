<?php
  session_destroy();
  session_regenerate_id(TRUE);   # flushes out session ID number
  session_start();
?>
