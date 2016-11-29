<?php

/**
 * Version-independent Component class.
 *
 * @version 1.11
 */
class Subsys_Templier_Component_Independent
{
    var $templier       = null;  // set by runComponent()
    var $croakOffset    = 6;
    var $globalValidity = null;

    function Subsys_Templier_Component_Independent()
    {
      // Be ready to be called without arguments - child
      // classes may contain mistakes and not call parent constructor.
    }

    /**
     * Drop error message to template context.
     */
    function croak($msg, $level=E_USER_ERROR)
    {
        $this->templier->smarty->trigger_error("croak[{$this->croakOffset}]: $msg", $level);
    }

    /**
     * Drop error message to caller context.
     */
    function confess($msg, $level=E_USER_ERROR)
    {
        $this->templier->smarty->trigger_error("croak[1]: $msg", $level);
    }

    /**
     * Entry point of component.
     */
    function _generate($params)
    {
        // Try to load from the cache.
        $cache  = $this->getCache(array(
            "GLOBAL COMPONENT CACHE",  // any characters
            filemtime(__FILE__),       // this file mtime
            $params                    // component parameters
        ));
        $result = $cache->retrieve();
        if ($result !== null) return $result;

        // Call generator.
        $result = $this->main($params);
        if ($result === false) return $result;

        // Store cache if validity is present.
        if ($this->globalValidity)
            $cache->store($result, $this->globalValidity);

        return $result;
    }

    /**
     * Return named cache object for THIS COMPONENT personally.
     */
    function getCache($deps=null)
    {
        return $this->templier->getCache($deps, get_class($this));
    }

    /**
     * Set THIS COMPONENT validity object.
     */
    function setValidity(&$validity)
    {
        $this->globalValidity =& $validity;
        return true;
    }
}


/**
 * Version-dependent code. PHP4 does not support "abstract".
 */
if (version_compare(phpversion(), "5.0.0") >= 0) {
    eval('
        abstract class Subsys_Templier_Component extends Subsys_Templier_Component_Independent
        {
            abstract function main($params);
        }
    ');
} else {
    eval('
        class Subsys_Templier_Component extends Subsys_Templier_Component_Independent
        {
            function main($params) {
                trigger_error("Pure virtual function called!", E_USER_ERROR);
                return;
            }
        }
    ');
}

?>