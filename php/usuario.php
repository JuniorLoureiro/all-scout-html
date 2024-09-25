<?php
require_once 'Database.php';

class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $nome;
    public $email;
    public $cpf;
    public $senha;
    public $cep;
    public $cidade;
    public $logradouro;
    public $complemento;
    public $username;
    public $celular;
    public $data_nascimento;
    public $estado;
    public $bairro;
    public $numEnd;

    // Construtor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar o usuário
    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " 
            (nome, email, cpf, senha, cep, cidade, logradouro, complemento, username, celular, data_nascimento, estado, bairro, numEnd)
            VALUES
            (:nome, :email, :cpf, :senha, :cep, :cidade, :logradouro, :complemento, :username, :celular, :data_nascimento, :estado, :bairro, :numEnd)";
        
        $stmt = $this->conn->prepare($query);

        // Ligação dos parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':logradouro', $this->logradouro);
        $stmt->bindParam(':complemento', $this->complemento);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':celular', $this->celular);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':bairro', $this->bairro);
        $stmt->bindParam(':numEnd', $this->numEnd);

        // Executa a query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function verificarSenha($senha_atual) {
        $query = "SELECT senha FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return password_verify($senha_atual, $row['senha']);
        }

        return false;
    }

    public function atualizarSenha() {
        $query = "UPDATE " . $this->table_name . " SET senha = :senha WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        // bind
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':username', $this->username);

        return $stmt->execute();
    }
}
?>