<?php
namespace phuquang\Validation;

trait QNP_Helpers
{
    /**
     * isset post name
     * @param  string $name name of input
     * @return string       html checked attribute
     */
    public static function eAgreement($name)
    {
        if ( self::issetPost($name) ) {
            echo 'checked="checked"';
        }
    }

    /**
     * check value in post
     * @param  string $name    name of input
     * @param  string $value   value
     * @param  string $default default
     * @return string          html checked attribute
     */
    public static function eChecked($name, $value, $default = false)
    {
        $post = self::post($name);
        if ( $post == $value ) {
            echo 'checked="checked"';
        } elseif( $default && empty($post) ) {
            echo 'checked="checked"';
        }
    }

    /**
     * check value in post
     * @param  string $name    name of input
     * @param  string $value   value
     * @param  string $default default
     * @return string          html selected attribute
     */
    public static function eSelected($name, $value, $default = false)
    {
        $post = self::post($name);
        if ( $post == $value ) {
            echo 'selected="selected"';
        } elseif ( $default && empty($post) ) {
            echo 'selected="selected"';
        }
    }

    /**
     * check value in post
     * @param  string $name    name of input
     * @param  string $value   value
     * @param  string $default default
     * @return string          html checked attribute
     */
    public static function eCheckedbox($name, $value, $default = false)
    {
        $args = self::post($name);
        if ( is_array($args) && count($args) > 0 && in_array($value,$args) ) {
            echo 'checked="checked"';
        } elseif ( $default && empty($post) ) {
            echo 'checked="checked"';
        }
    }

    /**
     * check value in post
     * @param  string $name    name of input
     * @param  string $value   value
     * @param  string $default default
     * @return string
     */
    public static function eCheckedboxText($name, $value, $default = false)
    {
        $args = self::post($name);
        if ( is_array($args) && count($args) > 0 && in_array($value,$args) ) {
            echo '[●]';
        } elseif ( $default && empty($post) ) {
            echo '[　]';
        }
    }

    /**
     * print value and convert newline in value
     * @param  string  $name    name of input
     * @param  boolean $newline value
     * @param  boolean $return  echo or return
     * @return string
     */
    public static function eTextarea($name, $newline = false, $return = false)
    {
        if ( $post = self::post($name) ) {
            $post = self::convertNewLine($post, $newline);

            if ( $return === true) {
                return $post;
            } else {
                echo $post;
            }
        }
    }

    /**
     * return value in array if post exist in array
     * used for ratio and select
     * @param  string $name name of input
     * @param  array  $args array default
     * @return value
     */
    public static function args_msg($name, $args)
    {
        $post = self::post($name);
        if ( array_key_exists($post,$args) ) {
            return $args[$post];
        }
    }

    /**
     * return value in post array if value exist in post array
     * used for checkbox
     * @param  string $name name of input
     * @param  string $val  value default
     * @return value
     */
    public static function args_checkbox($name, $val)
    {
        $args = self::post($name);
        if ( is_array($args) && count($args) > 0 && in_array($val,$args) ) {
            return $val;
        }
    }

    /**
     * print input hidden
     * @param  string $name name of input
     * @return string
     */
    public static function hiddenInput($name)
    {
        echo "<input type='hidden' name='{$name}' value='".self::post($name)."'>";
    }

    /**
     * print input hidden
     * @param  string $name name of input
     * @param  string $args array data of input
     * @return string
     */
    public static function hiddenInputArgs($name, $args)
    {
        foreach ($args as $value) {
            echo "<input type='hidden' name='{$name}[]' value='{$value}'>";
        }
    }

    /**
     * print textarea hidden
     * @param  string $name name of input
     * @return string
     */
    public static function hiddenTextarea($name)
    {
        $value = self::post($name);
        echo "<textarea style='display:none' name='{$name}'>{$value}</textarea>";
    }

    public static function htmlInput($name = '', $type = 'text', $attrs = array())
    {
        $id    = !empty($attrs['id']) ? 'id="'.$attrs['id'].'"' : '';
        $class = !empty($attrs['class']) ? 'class="'.$attrs['class'].'"' : '';
        $placeholder  = !empty($attrs['placeholder']) ? 'placeholder="'.$attrs['placeholder'].'"' : '';
        $value = 'value="'.self::post($name).'"';
        $name  = 'name="'.$name.'"';
        $type  = 'type="'.$type.'"';
        echo "<input {$type} {$name} {$id} {$class} {$placeholder} {$value}>";
    }

    public static function htmlSelect($options = array(), $attrs = array())
    {
        $id    = !empty($attrs['id']) ? 'id="'.$attrs['id'].'"' : '';
        $class = !empty($attrs['class']) ? 'class="'.$attrs['class'].'"' : '';
        $name  = !empty($attrs['name']) ? 'name="'.$attrs['name'].'"' : '';
        $first = !empty($attrs['first']) ? '<option value="">'.$attrs['first'].'</option>' : '';
        echo "<select {$name} {$id} {$class}>";
            echo $first;
            foreach ($options as $key => $option) {
                $v = $option;
                if (is_string($key)) {
                    $v = $key;
                }
                echo '<option value="'.$v.'" ';
                self::eSelected($attrs['name'], $v);
                echo ' >'.$option.'</option>';
            }
        echo '</select>';
    }
}
