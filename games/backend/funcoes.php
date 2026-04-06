<?php 
function limpar($dado) {
    return htmlspecialchars(trim($dado));
}

function limpar2($dado) {
    return htmlspecialchars(trim($dado));
}

function mensagem($tipo, $texto) {
    return "<p class='$tipo'>$texto</p>";
}

function formatarData($data) {
    $timestamp = strtotime($data);
    return date('d/m/Y H:i', strtotime($data));
}

?>