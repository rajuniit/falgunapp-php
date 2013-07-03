<?php

require_once 'falgunapp.php';

// initialize falgunapp class
$falgunapp = new FalgunApp('lm_dev_service', '5bbc162e1ab932cc589865739d349003');

// log simple info
$falgunapp->logInfo(array('title' => 'simple log title', 'data' => 'descripiton of data'));


//enable custom exceptions
$falgunapp->enableCustomErrorHandler();

//log fatal error
$div = 12/0;


