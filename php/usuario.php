<?php

class Usuario {
    private $id;
    private $nome;
    private $username;
    private $email;
    private $senha;
    private $celular;
    private $cpf;
    private $dataNasc;
    private $cep;
    private $estado;
    private $cidade;
    private $bairro;
    private $logradouro;
    private $numEnd;
    private $complemento;

    // Construtor
    public function __construct($nome, $username, $email, $senha, $celular, $cpf, $dataNasc, $cep, $estado, $cidade, $bairro, $logradouro, $numEnd, $complemento) {
        $this->nome = $nome;
        $this->username = $username;
        $this->email = $email;
        $this->senha = $senha;
        $this->celular = $celular;
        $this->cpf = $cpf;
        $this->dataNasc = $dataNasc;
        $this->cep = $cep;
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->logradouro = $logradouro;
        $this->numEnd = $numEnd;
        $this->complemento = $complemento;
    }

    // Getters e Setters
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getDataNasc() {
        return $this->dataNasc;
    }

    public function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function getNumEnd() {
        return $this->numEnd;
    }

    public function setNumEnd($numEnd) {
        $this->numEnd = $numEnd;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }
}

?>