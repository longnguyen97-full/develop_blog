<?php
namespace phuquang\Validation;

trait QNP_Methods
{
    /**
     * Check method is post
     * @return boolean
     */
    public static function methodIsPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Check method is get
     * @return boolean
     */
    public static function methodIsGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * get value from post
     * @return value
     */
    public static function post($name = '', $return = true, $filter_list = array())
    {
        $value = null;
        if ( array_key_exists($name, $_POST) ) {
            $value = $_POST[$name];
        }
        if ( ! empty(self::$default_filters)) {
            $value = self::filter($value, self::$default_filters);
        }

        if ( ! empty($value) && ! empty($filter_list)) {
            $value = self::filter($value, $filter_list);
        }

        if ( $return === true) {
            return $value;
        } else {
            echo $value;
        }
    }

    /**
     * get value from get
     * @return value
     */
    public static function get($name = '', $return = true, $filter_list = array())
    {
        $value = null;
        if ( array_key_exists($name, $_GET) && ! empty($_GET[$name]) ) {
            $value = $_GET[$name];
        }

        if ( ! empty(self::$default_filters)) {
            $value = self::filter($value, self::$default_filters);
        }

        if ( ! empty($value) && ! empty($filter_list)) {
            $value = self::filter($value, $filter_list);
        }

        if ( $return === true) {
            return $value;
        } else {
            echo $value;
        }
    }

    /**
     * Check name exist in post
     * @return boolean
     */
    public static function issetPost($name = '')
    {
        if ( array_key_exists($name, $_POST) ) {
            return true;
        }
        return false;
    }

    /**
     * Check name exist in get
     * @return boolean
     */
    public static function issetGet($name = '')
    {
        if ( array_key_exists($name, $_GET) ) {
            return true;
        }
        return false;
    }

    /**
     * Filter value
     * @return value
     */
    public static function filter($value, $filter_list = array())
    {
        foreach ($filter_list as $method_name) {
            if ($method_name === 'trim') {
                $value = trim($value);
            }

            if ($method_name === 'mb_trim') {
                $value = self::mb_trim($value);
            }

            if ($method_name === 'stripslashes') {
                $value = stripslashes($value);
            }

            if ($method_name === 'htmlentities') {
                $value = htmlentities($value);
            }

            if ($method_name === 'htmlspecialchars') {
                $value = htmlspecialchars($value);
            }

            if ($method_name === 'sql_escape') {
                $value = sql_escape($value);
            }

            if ($method_name === 'mysqli_real_escape_string') {
                $value = mysqli_real_escape_string($value);
            }

            if ($method_name === 'addslashes') {
                $value = addslashes($value);
            }

            if ($method_name === 'strip_tags') {
                $value = strip_tags($value);
            }
        }
        return $value;
    }
}
