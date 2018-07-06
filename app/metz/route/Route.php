<?php
namespace Metz\app\metz\route;

use Metz\app\metz\exceptions;

abstract class Route
{
    public abstract function exec();
    public abstract function match($uri);

    protected $_prefix = '';
    protected $_uri = null;
    protected $_uri_array = null;
    protected $_klass = null;
    protected $_method = null;
    protected $_args = [];

    public function __construct($uri, $klass, $method = null)
    {
        $this->_set_uri($uri);
        if ($klass) {
            if (class_exists($klass)) {
                $this->_klass = $klass;
            } else {
                $this->_prefix = $klass;
            }
        }
        $this->_method = $method;
    }

    public function get_uri()
    {
        return $this->_uri;
    }

    public function get_uri_array()
    {
        return $this->_uri_array;
    }

    protected function _set_class($klass)
    {
        if ($klass === null || !class_exists($klass)) {
            throw new exceptions\http\NotFound(
                'route configure error: ' . $this->_uri
                . ' has no expect class: ' . var_export($klass)
            );
        }
        $this->_klass = $klass;
        return $this;
    }

    protected function _set_uri($uri)
    {
        $this->_uri = trim($uri) == '/' ? '/' : trim($uri, '/');
        $this->_uri_array = explode('/', $this->_uri);
        return $this;
    }
}