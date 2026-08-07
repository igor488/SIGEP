<?php

function gerarPatrimonio(PDO $pdo, $prefixo)
{
    try {

        $pdo->beginTransaction();

        $sql = $pdo->prepare("
            SELECT ultimo_numero
            FROM sequencias
            WHERE prefixo = ?
            FOR UPDATE
        ");

        $sql->execute([$prefixo]);

        $dados = $sql->fetch(PDO::FETCH_ASSOC);

        if(!$dados){

            throw new Exception("Prefixo não encontrado.");

        }

        $novoNumero = $dados['ultimo_numero'] + 1;

        $update = $pdo->prepare("
            UPDATE sequencias
            SET ultimo_numero = ?
            WHERE prefixo = ?
        ");

        $update->execute([
            $novoNumero,
            $prefixo
        ]);

        $pdo->commit();

        return $prefixo . str_pad($novoNumero,4,"0",STR_PAD_LEFT);

    }catch(Exception $e){

        $pdo->rollBack();

        throw $e;

    }
}