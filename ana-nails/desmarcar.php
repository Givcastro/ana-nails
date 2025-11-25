<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'conexao.php';

// Se não estiver logado ou não tiver ID do agendamento, volta para o painel
if (!isset($_SESSION['cliente_logado']) || !isset($_GET['id'])) {
    header("Location: painel_cliente.php");
    exit;
}

$cliente_id = $_SESSION['cliente_logado'];
$agendamento_id = (int) $_GET['id'];

// Remove o agendamento somente se pertencer ao cliente logado
$stmt = $pdo->prepare("DELETE FROM agendamentos WHERE id = :id AND cliente_id = :cliente");
$stmt->execute([
    ':id' => $agendamento_id,
    ':cliente' => $cliente_id
]);

// Volta para o painel após apagar
header("Location: painel_cliente.php");
exit;
?>
