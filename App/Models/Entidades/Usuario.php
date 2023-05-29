<?php

namespace App\Models\Entidades;

use DateTime;

class Usuario
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $documento;
    private string $data_nasc;
    private string $data_cadastro;
    private int $tipo;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    public function getDocumento(): string
    {
        return $this->documento;
    }

    public function setDocumento(string $documento)
    {
        $this->documento = $documento;
    }

    public function getDataNasc(): DateTime
    {
        return new DateTime($this->data_nasc);
    }

    public function setDataNasc(string $data_nasc)
    {
        $this->data_nasc = $data_nasc;
    }

    public function getDataCadastro(): DateTime
    {
        return new DateTime($this->data_cadastro);
    }

    public function setDataCadastro(string $data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;
    }

    public function getTipo(): int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo)
    {
        $this->tipo = $tipo;
    }

    public function getDocumentoFormatado(): string
    {
        $valor = $this->documento;
        $valor = preg_replace('/[^0-9]/', '', $valor); // Remove caracteres não numéricos

        if (strlen($valor) === 11) {
            // Formata CPF (exemplo: 123.456.789-10)
            $valor = substr($valor, 0, 3) . '.' . substr($valor, 3, 3) . '.' . substr($valor, 6, 3) . '-' . substr($valor, 9, 2);
        } elseif (strlen($valor) === 14) {
            // Formata CNPJ (exemplo: 12.345.678/0001-90)
            $valor = substr($valor, 0, 2) . '.' . substr($valor, 2, 3) . '.' . substr($valor, 5, 3) . '/' . substr($valor, 8, 4) . '-' . substr($valor, 12, 2);
        }

        return $valor;
    }
}