<?php
    require_once realpath(dirname(__FILE__) . '/../') . '/' . "models/functionModel.php";

    class FunctionsController{

        static public function pathDocumentos(){

			return "C:/xampp/htdocs/portafolio/project-manager/";

		}

        static public function saveFile($file, $folder, $path, $name, $ext){

			if(isset($file["tmp_name"]) && !empty($file["tmp_name"])){

				/*=============================================
				Configuramos la ruta del directorio donde se guardará la imagen
				=============================================*/

				$directory = FunctionsController::pathDocumentos().strtolower("views/archives/".$folder."/".$path."/");

				/*=============================================
				Preguntamos primero si no existe el directorio, para crearlo
				=============================================*/

				if(!file_exists($directory)){
					// mkdir($directory, 0755);
					mkdir($directory,0777,true);
				}

                //definimos nombre del archivo
				$newName  = $name.'.'.$ext;

				//definimos el destino donde queremos guardar el archivo
				$folderPath = $directory.$newName;

				$genero_archivo = file_put_contents( $folderPath, file_get_contents($file["tmp_name"]) );
				
				if( $genero_archivo > 0){
					return $newName;
				}else{
					return "error";
				}

			}else{

				return "error";

			}

		}

		static public function lastOrder($pages,$column,$where){
			return FunctionModel::lastOrder($pages,$column,$where);
		}

		static public function generateSelect(){
			$table = $_POST['table'];
			$select = $_POST['select'];
			$where = $_POST['where'];
			$whereTo = $_POST['whereTo'];

			$data = FunctionModel::generateSelect($table,$select,$where,$whereTo);

			echo json_decode($data);
		}

		static public function deleteRegister(){
			$id = $_POST['id'];
			$table = $_POST['table'];
			$suffix = $_POST['suffix'];

			$data = FunctionModel::deleteRegister($id,$table,$suffix);

			echo $data;
		}

    }

	
    if(isset($_POST['action']) && $_POST['action'] === 'consultarSelect') {
        $generateSelect = new FunctionsController();
        $generateSelect->generateSelect();
    }
	
    if(isset($_POST['action']) && $_POST['action'] === 'deleteRegister') {
        $deleteRegister = new FunctionsController();
        $deleteRegister->deleteRegister();
    }