<?php
require_once "Subsys/Templier/Component.php";

/**
 * Abstract class.
 * This class is fully filename-independent: it works with URIs only!
 * The exception is Component URIs which is translated
 *
 * @version 1.12
 */
class Subsys_Templier_Main
{
    /**
     * Pragma name prefix.
     */
    var $PRAGMA_PRE = "@";

    /**
     * Config block names.
     */
    var $PRAGMA_LAYOUT   = "Layout";        // page layout name
    var $PRAGMA_OUTPUT   = "Output";        // this block will be printed to browser

    /**
     * Contexts.
     */
    var $rootContext    = null;      // Root context (ex. "/")
    var $requestContext = null;      // Request context.
    var $context        = null;      // Current context.

    /**
     * All the blocks array.
     */
    var $_blocks  = array();

    /**
     * Config data.
     */
    var $config = array();


    /**
     *****
     **** Templier API.
     ***
     */
    var $_______publics________; // dummy (for phpEd code explorer)

    /**
     * Constructor.
     */
    function Subsys_Templier_Main($uriRoot)
    {
        $this->config = array_merge($this->config, array(
            'index'    => array('index\..+'),
            'modifier' => array('.*' => array(
                "Subsys_Templier_Main::_modifier_DelEmptyLines",
                "Subsys_Templier_Main::_modifier_DelTabs",
            )),
            'path'     => array(),
        ));
        $this->rootContext =& $this->createContext($uriRoot);
        $this->_switchContext($this->rootContext);
    }

    /**
     * Context findContext($abs_or_relative_uri)
     * Search for name in @Path. Return found context or NULL if nothing is found.
     */
    function findContext($name)
    {
        if ($this->rootContext->isAbsolute($name))
            return $this->createContext($name);
        $inc = array_merge(
            array($this->context->uri),
            $this->config['path']
        );
        foreach($inc as $r) {
            $path = $this->context->gluePath($r, $name);
            $c = $this->createContext($path);
            if ($c->isValid()) return $c;
        }
        return null;
    }

    /**
     * list(Block) findBlocks($blockName)
     * Return ALL blocks with specified name. Case-insensetive.
     */
    function findBlocks($name)
    {
        $name = strtolower($name);
        if (!isset($this->_blocks[$name])) return array();
        return $this->_blocks[$name];
    }

    /**
     * Block findBlock($blockName)
     * Return the latest block.
     */
    function findBlock($name)
    {
        $blk = $this->findBlocks($name);
        if (!$blk) return null;
        return $blk[count($blk)-1];
    }

    /**
     * string getBlockBody($blockName)
     * Return the latest block body.
     */
    function getBlockBody($name)
    {
        $blk = $this->findBlock($name);
        if (!$blk) return null;
        return $blk->value;
    }

    /**
     * list(string) getBlockBodies($blockName)
     * Return list of block bodies. Case-insensetive.
     */
    function getBlockBodies($name)
    {
        $blks = $this->findBlocks($name);
        $bodies = array();
        foreach ($blks as $blk) $bodies[] = $blk->value;
        return $bodies;
    }

    /**
     * void addBlock($name, $value, $isRaw, callback $callbackBodyName)
     * Add the new block to the block list. Body MUST be specified.
     * Currend block is not switched.
     */
    function addBlock($name, $value, $isRaw=false)
    {
        $name = trim(strval($name));
        if ($name === "") return;
        // Initializing the new block.
        $newBlock =& new Subsys_Templier_Block();
        $newBlock->name    = $name;
        $newBlock->value   = $value;
        $newBlock->raw     = $isRaw;
        $newBlock->context =& $this->context;
        // Run modifiers.
        if (!$this->_preprocessBlock($newBlock)) return;
        $this->_blocks[strtolower($name)][] = $newBlock;
    }

