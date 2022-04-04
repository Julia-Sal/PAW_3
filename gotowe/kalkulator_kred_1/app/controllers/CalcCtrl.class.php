<?php

require_once 'CalcForm.class.php';
require_once 'CalcResult.class.php';

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
		$this->form->kwota = getFromRequest('kwota');
		$this->form->ile_mies = getFromRequest('ile_mies');
		$this->form->oprocentowanie = getFromRequest('oprocentowanie');
	}
	
	public function validate() {
		if (! (isset ( $this->form->kwota ) && isset ( $this->form->ile_mies ) && isset ( $this->form->oprocentowanie ))) {
			return false; 
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
		
		if (! getMessages()->isError()) {
			
			if (! is_numeric ( $this->form->kwota )) {
				getMessages()->addError('Pierwsza wartość nie jest liczbą całkowitą');
			}
			
			if (! is_numeric ( $this->form->ile_mies )) {
				getMessages()->addError('Czas nie zostal poprawnie wprowadzony');
			}
			
			if (! is_numeric ( $this->form->oprocentowanie )) {
				getMessages()->addError('Oprocentowanie nie jest liczbą całkowitą');
			}
		}
		
		return ! getMessages()->isError();
	}
	
	
	public function process(){

		$this->getparams();
		
		if ($this->validate()) {
				
			$this->form->kwota = intval($this->form->kwota);
			$this->form->ile_mies = intval($this->form->ile_mies);
			$this->form->oprocentowanie = intval($this->form->oprocentowanie);
				
			$this->result->result = ($this->form->kwota + ($this->form->oprocentowanie/100)*$this->form->kwota*$this->form->ile_mies/12)/$this->form->ile_mies;
			
			getMessages()->addInfo('Wykonano obliczenia.');
			}
		$this->generateView();
	}
		
	
	public function generateView(){
		getSmarty()->assign('page_title','KALKULATOR KREDYTOWY');
		getSmarty()->assign('page_description','Pieniądze szczęścia nie dają, ale żyć pomagają');
		getSmarty()->assign('page_header','Kontroler główny');
					
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		
		getSmarty()->display('CalcView.html');
	}
}
