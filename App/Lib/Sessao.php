<?php

namespace App\Lib;

class Sessao
{
    public static function init()
    {
        session_start();
    }

    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function destroy()
    {
        session_destroy();
    }

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
        return $_SESSION['message'] ?? "";
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
        return $_SESSION['form'][$key] ?? "";
    }

    public static function returnForm()
    {
        return $_SESSION['form'] ?? "";
    }

    public static function recordError($errors)
    {
        $_SESSION['error'] = $errors;
    }

    public static function returnError()
    {
        return $_SESSION['error'] ?? false;
    }

    public static function clearError()
    {
        unset($_SESSION['error']);
    }
}