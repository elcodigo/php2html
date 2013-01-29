<?php
/**
 * Actions: Contains the common html events
 *  
 * @package PHP2HTML
 * @subpackage HTML
 * @version    1.0 BETA
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 * 
 */
/**
 * Actions: Contains the common html events
 *  
 * @package PHP2HTML
 * @subpackage actions
 * @version    1.0
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 *  
 */
class actions extends PHP2HTML{
    /**
    * Abort event property
    * @return string
    * @param string $code Javascript code to execute when the event is fired
    */
    
    function onAbort($code) {
        return ' onabort="'.htmlentities($code).'"';
    }
    /**
     * Blur event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onBlur($code) {
        return ' onblur="'.htmlentities($code).'"';
    }
    /**
     * Change event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onChange($code) {
        return ' onchange="'.htmlentities($code).'"';
    }
    /**
     * Click event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onClick($code) {
        return ' onclick="'.htmlentities($code).'"';
    }
    /**
     * Double click event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onDblClick($code) {
        return ' ondblclick="'.htmlentities($code).'"';
    }
    /**
     * Drag and drop event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onDragDrop($code) {
        return ' ondragdrop="'.htmlentities($code).'"';
    }
    /**
     * Error event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onError($code) {
        return ' onerror="'.htmlentities($code).'"';
    }
    /**
     * Focus event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onFocus($code) {
        return ' onfocus="'.htmlentities($code).'"';
    }
    /**
     * Key down event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onKeyDown($code) {
        return ' onkeydown="'.htmlentities($code).'"';
    }
    /**
     * Key press event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onKeyPress($code) {
        return ' onkeypress="'.htmlentities($code).'"';
    }
    /**
     * Key up event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onKeyUp($code) {
        return ' onkeyup="'.htmlentities($code).'"';
    }
    /**
     * Load event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onLoad($code) {
        return ' onload="'.htmlentities($code).'"';
    }
    /**
     * Mouse down event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onMouseDown($code) {
        return ' onmousedown="'.htmlentities($code).'"';
    }
    /**
     * Mouse move event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onMouseMove($code) {
        return ' onmousemove="'.htmlentities($code).'"';
    }
    /**
     * Mouse out event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onMouseOut($code) {
        return ' onmouseout="'.htmlentities($code).'"';
    }
    /**
     * Mouse over event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onMouseOver($code) {
        return ' onmouseover="'.htmlentities($code).'"';
    }
    /**
     * Mouse up event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onMouseUp($code) {
        return ' onmouseup="'.htmlentities($code).'"';
    }
    /**
     * Move event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onMove($code) {
        return ' onmove="'.htmlentities($code).'"';
    }
    /**
     * Reset event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onReset($code) {
        return ' onreset="'.htmlentities($code).'"';
    }
    /**
     * Resize event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onResize($code) {
        return ' onresize="'.htmlentities($code).'"';
    }
    /**
     * Select event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onSelect($code) {
        return ' onselect="'.htmlentities($code).'"';
    }
    /**
     * Submit event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onSubmit($code) {
        return ' onsubmit="'.htmlentities($code).'"';
    }
    /**
     * Unload event property
     * @return string
     * @param string $code Javascript code to execute when the event is fired
     */
    function onUnload($code) {
        return ' onunload="'.htmlentities($code).'"';
    }
}   

?>
