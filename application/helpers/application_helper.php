<?php defined('BASEPATH') or exit('URL inválida.');

function response(array $data): void
{
    header('Content-Type: application/json');
    echo json_encode($data, JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    exit;
}

function formatCodeBar(string $codeBar)
{
    return 'BR' . $codeBar;
}

/**
 * Formata Array para montar o grafico do estoque com movimentos de todos os meses
 *
 * @param array Resultado do banco para iterar
 * @return array Com resultados iterados para montar o grafico
 */
function iterarArrayMensal(array $arr)
{
    $meses = [];
    $entrada = [];
    $saida = [];
    foreach ($arr as $row) {

        $meses[] = $row['mes'];
        $entrada[] = $row['entrada'];
        $saida[] = $row['saida'];
    }
    return $result = [
        'meses' => $meses,
        'entrada' => $entrada,
        'saida' => $saida
    ];
}

/**
 * Formata Array para montar o grafico do estoque com movimentos diarios
 *
 * @param array Resultado do banco para iterar
 * @return array Com resultados iterados para montar o grafico
 */
function iterarArrayDiaria(array $arr)
{
    $dias = [];
    $entrada = [];
    $saida = [];
    foreach ($arr as $row) {

        $dias[] = $row['dia'];
        $entrada[] = $row['entrada'];
        $saida[] = $row['saida'];
    }
    return $result = [
        'dias' => $dias,
        'entrada' => $entrada,
        'saida' => $saida
    ];
}