    /**
     * Load & parse the block file. All blocks of this file
     * will be added to block list. If there was current block,
     * it will be placed AFTER all the blocks in loaded file.
     */
    function loadUri($uri, $args=null)
    {
        // Create the new context by its URI, inheriting previous context data.
        $newContext = $this->findContext($uri);
        if (!$newContext || !$newContext->isValid()) 
           return $this->error("couldn't open \"$uri\"!");

        // Activate the new context.
        $oldContext =& $this->_switchContext($newContext);

        // Run the file.
        $newContext->run($args);

        // Switches the context back.
        $this->_switchContext($oldContext);

        return $newContext->uri;
    }

    /**
     * string runUri($uri)
     * Main Templier function. Process specified $uri and return the contents
     * of Output block. Nothing is printed to stdout, except warnings, maybe.
     */
    function runUri($uri=null)
    {
        $this->requestContext = $this->findContext($uri);
        if (!$this->requestContext->isValid()) return null;
        $this->_switchContext($this->requestContext);

        // Collects all the blocks from subdirs.
        $this->_collectBlocks($this->requestContext);

        // Fing & run the main layout. We must do it at the end,
        // ro make all the blocks to be accessible. Tamplate - is usual
        // text file with REQUIRED block Output.
        $tmpl = $this->getBlockBody($this->PRAGMA_PRE.$this->PRAGMA_LAYOUT);
        if (!$tmpl) return $this->error(
            "Cannot find the layout for <b>$uri</b> ".
            "(have you defined <tt>{$this->PRAGMA_PRE}{$this->PRAGMA_LAYOUT}</tt> block?)"
        );
        $this->loadUri($tmpl);

        // Returns Output block.
        $out = $this->getBlockBody($this->PRAGMA_PRE.$this->PRAGMA_OUTPUT);
        if (!$out) return $this->error(
            "No output from layout <b>$tmpl</b> ".
            "(have you defined <tt>{$this->PRAGMA_PRE}{$this->PRAGMA_OUTPUT}</tt> block?)"
        );
        return $out;
    }


    /**
     * mixed runComponent($className, mixed $params)
     * Ñall specified Ñomponent ($className::main).
     * Component class must be already loaded before.
     * Return result of static main() method.
     */
    function runComponent($class, $params)
    {
        $base = "Subsys_Templier_Component";
        $component = new $class(&$this);
        // Use DIRECT assignment in case child Component constructor
        // does not run Subsys_Templier_Component_Independent constructor.
        $component->templier =& $this;
        if (!is_a($component, $base)) {
            return $this->error("Component class $class is not derived from $base.");
        }
        $result = $component->_generate($params);
        return $result;
    }


    /**
     * Called on error.
     */
    function error($msg)
    {
        die("Templier: $msg");
    }

    /**
     *****
     **** Abstracts.
     ***
     */
    var $_______abstracts_______; // dummy (for phpEd code explorer)

    /**
     * Context& createContext($absoluteUri)
     * Create the new context. This function may be overriden in derived classes.
     */
    function createContext($uri)
    {
        $this->error("createContext(): pure function called");
    }

    /**
     * Cache_File getCache(mixed $deps, string $humenReadableText)
     * Return dependent cache object.
     */
    function getCache($deps, $human=null)
    {
        $this->error("getCache(): pure function called");
    }


    /**
     *****
     **** Private functions.
     ***
     */
    var $_______privates________;  // dummy (for phpEd code explorer)


    /**
     * Switche the templier context to another.
     * Return previous active context.
     */ 
    function& _switchContext(&$context)
    {
        if ($context->activate($this->context) === false)
            return $this->context;
        $old =& $this->context;
        $this->context =& $context;
        return $old;
    }

    /**
     * void _collectBlocks($context)
     * This function walks down through the site tree & loads
     * all the block files from parent contexts.
     */
    function _collectBlocks($context)
    {
        // If we are NOT at "/", use up-dir.
        if (!$context->isRoot()) {
            $parent = $context->getParent();
            $this->_collectBlocks($parent);
        }
        // Load own blocks.
        $this->loadUri($context->uri);
    }

