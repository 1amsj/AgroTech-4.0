<?php
class datos{
	private $ip = "localhost";
    private $bd = "AgroTechDB";
    private $usuario = "root";
    private $contrasena = "";



    protected function conecta(){

        $pdo = new PDO("mysql:host=".$this->ip.";dbname=".$this->bd."",$this->usuario,$this->contrasena);

        $pdo->exec("set names utf8");
        return $pdo;
    }

    public function registrar_bitacora($accion, $modulo,$id)
    {
        $sql = "INSERT INTO bitacora (Fecha, Accion, N_de_empleado  ) 
        VALUES(CURDATE(), :accion, :id_usuario)";

        $stmt = $this->conecta()->prepare($sql);

        $stmt->execute(array(
            
            
            ":accion" => $accion,
            
            ":id_usuario" => $id

        ));
    }
}
?>

