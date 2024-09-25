<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "all_scout";
    
    $conn = new mysqli($servername, $username, $password, $dbname);


    
        // Abre a conexão
        //$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);    
        // Verifica se houve erro na conexão
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        } else {
            echo "Conexão com o banco de dados efetuada com sucesso!\n";
        }   
        // Fecha a conexão se ela estiver aberta
       
            $conn->close();
            echo "Conexão fechada.\n";
        
    
   
?>