<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function name2id(string $name)
{
    return str_replace(['[', ']'], ['\\\\[', '\\\\]'], $name);
}
