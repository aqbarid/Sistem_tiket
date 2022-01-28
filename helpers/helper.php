<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Str;


function limitText($text, $limit = 50) {
  return Str::limit($text, $limit, '...');
}