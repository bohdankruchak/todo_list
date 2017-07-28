<?php
  class PagesController {
    public function todo() {
      require_once('views/pages/todo.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>