<?php
namespace phuquang\Validation;

class QNP_Form
{
    use QNP_Rules, QNP_Methods, QNP_Errors,
        QNP_Filters, QNP_Helpers;
    public $method = '';
    public $fields = array();
    public $field = null;
    public $errors = array();
    public static $default_filters = array('mb_trim', 'strip_tags');

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function setFilters($args)
    {
        self::$default_filters = $args;
    }

    /**
     * Add new field
     * @param  string $name  name of input
     * @param  string $label label of input
     */
    public function name($name, $label = '')
    {
        $this->field = new QNP_Field($name, $label);
        $this->fields[$name] = $this->field;
        return $this;
    }

    /**
     * Add custom field
     * @param  string $name  name of input
     * @param  string $label label of input
     */
    public function addField($name, $label = '', $value = '')
    {
        $this->field = new QNP_Field($name, $label, $value);
        $this->fields[$name] = $this->field;
        return $this;
    }

    /**
     * get all field data
     * @param  string $name  name of input
     * @param  string $label label of input
     */
    public function getAllData()
    {
        $args = array();
        foreach ($this->fields as $key => $field) {
            $args[$key] = $field->value;
        }
        return $args;
    }

    /**
     * Call trait qnp_rules
     * @param  string $method method name
     * @param  array  $args   attribute
     */
    public function rule($method, $args)
    {
        if ( method_exists($this, "_{$method}") ) {
            $this->fields[$this->field->name]->rules[] = $method;
            $message = isset($args[0]) ? $args[0] : '';
            // Remove message value
            unset($args[0]);
            // Add input value
            $parameters = array_merge(array($this->field->value), $args);
            if ( call_user_func_array(array($this, "_{$method}"), $parameters) ) {
                // true is error
                $this->addError($this->field->name, $method, $message);
            }
        }
        return $this;
    }

    /**
     * Call methods
     * @param  string $method method name
     * @param  array  $args   attribute
     */
    public function __call($method, $args)
    {
        try {
            if ( method_exists($this, "_{$method}") ) {
                // Call trait qnp_rules
                $this->rule($method, $args);
            } elseif ( property_exists($this, "_{$method}") && is_callable(array($this, "_{$method}")) ) {
                $this->fields[$this->field->name]->rules[] = $method;
                // call closure methods
                call_user_func_array($this->{"_{$method}"}, array($this->field, $args));
            } else { // else throw exception
                throw new Exception("method _$method exists?");
            }
        } catch (Exception $e) {
            echo '<p>Caught exception: ', $e->getMessage(), "</p>\n";
        }
        return $this;
    }

    /**
     * redirect to url
     * @param  string $path url
     */
    public function redirect($path)
    {
        header("Location: ".$path,TRUE,302);
        exit();
    }

    public function __destruct()
    {
        $this->field = null;
        // print "Destroying " . __CLASS__ . "\n";
    }
}
