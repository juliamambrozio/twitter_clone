<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {


	public function timeline() {

		session_start();

		//quando não tem o login, os valores da sessão são vázios
		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {
			$this->render('timeline'); //carrega a página
		} else {
			header('Location: /?login=erro');
		}

		
	}
}

?>