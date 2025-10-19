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
        $sql = "INSERT INTO bitacora (fecha, accion, modulo, id_usuario ) 
        VALUES(CURDATE(), :accion, :modulo, :id_usuario)";

        $stmt = $this->conecta()->prepare($sql);

        $stmt->execute(array(
            
            
            ":accion" => $accion,
            ":modulo" => $modulo,
            ":id_usuario" => $id

        ));
    }
}
?>

