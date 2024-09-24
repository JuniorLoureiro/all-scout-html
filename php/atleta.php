<?php

class Atleta {
    // Atributos da classe
    private $id;
    private $nome;
    private $dataNascimento;
    private $clubeAtual;
    private $altura;
    private $posicao;
    private $pernaDominante;
    private $nacionalidade;
    private $numeroCamisa;

    // Construtor para inicializar os atributos
    public function __construct($id, $nome, $dataNascimento, $clubeAtual, $altura, $posicao, $pernaDominante, $nacionalidade, $numeroCamisa) {
        $this->id = $id;
        $this->nome = $nome;
        $this->dataNascimento = $dataNascimento;
        $this->clubeAtual = $clubeAtual;
        $this->altura = $altura;
        $this->posicao = $posicao;
        $this->pernaDominante = $pernaDominante;
        $this->nacionalidade = $nacionalidade;
        $this->numeroCamisa = $numeroCamisa;
    }

    // Métodos getters e setters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function getClubeAtual() {
        return $this->clubeAtual;
    }

    public function getAltura() {
        return $this->altura;
    }

    public function getPosicao() {
        return $this->posicao;
    }

    public function getPernaDominante() {
        return $this->pernaDominante;
    }

    public function getNacionalidade() {
        return $this->nacionalidade;
    }

    public function getNumeroCamisa() {
        return $this->numeroCamisa;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function setClubeAtual($clubeAtual) {
        $this->clubeAtual = $clubeAtual;
    }

    public function setAltura($altura) {
        $this->altura = $altura;
    }

    public function setPosicao($posicao) {
        $this->posicao = $posicao;
    }

    public function setPernaDominante($pernaDominante) {
        $this->pernaDominante = $pernaDominante;
    }

    public function setNacionalidade($nacionalidade) {
        $this->nacionalidade = $nacionalidade;
    }

    public function setNumeroCamisa($numeroCamisa) {
        $this->numeroCamisa = $numeroCamisa;
    }
}

?>
