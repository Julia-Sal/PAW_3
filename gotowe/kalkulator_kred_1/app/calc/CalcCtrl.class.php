<?php

require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/calc/CalcForm.class.php';
require_once $conf->root_path.'/app/calc/CalcResult.class.php';

class CalcCtrl {

	private $msgs;
	private $form;   
	private $result; 

	
	public function __construct(){
		$this->msgs = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}
	
	
	public function getParams(){
		$this->form->kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
		$this->form->ile_mies = isset($_REQUEST['ile_mies']) ? $_REQUEST['ile_mies'] : null;
		$this->form->oprocentowanie = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;
	}
	
	public function validate() {
		if (! (isset ( $this->form->kwota ) && isset ( $this->form->ile_mies ) && isset ( $this->form->oprocentowanie ))) {
			return false; 
		}else { 
			$this->hide_intro = true; 
		}
		
		if ($this->form->kwota == "") {
			$this->msgs->addError('Nie podano kwoty');
		}
		if ($this->form->ile_mies == "") {
			$this->msgs->addError('Nie podano czasu');
		}
		if ($this->form->oprocentowanie == "") {
			$this->msgs->addError('Nie podano oprocentowania');
		}
		
		if (! $this->msgs->isError()) {
			
			if (! is_numeric ( $this->form->kwota )) {
				$this->msgs->addError('Pierwsza wartość nie jest liczbą całkowitą');
			}
			
			if (! is_numeric ( $this->form->ile_mies )) {
				$this->msgs->addError('Czas nie zostal poprawnie wprowadzony');
			}
			
			if (! is_numeric ( $this->form->oprocentowanie )) {
				$this->msgs->addError('Oprocentowanie nie jest liczbą całkowitą');
			}
		}
		
		return ! $this->msgs->isError();
	}
	
	
	public function process(){

		$this->getparams();
		
		if ($this->validate()) {
				
			$this->form->kwota = intval($this->form->kwota);
			$this->form->ile_mies = intval($this->form->ile_mies);
			$this->form->oprocentowanie = intval($this->form->oprocentowanie);
				
			$this->result->result = ($this->form->kwota + ($this->form->oprocentowanie/100)*$this->form->kwota*$this->formile_mies/12)/$this->form->ile_mies;
			
			$this->msgs->addInfo('Wykonano obliczenia.');
			}
		$this->generateView();
	}
		
	
	public function generateView(){
		global $conf;
		
		$smarty = new Smarty();
		$smarty->assign('conf',$conf);
		
		$smarty->assign('page_title','KALKULATOR KREDYTOWY');
		$smarty->assign('page_description','Pieniądze szczęścia nie dają, ale żyć pomagają');
		$smarty->assign('page_header','Obiekty w PHP');
		
		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('res',$this->result);
		
		$smarty->display($conf->root_path.'/app/calc/CalcView.html');
	}
}
