<?php
namespace app\classes;

class Session
{

    /**
     *
     * @param
     *            $name
     * @param
     *            $value
     *            
     * @return mixed
     * @throws \Exception
     */
    // create a session
    public static function add($name, $value)
    {
        if ($name != '' && ! empty($name) && $value != '' && ! empty($value)) {
            return $_SESSION[$name] = $value;
        }
        throw new \Exception('Name and value required');
    }

    // get value from session
    /**
     *
     * @param
     *            $name
     * @return mixed
     */
    public static function get($name)
    {
        return $_SESSION[$name];
    }

    public static function has($name)
    {
        if ($name != '' && ! empty($name)) {
            return (isset($_SESSION[$name])) ? true : false;
        }
        throw new \Exception('Name is required');
    }

    public static function removeSession($name)
    {
        if (self::has($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     *
     * @param
     *            $name
     * @param
     *            $value
     * @return mixed
     */
    public static function flash($name, $value = '')
    {
        if (self::has($name)) {
            $old_value = self::get($name);
            self::removeSession($name);

            return $old_value;
        } else {
            self::add($name, $value);
        }
        return null;
    }

    // check session
    // remove session
}

