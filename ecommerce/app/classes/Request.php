<?php
namespace app\classes;

class Request
{

    /**
     * Return all requests that we are interested in
     *
     * @param boolean $is_array
     * @return mixed
     */
    public static function all($is_array = false)
    {
        $result = [];
        if (count($_GET) > 0)
            $result['get'] = $_GET;
        if (count($_POST) > 0)
            $result['post'] = $_POST;
        $result['file'] = $_FILES;
        return json_decode(json_encode($result), $is_array);
    }

    /**
     *
     * @param
     *            $key
     * @return $data -> $key
     */
    public static function get($key)
    {
        $object = new static();
        $data = $object->all();

        return $data->$key;
    }

    /**
     *
     * @param
     *            $key
     * @return boolean
     */
    public static function has($key)
    {
        return (array_key_exists($key, self::all(true))) ? true : false;
    }

    /**
     *
     * @param
     *            $key
     */
    public static function old($key, $value)
    {
        $object = new static();
        $data = $object->all();
        return isset($data->$key->$value) ? $data->$key->$value : '';
    }

    /**
     * Refresh Request
     */
    public static function refresh()
    {
        $_POST = [];
        $_GET = [];
        $_FILES = [];
    }
}


