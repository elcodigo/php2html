<?php
/**
 * HTML attributes give elements meaning and context.
 * The global attributes below can be used on any HTML element
 * 
 * Included New global attributes in HTML5.
 * 
 * @package PHP2HTML
 * @subpackage HTML
 * @version    1.0 BETA
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

/**
 * The accesskey attribute specifies a shortcut key to activate/focus an element.
 * <element accesskey="character">
 * 
 * @param string $var
 * @return string
 */
function acckey($var){
    return ($var=='' ? '' : ' accesskey="'.$var.'"');
}
/**
 * The class attribute is supported in all major browsers.
 * 
 * <element class="classname">
 * 
 * @param string $var
 * @return string
 */
function cClass($var){
   return ($var=='' ? '' : ' class="'.$var.'"');
}
/**
 * The dir attribute specifies the text direction of the element's content.
 * <element dir="ltr|rtl|auto">
 * 
 * @param string $var
 * @return string
 */
function dir_text($var='auto'){
    return ($var=='' ? '' : ' dir="'.$var.'"');
}

/**
 * The contenteditable attribute is supported in all major browsers.
 * HTML5 attribute
 * <element contenteditable="true|false|inherit">
 * 
 * @param string $var
 * @return string
 */
function contEdit($var=''){
    return($var=='' ? '' : ' contenteditable="'.$var.'"');
}
/**
 * The draggable attribute specifies whether an element is draggable or not.
 * HTML5 attribute
 * <element draggable="true|false|auto">
 * 
 * @param string $var
 * @return string
 */
function dragg($var=''){
    return($var=='' ? '' : ' draggable="'.$var.'"');
}
/**
 * Specifies that an element is not yet, or is no longer, relevant
 * HTML5 attribute
 * <element hidden>
 * 
 * @param string $var
 * @return string
 */
function hidden($var=''){
    return($var=='' ? '' : ' hidden');
}
/**
 * The id attribute specifies a unique id for an HTML element 
 * (the value must be unique within the HTML document).
 * <element id="id">
 * 
 * @param string $var
 * @return string
 */
function id($var=''){
   return ($var=='' ? '' : ' id="'.$var.'"');
}
/**
 * The lang attribute specifies the language of the element's content.
 * <element lang="language_code">
 * 
 * @param string $var
 * @return string
 */
function lang($var=''){
   return ($var=='' ? '' : ' lang="'.$var.'"');
}
/**
 * The spellcheck attribute specifies whether the element is to have its spelling and grammar checked or not.
 * The following can be spellchecked:
 *      Text values in input elements (not password)
 *      Text in textarea elements
 *      Text in editable elements
 * HTML5 attribute
 * <element spellcheck="true|false">
 * 
 * @param string $var
 * @return string
 */
function spellCheck($var=''){
    return($var=='' ? '' : ' spellcheck="'.$var.'"');
}
/**
 * The style attribute specifies an inline style for an element.
 * <element style="style_definitions">
 * 
 * @param string $var
 * @return string
 */
function style($var='') {        
    return ($var=='' ? '' : ' style="'.$var.'"');
}
/**
 * The tabindex attribute specifies the tab order of an element (when the "tab" button is used for navigating).
 * <element tabindex="number"> 
 * 
 * @param string $var
 * @return string
 */
function tabIndex($var=0){
    return($var==0 ? '' : ' tabindex="'.$var.'"');
}
/**
 * The title attribute specifies extra information about an element.
 * <element title="text">
 * 
 * @param string $var
 * @return string
 */
function title($var=''){
    return($var=='' ? '' : ' title="'.$var.'"');
}
?>