    /**
     * Process the block before adding th the list. For example, pragmas processing.
     * Return false if block must be dropped.
     */
    function _preprocessBlock(&$blk)
    {
        // Complex (non-scalar) blocks are not processed.
        if (is_array($blk->value) || is_object($blk->value)) return true;

        // Check for pragma.
        $name = strtolower($blk->name);
        if (strpos($name, $this->PRAGMA_PRE) === 0) {
            $pragma = substr($name, strlen($this->PRAGMA_PRE));
            $func = "_pragma_".ucfirst($pragma);
            if (method_exists($this, $func)) {
                $r = call_user_func(array(&$this, $func), &$blk);
                if (!$r) return false;
            }
        }

        // Run modifiers.
        if ($blk->raw) return true;
        foreach (array_reverse($this->config['modifier']) as $re=>$codes) {
            if (!preg_match("/^(?:$re)$/si", $blk->name)) continue;
            foreach (array_reverse($codes) as $code) {
                list ($cls, $name) = explode("::", $code);
                if (!$name) { $name = $cls; $cls = null; }
                $blk->value = call_user_func($cls? array($cls, $name) : $name, $blk->value, &$this, $blk);
                if ($blk->value === false) return false;
            }
        }

        // All done.
        return true;
    }

    /**
     * string _makeRe($shellMash)
     * Create RE from shell mask (*.txt -> .*\.txt, for example).
     * If mask looks like '/.../', it is treated as RE itself.
     */
    function _makeRe($mask)
    {
        $mask = trim($mask);
        if (preg_match('{^/(.*)/$}', $mask, $p)) return $p[1];
        $mask = preg_quote($mask, '/');
        $mask = str_replace(
            array('\\*', '\\?'),
            array('.*',  '.'  ),
            $mask
        );
        return $mask;
    }


    /**
     *****
     **** Protected pragmas.
     ***
     */
    var $_______pragmas_______;  // dummy (for phpEd code explorer)

    /**
     * Pragma @Inc.
     */
    function _pragma_Inc(&$blk) 
    {
        $blk->name = $this->PRAGMA_PRE."Path";
        return $this->_pragma_Path($blk);
    }

    /**
     * Pragma @Path.
     */
    function _pragma_Path(&$blk)
    {
        $context = $blk->context->getRelative(trim($blk->value));
        if (!$context) return true;
        $blk->value = $context->uri;
        $this->config['path'][] = $context->uri;
        return true;
    }

    /**
     * Pragma @Index
     */
    function _pragma_Index(&$blk)
    {
        $blk->value = trim($blk->value);
        $re = $this->_makeRe($blk->value);
        $this->config['index'][] = "(?:$re:)";
        return true;
    }

    /**
     * Pragma @Modifier
     */
    function _pragma_Modifier(&$blk)
    {
        $blk->value = trim($blk->value);
        list ($ex, $code) = preg_split('/\s+/', $blk->value, 2);
        $this->config['modifier'][$this->_makeRe($ex)][] = $code;
        return true;
    }

    /**
     * Pragma @Include
     */
    function _pragma_Include(&$blk)
    {
        $this->loadUri(trim($blk->value));
        return false;
    }


    /**
     *****
     **** Modifiers.
     ***
     */
    var $_______modifiers_______; // dummy (for phpEd code explorer)

    /**
     * Trim the spaces & prepended tabs.
     * Now you can easily format HTML-êîä with tab.
     */
    function _modifier_DelTabs($st)
    {
        return preg_replace("/^\t*/m", "", $st);
    }

    /**
     * Remove leading and training spaced lines.
     */
    function _modifier_DelEmptyLines($st) {
        return rtrim(preg_replace('/^(?:[ \t]*[\r\n]+)+/sx', '', $st));
    }
}


/**
 * Templier block.
 */
class Subsys_Templier_Block 
{
    var $context = null;             // this block context (set at the end of processing)
    var $name;                       // name of the block
    var $value  = "";                // block body contents
    var $raw    = false;             // do not apply modifiers to this block

    /**
     * Return block data without references (for dumping and output).
     */
    function getDump() 
    {
        return array(
            'name'    => $this->name,
            'value'   => $this->value,
            'context' => $this->context->getDump(),
        );
    }
}


