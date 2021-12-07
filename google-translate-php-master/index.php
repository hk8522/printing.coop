<?php
require_once('vendor/autoload.php');
use Stichoza\GoogleTranslate\GoogleTranslate;
$tr = new GoogleTranslate('en');
$tr->setTarget('fr');
$tr->translate('Hello World!');
?>