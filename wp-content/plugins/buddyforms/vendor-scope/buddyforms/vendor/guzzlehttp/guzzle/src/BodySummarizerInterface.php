<?php
 namespace tk\GuzzleHttp; use tk\Psr\Http\Message\MessageInterface; interface BodySummarizerInterface { public function summarize(\tk\Psr\Http\Message\MessageInterface $message) : ?string; } 