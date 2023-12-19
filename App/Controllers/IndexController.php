<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->render('index');
	}

	public function inscreverse() {

		$this->view->usuario = array(
				'nome' => '',
				'email' => '',
				'senha' => '',
			);

		$this->view->erroCadastro = false;

		$this->render('inscreverse');
	}

	public function registrar() {

		$usuario = Container::getModel('Usuario'); //faz instância do usuário com o Banco

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', $_POST['senha']);

		
		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) { //se a quantidade de e-mails iguals for superior a 0, então existe registros com o mesmo e-mail (o que não pode acontecer)
		
				$usuario->salvar(); //se validar retornar true, ele insere

				$this->render('cadastro'); //view de sucesso de cadastro

		} else {

			//deixando campo preenchido com os valores do post mesmo tendo errado o cadastro
			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha'],
			);

			$this->view->erroCadastro = true;

			$this->render('inscreverse');
		}

	}

}


?>