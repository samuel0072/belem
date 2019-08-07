<?php
/*
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_NAME', 'redevis');
define('DB_PASSWORD', '');

include_once __DIR__.'/Database.php';

class MySQLDatabase extends Database{

    private $result;

    public function __construct()
    {
        Database::__construct();

        $this->params = [];
        $this->types = "";

        $this->db_connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        $this->db_connection->set_charset('utf8');
        if(!$this->db_connection){
            die(json_encode([
                'error' => true,
                'response' => 'Não foi possível conectar ao banco: ' . $this->db_connection->connect_error
            ]));
        }
    }

    function prepare($sql){
        return $this->db_connection->prepare($sql);
    }

    function fetch_assoc(){
        return $this->result->fetch_assoc();
    }

    function fetch_all(){
        $rows = [];
        while ($row = $this->fetch_assoc()){
            $rows[] = $row;
        }

        return $rows;
    }

    public function insert_id(){
        return $this->db_connection->insert_id;
    }

    public function query($query){
        $this->result = $this->db_connection->query($query);
        return $this->result;
    }

    public function already_exists($table, $condition){
        $queryBuilder = new QueryBuilder();
        $queryBuilder->select(['*'])->from($table)->where($condition);
        $result = $this->query($queryBuilder->get_query());
        return $result->num_rows > 0;
    }

    public function get_error()
    {
        return mysqli_error($this->db_connection);
    }

    public function get_last_insert_id()
    {
        return $this->db_connection->insert_id;
    }
}
*/