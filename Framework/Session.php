<?php

namespace Framework;

class Session
{

    /**
     * start the session
     *
     * @return void
     */
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * set the session key/value pairs
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {

        $_SESSION[$key] = $value;
    }

    /**
     * get the session key/value pairs
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Checks if session key exist
     * 
     * @param string $key
     * 
     *@return bool
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Clear session by key 
     * 
     * @param string $key
     * @return void
     */
    public static function clear($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Clear all session data
     * 
     * @return void
     */
    public static function clearAll()
    {
        session_unset();
        session_destroy();
    }
}
