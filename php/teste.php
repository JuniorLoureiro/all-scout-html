<?php
$url = "https://allscout.rf.gd";
$numRequests = 1000; // Número de requisições para o teste

for ($i = 1; $i <= $numRequests; $i++) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Desabilita a verificação SSL
    curl_exec($ch);
    
    // Verifica se houve erro na requisição
    if (curl_errno($ch)) {
        echo "Erro na requisição #$i: " . curl_error($ch) . "\n";
    } else {
        echo "Requisição #$i concluída com sucesso.\n";
    }

    curl_close($ch);
    usleep(500000); // Pausa de 0,5 segundos entre as requisições
}
