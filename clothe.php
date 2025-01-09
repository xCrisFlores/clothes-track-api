<?php
require_once "connection.php";

class Clothe {

    public static function get_all() {
        $mysqli = get_connection();

        $data_sql = $mysqli->query("SELECT clothes.id ,name,color, usedTimes, type.type FROM clothes INNER JOIN type ON clothes.type = type.id");
        $data = [];

        if ($data_sql) {
            while ($row = $data_sql->fetch_assoc()) {
                $data[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'color' => $row['color'],
                    'usedTimes' => $row['usedTimes'],
                    'type' => $row['type']
                ];
            }
        }

        $mysqli->close();
        return $data;
    }

    public static function create_resource($name, $color, $type) {
        $mysqli = get_connection();
    
        $name = $mysqli->real_escape_string($name); 
        $color = $mysqli->real_escape_string($color); 
        $type = (int)$type;  
    
        $query = "INSERT INTO clothes (name, color, usedTimes, type) VALUES ('$name', '$color', 0, $type)";
    
        $result = $mysqli->query($query);
    
        if ($result === false) {
            die('Error en la ejecución de la consulta: ' . $mysqli->error); 
        }
    
        $mysqli->close();
    
        return $result;
    }

    public static function setUsed($id) {
        $mysqli = get_connection();
    
        $query = "UPDATE clothes SET usedTimes = usedTimes + 1 WHERE id = $id";
    
        $result = $mysqli->query($query);
    
        if ($result === false) {
            die('Error en la ejecución de la consulta: ' . $mysqli->error); 
        }
    
        $mysqli->close();
    
        return $result;
    }

    public static function deleteClothe($id) {
        $mysqli = get_connection();
    
        $query = "DELETE FROM clothes WHERE id = $id";
    
        $result = $mysqli->query($query);
    
        if ($result === false) {
            die('Error en la ejecución de la consulta: ' . $mysqli->error); 
        }
    
        $mysqli->close();
    
        return $result;
    }
}
?>
