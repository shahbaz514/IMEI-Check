<?php
class Database
{
//imeichec_apios', 'imeichec_apios', 'Shahbaz@786'
    private $db_host = 'localhost';
    private $db_name = 'imeichec_apios';
    private $db_username = 'imeichec_apios';
    private $db_password = 'Shahbaz@786';


    public function dbConnection()
    {

        try {
            $conn = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_username, $this->db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection error " . $e->getMessage();
            exit;
        }
    }
}