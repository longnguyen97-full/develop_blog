<?php
namespace phuquang\Validation;

class QNP_Field
{
    use QNP_Methods;
    public $name;
    public $label;
    public $value;

    /**
     * set name, label and auto get value
     * @param string $name
     * @param string $label
     */
    public function __construct($name, $label, $value = '')
    {
        $this->name = $name;
        $this->label = $label;
        if (!empty($value)) {
            $this->value = $value;
        } else {
            $this->setValue($this->name);
        }
    }

    /**
     * set name field
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * set label field
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * set value field
     * auto get value from post method
     * @param string $name
     */
    public function setValue($name)
    {
        if ( $this->methodIsPost() && $this->issetPost($name) ) {
            $this->value = $this->post($name);
        }
    }
}
