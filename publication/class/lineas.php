<?php  

class Lineas
{ 
	function insertarIngrediente(){
		$ingredienteDBO = DB_DataObject::Factory('Ingrediente');

		$campos = $ingredienteDBO->table();

		foreach($campos as $key => $value){
			if($key != "id" && $key != "fecha"){
				$ingredienteDBO->$key = $this->$key;
			}
		}

		$ingredienteDBO->fecha = date("Y-m-d");

		$ingredienteDBO->insert();
		$ingredienteDBO->free();

		return(true);
	}

	function getLinea(){
		$lineaVerDBO = DB_DataObject::Factory('Linea');

		//$ingredienteDBO->orderBy("id ASC");
		$lineaVerDBO->find();

		$lineas = array();
		$contador = 0;

		while($lineaVerDBO->fetch()){
			$lineas[$contador]->idLinea = $lineaVerDBO->idLinea;
			$lineas[$contador]->nombre = $lineaVerDBO->nombre;
			$contador++;
		}
		$lineaVerDBO->fetch();
		return($lineas);

	}

	function getIngredientexId($id){
		$ingredienteAcDBO = DB_DataObject::Factory('Ingrediente');

		//$ingredienteAcDBO->get($id);
		
		$ingredienteAcDBO->WhereAdd("id = '$id'");

		$ingredientes = array();
		$ret = false;

		$ingredienteAcDBO->find();
		while($ingredienteAcDBO->fetch()){
			$ingredientes[0]->id = $ingredienteAcDBO->id;
			$ingredientes[0]->nombre = $ingredienteAcDBO->nombre;
			$ingredientes[0]->productoColombina = $ingredienteAcDBO->productoColombina;
			$ingredientes[0]->fecha = $ingredienteAcDBO->fecha;
			$ret = true;
		}

		if($ret){
			$ret = $ingredientes;
		}
		return($ret);
		
		//return($ingredienteAcDBO);

	}

	function actualiza(){
		$ingredienteActDBO = DB_DataObject::Factory('Ingrediente');

		$ingredienteActDBO->get($this->id);

		$ingredienteActDBO->nombre = $this->nombre;
		$ingredienteActDBO->productoColombina =  $this->productoColombina;

		$ingredienteActDBO->update();

		$ingredienteActDBO->free();

		return (true);

	}

	
/*
	function getIngrediente(){
		
		//$ingredienteDBO->orderBy("id ASC");
		$conexion = new mysql();
		$conexion->conectar();
		$consulta = "select * from ingrediente";
		$datos = $conexion->query($consulta);


		$ingredientes = array();
		$contador = 0;

		while($row = mysqli_fetch_array($datos)){
			$ingredientes[$contador] = $row['id'];
			$contador++;
		}
		return $ingredientes;
	}
	*/
}
?>