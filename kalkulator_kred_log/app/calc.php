<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony kalkulatora

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$kwota,&$ile_mies,&$oprocentowanie){
	$kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$ile_mies = isset($_REQUEST['ile_mies']) ? $_REQUEST['ile_mies'] : null;
	$oprocentowanie = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;	
	$rata = isset($_REQUEST['rata']) ? $_REQUEST['rata'] : null;
}

function validate(&$kwota,&$ile_mies,&$oprocentowanie,&$messages){
	if ( ! (isset($kwota) && isset($ile_mies) && isset($oprocentowanie))) {
		return false;
	}
	
	if ( $kwota == "") {
		$messages [] = 'Nie podano kwoty';
	}
	if ( $ile_mies == "") {
		$messages [] = 'Nie podano czasu';
	}
	if ( $oprocentowanie == "") {
		$messages [] = 'Nie podano oprocentowania';
	}
	
	if (count ( $messages ) != 0) return false;
	
	
	
	if (! is_numeric( $kwota )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	if (! is_numeric( $ile_mies )) {
		$messages [] = 'Czas nie zostal poprawnie wprowadzony';
	}
	if (! is_numeric( $oprocentowanie )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}
	
	if (count ( $messages ) != 0) return false;
	else return true;
}

function process(&$kwota,&$ile_mies,&$oprocentowanie,&$messages,&$rata){
	global $role;
	
	$kwota = intval($kwota);
	$ile_mies = intval($ile_mies);
	$oprocentowanie = intval($oprocentowanie);
	
	$rata = ($kwota + ($oprocentowanie/100)*$kwota*$ile_mies/12)/$ile_mies;
	//miesięczna
}

$kwota = null;
$ile_mies = null;
$oprocentowanie = null;
$rata = null;
$messages = array();

getParams($kwota,$ile_mies,$oprocentowanie);
if ( validate($kwota,$ile_mies,$oprocentowanie,$messages) ) { // gdy brak błędów
	process($kwota,$ile_mies,$oprocentowanie,$messages,$rata);
}

include 'calc_view.php';