<?php
require_once 'init.php';

getRouter()->setDefaultRoute('calcShow'); 
getRouter()->setLoginRoute('login');

getRouter()->addRoute('calcShow',    'CalcCtrl',  ['user','admin']);
getRouter()->addRoute('calcCompute', 'CalcCtrl',  ['user','admin']);
getRouter()->addRoute('login',       'LoginCtrl');
getRouter()->addRoute('logout',      'LoginCtrl', ['user','admin']);

getRouter()->addRoute('personNew',		'personEditCtrl',	['user','admin']);
getRouter()->addRoute('personEdit',	'personEditCtrl',	['admin']);
getRouter()->addRoute('personSave',	'personEditCtrl',	['user','admin']);
getRouter()->addRoute('personList',	'CalcCtrl',	['user','admin']);
getRouter()->addRoute('personDelete',	'personEditCtrl',	['admin']);

getRouter()->go();
