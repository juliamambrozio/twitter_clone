<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {
	public function autenticar() {
		
		$usuario = Container::getModel('Usuario');

		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));

		$usuario->autenticar(); //recupera o retorno de Usuário

		if($usuario->__get('id') != '' && $usuario->__get('nome') != '') {

            //SESSÃO
			session_start();

			$_SESSION['id'] = $usuario->__get('id'); //recebe os valoresdo BD que foram retornados
			$_SESSION['nome'] = $usuario->__get('nome');

			header('Location: /timeline');

		} else {
			header('Location: /?login=erro'); //colocando mensagem de erro na URL para capturar
		}

	}

	public function sair() {
		session_start(); //sempre startar a sessão quando for mexer nela
		session_destroy(); //quebrando dados na sessão
		header('Location: /');
	}
}