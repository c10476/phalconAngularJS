<?php
class Base extends \Phalcon\Mvc\Model {
    public function getSource()
    {
        return 'vo_'.strtolower(get_class($this));
    }
}