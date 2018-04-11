<?php

class Session
{
    //S'il n'y a pas de session en cours, on en débute une.
    public static function init()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    //On assigne une valeur à une clé.
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    //Si la clé est remplit, on la renvoit.
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    //Associe valeurs des var pseudo et rôle aux clés correspondant.
    public static function authenticate($pseudo, $id)
    {
        Session::set('pseudo', $pseudo);
        Session::set('id', $id);
    }

    //Destruction de la session.
    public static function destroy()
    {
        session_destroy();
    }
}
