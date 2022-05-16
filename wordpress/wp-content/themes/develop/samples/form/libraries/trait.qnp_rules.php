<?php
namespace phuquang\Validation;

trait QNP_Rules
{
    /**
     * [Value is exist]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _required($str)
    {
        if ( $str === '' || $str === null ) {
            return true;
        }
        return false;
    }

    /**
     * [Value is elder condition]
     * @param  [string]  $str [Input]
     * @param  [integer] $max [Condition]
     * @return [true]         [is error]
     */
    private function _max($str,$max)
    {
        if ( intval($str) > intval($max) ) {
            return true;
        }
        return false;
    }

    /**
     * [Value is lesser condition]
     * @param  [string]  $str [Input]
     * @param  [integer] $min [Condition]
     * @return [true]         [is error]
     */
    private function _min($str,$min)
    {
        if ( intval($str) < intval($min) ) {
            return true;
        }
        return false;
    }

    /**
     * [Value is elder condition]
     * @param  [string]  $str [Input]
     * @param  [integer] $max [Condition]
     * @return [true]         [is error]
     */
    private function _lengthmax($str,$max)
    {
        if ( mb_strlen($str, 'UTF-8') > intval($max) ) {
            return true;
        }
        return false;
    }

    /**
     * [Value is lesser condition]
     * @param  [string]  $str [Input]
     * @param  [integer] $min [Condition]
     * @return [true]         [is error]
     */
    private function _lengthmin($str,$min)
    {
        if ( mb_strlen($str, 'UTF-8') < intval($min) ) {
            return true;
        }
        return false;
    }

    /**
     * [zipcode format exactly]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     *
     */
    private function _zipcode($str)
    {
        if ( ! preg_match('/^(\d{3}[\s-]?\d{4})$/', $str) ) {
            return true;
        }
        return false;
    }

    /**
     * [hiragana format exactly]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _hiragana($str)
    {
        if ( !preg_match('/([ぁ-ん゛ゝゞ]+)/', $str) ) {
            return true;
        }
        return false;
    }

    /**
     * [katakana format exactly]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _katakana($str)
    {
        $pattern = "/^([゠ァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶヷヸヹヺ・ーヽヾヿ　]+)$/u";
        if ( !preg_match($pattern, $str) ) {
            return true;
        }
        return false;
    }

    /**
     * [email format exactly]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _email($str)
    {
        if ( !filter_var($str, FILTER_VALIDATE_EMAIL) ) {
            return true;
        }
        return false;
    }

    /**
     * [phone format exactly]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _phone($str)
    {
        if ( !preg_match('/^(\d|\+)(\d{2,4}[\s-]?\d{2,4}[\s-]?\d{2,4})$/', $str) ) {
            return true;
        }
        return false;
    }

    /**
     * [number format exactly]
     * @param  [number] $str [Input]
     * @return [true]        [is error]
     */
    private function _number($str)
    {
        if ( preg_match('/\D/', $str) ) {
            return true;
        }
        return false;
    }

    /**
     * [url format exactly]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _url($str)
    {
        if ( ! preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $value) ) {
            return true;
        }
        return false;
    }

    /**
     * [fullwidth format exactly]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _fullwidth($str)
    {
        if ( !preg_match('/^[^ -~｡-ﾟ\x00-\x1f\t]+$/u', $str) ) {
            return true;
        }
        return false;
    }

    /**
     * [number fullwidth format exactly]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _numfullwidth($str)
    {
        if ( preg_match('/０|１|２|３|４|５|６|７|８|９/', $str) ) {
            return true;
        }
        return false;
    }

    /**
     * [date format exactly]
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _dateformat($str)
    {
        if ( ! preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", $str) ) {
            return true;
        }
        return false;
    }

    /**
     * Use long passwords (8-20) with letters, CAPS, numbers and sybols
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _passwordstrength($str)
    {
        if ( ! preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $str) ) {
            return true;
        }
        return false;
    }

    /**
     * Use long passwords (8-20) with letters, CAPS and numbers
     * @param  [string] $str [Input]
     * @return [true]        [is error]
     */
    private function _passwordstrengthnotsymbols($str)
    {
        if ( ! preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $str) ) {
            return true;
        }
        return false;
    }

    /**
     * Use long passwords (8-20) with letters, CAPS and numbers
     * @param  [string] $str [Input]
     * @return [string]      [is error]
     */
    private function _passwordstrengthtomessage($str)
    {
        $errors = array();
        if( strlen($pwd) < 8 ) {
            $errors[] = "too short";
        }

        if( strlen($pwd) > 20 ) {
            $errors[] = "too long";
        }

        if( !preg_match("#[0-9]+#", $pwd) ) {
            $errors[] = "must include at least one number";
        }

        if( !preg_match("#[a-z]+#", $pwd) ) {
            $errors[] = "must include at least one letter";
        }

        if( !preg_match("#[A-Z]+#", $pwd) ) {
            $errors[] = "must include at least one CAPS";
        }

        if( !preg_match("#\W+#", $pwd) ) {
            $errors[] = "must include at least one symbol";
        }

        if ( count($errors) !== 0 ) {
            return "Password validation failure(your choise is weak): " . implode(',', $errors);
        }
        return false;
    }
}
