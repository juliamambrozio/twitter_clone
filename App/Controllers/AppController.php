<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {


	public function timeline() {
		//PEGANDO TWEETS DO BD
		session_start();

		$this->validaAutenticacao();

		//quando não tem o login, os valores da sessão são vázios
		
			$tweet= Container::getModel('Tweet');

			$tweet->__set('id_usuario', $_SESSION['id']);

			$tweets = $tweet->getAll();

			$this->view->tweets = $tweets;

			$this->render('timeline'); //carrega a página
		

		
	}

	public function tweet(){
		//RECUPERANDO DADOS DO TWEET E SALVANDO
		session_start();
		$this->validaAutenticacao();
		//quando não tem o login, os valores da sessão são vázios
		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {
			$tweet = Container::getModel('Tweet'); //retorna configuração com o bd

			$tweet->__set('tweet', $_POST['tweet']);
			$tweet->__set('id_usuario', $_SESSION['id'] ); //setando valores do bd com os valores do POST e Session

			$tweet->salvar();
			header('Location: /timeline');



		} else {
			header('Location: /?login=erro');
		}
		
	}

	public function validaAutenticacao(){

		if(!isset($_SESSION['id']) || $_SESSION['id'] == ''|| !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {

			header('Location: /?login=erro');

		} 
		}
}

?>