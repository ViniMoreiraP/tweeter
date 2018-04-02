<?php 

	session_start();

	if (!isset($_SESSION['usuario'])) {

		header('Location : index.php?erro=1');
	}



	require_once('db.class.php');
	$objDb = new db();
	$link =$objDb->conecta_mysql();

	$id_usuario=$_SESSION['id_usuario'];
	$nome_pessoa= $_POST['nome_pessoa'];






	$sql = " SELECT u.*, us.* FROM usuarios AS u LEFT JOIN usuarios_sequidores as us";
	$sql.= " on (us.id_usuario= $id_usuario AND u.id= us.seguindo_id_usuario) ";
	$sql.= "WHERE u.usuario LIKE '%$nome_pessoa%' and u.id <> $id_usuario ";
	

	 $resultado_id= mysqli_query($link, $sql);

	 if ($resultado_id) {
	 	
	   while($registo= mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)){



	   	 echo '<a href ="#" class="list-group-item">';
	   	 	echo ' <strong> '.$registo['usuario'].'</strong>  <small> - '.$registo['email'].'</small> ';
	   	 	echo '<p class="list-group-item-text pull-right">';

	   	 	$esta_seguindo_usuario= isset($registo['id_usuario_seguidor']) && !empty($registo['id_usuario_seguidor'])? true : false;

	   	 	$btn_seguir_display= 'block';
	   	 	$btn_deixar_seguir_display= 'block';


	   	 	if ($esta_seguindo_usuario) {
	   	 		$btn_seguir_display= 'none';
	   	 	}else {
	   	 		$btn_deixar_seguir_display= 'none';
	   	 	}


	   	 	echo ' <button type="button" id="btn-seguir_'.$registo['id'].'" style="display:'.$btn_seguir_display.'" class="btn btn-primary btn_seguir" data-id_usuario="'.$registo['id'].'"  >Seguir</button>'; 
	   	 	echo ' <button type="button" id="btn-deixar_seguir_'.$registo['id'].'" style="display:'.$btn_deixar_seguir_display.'" class="btn btn-default btn_deixar_seguir" data-id_usuario="'.$registo['id'].'"  >Deixar de seguir</button>'; 
	   	 	echo ' </p>';
	   	 echo '<div class="clearfix"></div>';
	   	 echo '</a>';


	   }


	 }else {
	 	echo "erro na consulta de usuarios no banco de dados";
	 }


 ?>