/**
 * Abstract class.
 * Information about current processing file (or directory).
 */
class Subsys_Templier_Context {
    // Properties.
    var $owner  = null;      // Templier object
    var $uri    = null;      // full URI (may be directory)
    var $query  = null;      // query-string
    var $curBlk = null;      // current handled block

    /**
     * Constructor. May use only ABSOLUTE uris.
     */
    function Subsys_Templier_Context($uri, &$owner)
    {
        if (!$this->isAbsolute($uri)) return;
        $this->owner =& $owner;
        $parts = $this->splitQuery($uri);
        $this->uri = $parts[0];
        if (count($parts) > 1) $this->query = $parts[1];
        $this->uri = $this->delDots($this->uri);
    }

    /**
     * Return context relative to current DIRECTORY.
     * Example: getRelative("../../file").
     */
    function& getRelative($name)
    {
        if ($this->isAbsolute($name)) {
            $context =& $this->owner->createContext($name);
            return $context;
        }
        if (!$this->isDir()) $cur = $this->dirname($this->uri);
        else $cur = $this->uri;
        $c = $this->owner->createContext($this->gluePath($cur, $name));
        if ($c->isValid()) return $c;
        return null;
    }

    /**
     * Return parent context.
     */
    function getParent()
    {
        return $this->owner->createContext($this->dirname($this->uri));
    }

    /**
     * Check for context existance.
     */
    function isValid()
    {
        return $this->uri !== null;
    }

    /**
     * Return true if URI part matches the SCRIPT_NAME.
     */
    function isActive()
    {
        $a = $this->getCanonizedUri(true);
        $b = $this->owner->requestContext->getCanonizedUri(true);
        return $a == $b;
    }

    /**
     * Return true if URI matches EXACTLY REQUEST_URI.
     */
    function isCurrent()
    {
        $a = $this->getCanonizedUri();
        $b = $this->owner->requestContext->getCanonizedUri();
        return $a == $b;
    }

    /**
     * string canonizeUri()
     * Translate URI to shortest canonical name:
     *   foo/index.html -> foo/
     */
    function getCanonizedUri($noQuery = false)
    {
        $basename = $this->basename($this->uri);
        $indexRe = join('|', $this->owner->config['index']);
        if (preg_match("{^(?:$indexRe)$}s", $basename)) {
            $uri = substr($this->uri, 0, -strlen($basename));
        } else {
            $uri = $this->uri;
        }
        if ($noQuery) return $uri;
        return $uri . ($this->query !== null? '?'.$this->query : '');
    }


    /**
     * Return context data without references (for templates).
     */
    function getDump() {
        return array(
            'uri'      => $this->getCanonizedUri(),
            'active'   => $this->isActive(),
            'current'  => $this->isCurrent()
        );
    }


    //
    // Abstract.
    //

    /**
     * Returns true if the URI is folder.
     */
    function isDir()
    {
        $this->owner->error("isDir(): pure function called. Too few information at this time.");
    }

    /**
     * Activate this context.
     * Called before running this context.
     * If this method return === false, activation is cancelled.
     */
    function activate(&$old)
    {
        $this->owner->error("activate(): pure function called.");
    }


    //
    // URI grammar.
    //

    function dirname($uri)
    {
        return str_replace('\\', '/', dirname($uri));
    }

    function basename($uri)
    {
        return basename($uri);
    }

    function gluePath($a, $b)
    {
        return $a . ($a{strlen($a)-1} == '/'? '' : '/') . $b;
    }

    function isAbsolute($uri)
    {
        if (strval($uri) === "") return false;
        return $uri{0} == '/';
    }

    function delDots($uri)
    {
        return File_Path::absPath($uri);
    }

    function splitQuery($url)
    {
        return explode('?', $url, 2);
    }

    // Return true if this is a root context.
    function isRoot()
    {
        return $this->uri == "/" || preg_replace('{/+$}s', '', $this->uri) == preg_replace('{/+$}s', '', $this->owner->rootContext->uri);
    }
}

?>