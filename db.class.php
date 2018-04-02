<?php

class db {
		
		//host
		private $host = 'localhost'; 	

		//usuario
		private $usuario = 'root';

		//senha
		private $senha = '';

		//banco de dados
		private $database = 'twitter_clone';

		public function conecta_mysql(){

			//cria conexao
			$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

			//ajustar o charset de aplicacao entre a aplicacao e o banco de dados
			mysqli_set_charset($con, 'utf8');

			// verificar se houve erro de conecao
			if(mysqli_connect_errno()){
				echo "houve erro ao tentar se conectar com o banco de dados MSQL: ". mysqli_connect_error();
			}

			return $con;

		}


}


?>