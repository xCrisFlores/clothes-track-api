<?php
require_once "connection.php";

class Clothe {

    public static function get_all() {
        $mysqli = get_connection();

        $data_sql = $mysqli->query("SELECT * FROM clothes INNER JOIN type ON clothes.clotheType = type.id");
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

        $query = $mysqli->prepare("INSERT INTO clothes (name, color, usedTimes, clotheType) VALUES (?, ?, ?, ?)");
        $query->bind_param("ssis", $name, $color, $usedTimes = 0, $type);

        $result = $query->execute();
        $query->close();
        $mysqli->close();

        return $result;
    }
}
?>
