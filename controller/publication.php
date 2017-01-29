<?php
  abstract class Controller_publication extends Controller_base {

    abstract public function add();
    abstract public function show($id);
    abstract public function showList();
    abstract public function remove($id);

  }
?>
