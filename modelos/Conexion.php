<?php

	class conectar{
		//cambiar datos para poder conectar
		private $servidor="localhost";
		private $usuario="root";
		private $bd="control";
		private $password="";

		public function conexion(){
			$conexion=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			return $conexion;
		}

	}





 ?>
