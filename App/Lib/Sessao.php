<?php

namespace App\Lib;

class Sessao
{
    public static function recordMessage($message)
    {
        $_SESSION['message'] = $message;
    }

    public static function clearMessage()
    {
        unset($_SESSION['message']);
    }

    public static function returnMessage()
    {
        return (isset($_SESSION['message'])) ? $_SESSION['message'] : "";
    }

    public static function recordForm($form)
    {
        $_SESSION['form'] = $form;
    }

    public static function clearForm()
    {
        unset($_SESSION['form']);
    }

    public static function returnFormValue($key)
    {
        return (isset($_SESSION['form'][$key])) ? $_SESSION['form'][$key] : "";
    }

    public static function returnForm()
    {
        return (isset($_SESSION['form'])) ? $_SESSION['form'] : "";
    }

    public static function recordError($erros)
    {
        $_SESSION['erro'] = $erros;
    }

    public static function returnError()
    {
        return (isset($_SESSION['erro'])) ? $_SESSION['erro'] : false;
    }

    public static function clearError()
    {
        unset($_SESSION['erro']);
    }

}