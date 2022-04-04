<?php
require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';

function getParams(&$form){
	$form['kwota'] = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$form['ile_mies'] = isset($_REQUEST['ile_mies']) ? $_REQUEST['ile_mies'] : null;
	$form['oprocentowanie'] = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;	
}

function validate(&$form,&$infos, &$msgs, &$hide_intro ){
	if ( ! (isset($form['kwota']) && isset($form['ile_mies']) && isset($form['oprocentowanie']))) return false;
	
	$hide_intro = true;
	
	if ( $form['kwota'] == "") $msgs [] = 'Nie podano kwoty';
	if ( $form['ile_mies'] == "") $msgs [] = 'Nie podano czasu';
	if ( $form['oprocentowanie'] == "") $msgs [] = 'Nie podano oprocentowania';
	
	if (count ( $msgs ) == 0){
	if (! is_numeric( $form['kwota'] )) $msgs [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	if (! is_numeric( $form['ile_mies'] )) $msgs [] = 'Czas nie zostal poprawnie wprowadzony';
	if (! is_numeric( $form['oprocentowanie'] )) $msgs [] = 'Druga wartość nie jest liczbą całkowitą';
	}
	if(count($msgs)>0) return false;
	else return true;
}


function process(&$form,&$infos, &$msgs,&$result){
	$infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
	
	$form['kwota'] = intval($form['kwota']);
	$form['ile_mies'] = intval($form['ile_mies']);
	$form['oprocentowanie'] = intval($form['oprocentowanie']);
	
	$result = ($form['kwota'] + ($form['oprocentowanie']/100)*$form['kwota']*$form['ile_mies']/12)/$form['ile_mies'];
	//miesięczna
}

$form = null;
$infos = array();
$messages = array();
$result = null;
$hide_intro = false;

getParams($form);
if ( validate($form,$messages, $infos, $hide_intro) ) {
	process($form,$infos,$messages,$result);
}

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Kalkulator Kredytowy');
$smarty->assign('page_description','Pieniądze szczęścia nie dają, ale żyć pomagają.');
$smarty->assign('page_header','Szablony Smarty');

$smarty->assign('hide_intro',$hide_intro);

$smarty->assign('form',$form);
$smarty->assign('result',$result);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);


$smarty->display(_ROOT_PATH.'/app/calc.html');