<?php

require_once 'falgunapp.php';

$falgunapp = new FalgunApp('lm_dev_service', '5bbc162e1ab932cc589865739d349003');

$falgunapp->logInfo(array('title' => 'simple log title', 'data' => 'descripiton of data'));