<?php
/**
 * HTML attributes give elements meaning and context.
 * The extended attributes below can be used only on specific HTML element
 * 
 * Included New attributes in HTML5.
 * 
 * @package PHP2HTML
 * @subpackage HTML
 * @version    1.0 BETA
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

/**
 * Specify a URI for an external file or resource.
 * <element src="value">
 * 
 * @param string $var
 * @return string
 */
function src($var){
    return ($var=="" ? "" : ' src="'.$var.'"');
}
/**
 * The name attribute specifies the name of an input element 
 * <element name="text"> 
 * 
 * @param string $var
 * @return string
 */
function name($var=''){
    return ($var=="" ? "" : ' name="'.$var.'"');
}
/**
 * Specify the height of the element
 * Supports iframe, img and object elements 
 * <element height="value">
 * 
 * @param string $var
 * @return string
 */
function height($var=''){
    return ($var=="" ? "" : ' height="'.$var.'"');
} 
/**
 * Specify the width of the element
 * Supports iframe, img and object elements 
 * <element width="value">
 * 
 * @param string $var
 * @return string
 */
function width($var=''){
    return ($var=="" ? "" : ' width="'.$var.'"');
}
/**
 * Specify a window where the associated document will be displayed
 * Supports a, area, base, form, link element. 
 * <element target="_blank|_self|_parent|_top">
 * 
 * @param string $var
 * @return string
 */
function target($var=''){
    return ($var=="" ? "" : ' target="'.$var.'"');
}
/**
 * Specify the initial width (in pixels / characters) for input field and number of visible rows for select element. 
 * Supports hr, input and select elements.
 * <element size="value">
 * 
 * @param type $var
 * @return type
 */
function size($var=''){
    return ($var=="" ? "" : ' size="'.$var.'"');
}
/**
 * The method attribute specifies how to send form-data (the form-data is sent to the page specified in the action attribute).
 * <form method="get|post">
 * 
 * @param type $var
 * @return type
 */
function method($var='') {
    return ($var=="" ? "" : ' method="'.$var.'"');
}
/**
 * Specify the current value for an input type.
 * For other elements the value is only avaiable as form values when submitted.
 * <element value="value">
 * 
 * @param type $var
 * @return type
 */
function value($var='') {
    return ($var=="" ? "" : ' value="'.$var.'"');
}
/**
 * Define the vertical alignment of content of a table cell
 * Supports col, colgroup, tbody, td, tfoot, th, thead, tr elements.
 * <element valign="top|middle|bottom|baseline">
 * 
 * @param type $var
 * @return type
 */
function valign($var='') {
    return ($var=="" ? "" : 'valign="'.$var.'"');
}
/**
 * The action attribute specifies where to send the form-data when a form is submitted.
 * <form action="URL"> 
 * 
 * @param type $var
 * @return type
 */
function action($var='') {
    return ($var=="" ? "" : ' action="'.$var.'"');
}
/**
 * Specify the alignment of data and the justification of text in a cell of a table and other elements
 * <element align="left|center|right|justify*|char*">
 * 
 * @param type $var
 * @return type
 */
function align($var='') {
    return ($var=="" ? "" : ' align="'.$var.'"');
}
?>
