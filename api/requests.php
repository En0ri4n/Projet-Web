<?php

function url_decode_and_percent(string $s)
{
    return '%' . urldecode($s) . '%';
}