<?php
require_once 'Database.php';

class User {
    private $conn;
    private $table_name = 'usuarios'; // nome da tabela onde os dados serão armazenados

    public $nome;
    public $email;
    public $cpf;
    public $senha;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, cpf, senha) VALUES (:nome, :email, :cpf, :senha)";

        $stmt = $this->conn->prepare($query);

        // Sanitizando os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->senha = password_hash($this->senha, PASSWORD_BCRYPT); // Criptografando a senha

        // Bind dos valores
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':senha', $this->senha);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}