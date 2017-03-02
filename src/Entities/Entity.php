<?php
namespace Settlement\GMO\Payment\Gateway\Entities;

/**
 * Class Entity
 * @package Settlement\GMO\Payment\Gateway\Entities
 */
class Entity implements \ArrayAccess
{
    /** @var array */
    protected $attributes = [];

    /** @var array */
    protected $errors = [];
    /**
     * Entity constructor.
     * @param string|array|null $properties string must http_build_query() string
     */
    public function __construct($properties = null)
    {
        if(is_null($properties)) {
            return;
        }

        if(is_array($properties)) {
            $attributes = $properties;
        } else {
            parse_str($properties, $attributes);
        }

        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        $accessor = "get{$name}Attribute";
        if (method_exists($this, $accessor)) {
            return $this->$accessor();
        }
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
        return null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $mutator = "set{$name}Attribute";
        if (method_exists($this, $mutator)) {
            $this->$mutator($name, $value);
        }
        $this->attributes[$name] = $value;
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->attributes[$name]);
    }

    protected function setErrCodeAttribute($name, $value)
    {
        $errorCodes = explode('|', $value);
        foreach ($errorCodes as $i => $code) {
            $this->errors[$i]['code'] = $code;
        }
    }

    protected function setErrInfoAttribute($name, $value)
    {
        $errorInformation = explode('|', $value);
        foreach($errorInformation as $i => $info) {
            $this->errors[$i]['info'] = $info;
        }
    }

    public function errors()
    {
        $errors = [];
        if(!$this->has('ErrInfo')) {
            return $errors;
        }
        $code = explode('|', $this->ErrCode);
        $info = explode('|', $this->ErrInfo);
        foreach($code as $i => $c) {
            $errors[$c][] = $info[$i];
        }
        return $errors;
    }

    public function __toString()
    {
        return json_encode($this->attributes);
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

}