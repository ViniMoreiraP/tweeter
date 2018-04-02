<?php 

	session_start();

	if (!isset($_SESSION['usuario'])) {

		header('Location : index.php?erro=1');
	}



	require_once('db.class.php');
	$objDb = new db();
	$link =$objDb->conecta_mysql();

	$id_usuario=$_SESSION['id_usuario'];







	$sql = " SELECT date_format(t.data_inclusao,'%d %b %Y %T') AS data_inclusao_formatada ,t.tweet,u.usuario FROM tweet AS t";
	$sql.= " JOIN usuarios AS u ON(t.id_usuario = u.id) ";
	$sql.= " where id_usuario=$id_usuario";
	$sql.= " or id_usuario IN (SELECT seguindo_id_usuario from usuarios_sequidores where id_usuario= $id_usuario) ";
	$sql.= "order by data_inclusao desc" ;

	

	 $resultado_id= mysqli_query($link, $sql);

	 if ($resultado_id) {
	 	
	   while($registo= mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)){
	   	 echo '<a href ="#" class="list-group-item">';
	   	 echo '<h4 class="list-group-item-heading"> '.$registo['usuario'].' <small> - '.$registo['data_inclusao_formatada'].' </small> </h4> ';
	   	 echo '<p class="list-group-item-text">'.$registo['tweet'].'</p>';

	   	 echo '</a>';


	   }






	 }else {
	 	echo "erro na consulta de tweets no banco de dados";
	 }


 ?>