<?php

require '';

class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "all_scout";
    public $conn;

    // Método para abrir a conexão
    public function openConnection() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verifica se houve algum erro durante a conexão
        if ($this->conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->conn->connect_error);
        }

        echo "Conexão com o banco de dados efetuada com sucesso!\n";
    }

    // Método para fechar a conexão
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
            echo "Conexão fechada.\n";
        }
    }
}

// Exemplo de uso da classe Database
$db = new Database();
$db->openConnection();
// Aqui você pode chamar suas funções de insert, select, etc.
$db->closeConnection();

?>