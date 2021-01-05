<?php
 namespace tk\GuzzleHttp\Promise; interface TaskQueueInterface { public function isEmpty(); public function add(callable $task); public function run(); } 