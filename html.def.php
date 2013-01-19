<?php
/**
 * Contains the default constants used by the class
 * 
 * Edit only if you understand the functionality
 *  
 * @package PHP2HTML
 * @version    1.0 BETA
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 *  
 */
/**
 * Named constant for Document type
 */
define('DOC_TYPE','<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'."\r\n". '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">');
/**
 * Named constant for default language document
 */
define('HTML_LANG'      ,'en');
/**
 * Named constant for default content-type document
 */
define('META_CONTENT'   ,'text/html');
/**
 * Named constant for default charset encode document
 */
define('META_CHARSET'   ,'utf-8');
/**
 * Named constant for default page title
 */
define('META_TITLE'     ,'PHP2HTML');
/**
 * Named constant for default page description
 */
define('META_DESC'      ,'Library that allows you to write html pages using only PHP code. With support for SQL, MySQL and Oracle');
/**
 * Named constant for default keywords page
 */
define('META_KEYWORD'   ,'MVC, PHP, Class, Web, Vista, Controller, Framework, MySQL, Oracle, MSSQL, PHP2HTML, PHP, HTML, Convert');
/**
 * Named constant for default page author.(You) :)
 */
define('META_AUTHOR'    ,'Manuel González R');
/**
 * Named constant for default robots page action
 * NOINDEX, FOLLOW, INDEX, NOFOLLOW, NOINDEX, NOFOLLOW
 */
define('META_ROBOTS'    ,'INDEX,FOLLOW');
/**
 * Named constant for include favicon 
 */
define('FAV_ICON', TRUE);
/**
 * Named constant for the favicon url
 */
define('FAV_ICON_URL', 'favicon.ico');
/******************************************************************************/
/******************************************************************************/
/******************************************************************************/
/****************************DATABASE OPTIONS**********************************/
/******************************************************************************/
/******************************************************************************/
/******************************************************************************/
/**
 * Named constant for default connection type
 * (none, mssql, oracle, mysqli, mysql)
 */
define('CON_TYPE', 'mssql');
/**
 * Named constant for default database host name or address 
 */
define('DB_HOST','localhost');
/**
 * Named constant for default database name
 */
define('DB_DATABASE','world');
/**
 * Named constant for default database username
 */
define('DB_USER','root');
/**
 * Named constant for default database password
 */
define('DB_PASS','Adivina01');
/**
 * Named constant for default connection option
 */
define('DB_PERSIST',false);
/******************************************************************************/
/******************************************************************************/
/******************************************************************************/
/*******************************HTML CONSTANTS*********************************/
/******************************************************************************/
/******************************************************************************/
/******************************************************************************/
/**
 * Named constant for default select option
 */
define('SELECT_DEFAULT', "--SELECT AN ITEM--");
/**
 * Named constant for default area rows
 */
define('AREA_ROWS','4');
/**
 * Named constant for default area cols
 */
define('AREA_COLS','20');
/**
 * Named constant for BLANK anchor target type
 */
define ('BLANK','_blank');
/**
 * Named constant for TOP anchor target type
 */
define ('TOP','_top');
/**
 * Named constant for PARENT anchor target type
 */
define ('PARENT','_parent');
/**
 * Named constant for mail hyperlink type
 */
define ('MAIL','mail');
/**
 * Named constant for ftp hyperlink type
 */
define ('FTP','ftp');
/**
 * Named constant for file hyperlink type
 */
define ('FILE','file');
/**
 * Named constant for page hyperlink type
 */
define ('PAGEF','page');
/**
 * Named constant for button type
 */
define('BT','botton');
/**
 * Named constant for submit button type
 */
define('ST','submit');
/**
 * Named constant for reset button type
 */
define('RT','reset');
/**
 * Named constant for Checekd property
 */
define('checked_', ' checked="checked"');
/**
 * Named constant for Enctype enable a form to upload files
 */
define('form_data_', ' enctype="multipart/form-data"');
/**
 * Named constant for Selected property
 */
define('selected_', ' selected="selected"');
/**
 * Named constant for Disabled property
 */
define('disabled_', ' disabled="disabled"');
/**
 * Named constant for new line (format code)
 */
define('BK',"\r\n");
/******************************************************************************/
/******************************************************************************/
/******************************************************************************/
/******************************************************************************/
define('sp_', '&nbsp;');
/**
 * Named constant for anchor tag
 */
define('a_','<a>');
/**
 * Named constant for close anchor tag
 */
define('_a','</a>'.BK);
/**
 * Defines an abbreviation
 */
define('ab_','<abbr>');	
/**
 * Close an abbreviation
 */
define('_ab','</abbr>'.BK);
/**
 * Defines contact information for the author/owner of a document
 */
define('ad_','<address>');	
/**
 * Close contact information for the author/owner of a document
 */
define('_ad','</address>'.BK);
/**
 * Defines an area inside an image-map
 */
define('ar_','<area>');	
/**
 * Close an area inside an image-map
 */
define('_ar','</area>'.BK);
/**
 * Defines bold text
 */
define('b_','<b>');	
/**
 * Close bold text
 */
define('_b','</b>');
/**
 * Specifies the base URL/target for all relative URLs in a document
 */
define('base_','<base>');	
/**
 * Close the base URL/target for all relative URLs in a document
 */
define('_base','</base>'.BK);
/**
 * Defines a section that is quoted from another source
 */
define('blk_','<blockquote>');	
/**
 * Close a section that is quoted from another source
 */
define('_blk','</blockquote>'.BK);
/**
 * Defines a single line break
 */
define('br_', '<br />'.BK);
/**
 * Defines a table caption
 */
define('capt_','<caption>');	
/**
 * Close a table caption
 */
define('_capt','</caption>'.BK);
/**
 * Defines the title of a work
 */
define('cit_','<cite>');	
/**
 * Close the title of a work
 */
define('_cit','</cite>'.BK);
/**
 * Defines a piece of computer code
 */
define('code_','<code>');
/**
 * Close a piece of computer code
 */
define('_code','</code>'.BK);
/**
 * Defines a description of an item in a definition list
 */
define('dd_','<dd>');	
/**
 * Close a description of an item in a definition list
 */
define('_dd','</dd>'.BK);
/**
 * Defines a description of an item in a definition list
 */
define('del_','<del>');	
/**
 * Close a description of an item in a definition list
 */
define('_del','</del>'.BK);
/**
 * Defines a section in a document
 */
define('div_','<div>');	
/**
 * Close a section in a document
 */
define('_div','</div>'.BK);
/**
 * Defines a definition list
 */
define('dl_','<dl>');	
/**
 * Close a definition list
 */
define('_dl','</dl>'.BK);
/**
 * Defines a term (an item) in a definition list
 */
define('dt_','<dt>');	
/**
 * Close a term (an item) in a definition list
 */
define('_dt','</dt>'.BK);
/**
 * Defines emphasized text
 */
define('em_','<em>');	
/**
 * Close emphasized text
 */
define('_em','</em>'.BK);
/**
 * Defines a container for an external (non-HTML) application
 */
define('emb_','<embed>');	
/**
 * Close container for an external (non-HTML) application
 */
define('_emb','</embed>'.BK);	
/**
 * Groups related elements in a form
 */
define('field_','<fieldset>');	
/**
 * Close Groups related elements in a form
 */
define('_field','</fieldset>'.BK);
/**
 * Defines a footer for a document or section
 */
define('foot_','<footer>');
/**
 * Close a footer for a document or section
 */
define('_foot','</footer>'.BK);
/**
 * Defines an HTML form for user input
 */
define('form_','<form>');	
/**
 * Close an HTML form for user input
 */
define('_form','</form>'.BK);
/**
 * Not supported in HTML5. 
 * Defines a window (a frame) in a frameset
 */
define('frame_','<frame>');	
/**
 * Not supported in HTML5. 
 * Close a window (a frame) in a frameset
 */
define('_frame','</frame>'.BK);
/**
 * Not supported in HTML5. 
 * Defines a set of frames
 */
define('framest_','<frameset>');
/**
 * Not supported in HTML5. 
 * Close a set of frames
 */
define('_framest','</frameset>'.BK);	
/**
 * Defines a thematic change in the content
 */
define('hr_','<hr/>');
/**
 * Defines a part of text in an alternate voice
 */
define('i_','<i>');	
/**
 * Close a part of text in an alternate voice
 */
define('_i','</i>');
/**
 * Defines an inline frame
 */
define('ifr_','<iframe>');
/**
 * Close an inline frame
 */
define('_ifr','</iframe>'.BK);
/**
 * Defines an image
 */
define('img_','<img>');	
/**
 * Close an image
 */
define('_img','</img>'.BK);	
/**
 * Defines a text that has been inserted into a document
 */
define('ins_','<ins>');	
/**
 * Close a text that has been inserted into a document
 */
define('_ins','</ins>'.BK);
/**
 * Defines a label for an <input> element
 */
define('lbl_','<label>');
/**
 * Close a label for an <input> element
 */
define('_lbl','</label>'.BK);
/**
 * Defines a caption for a <fieldset>, < figure>, or <details> element
 */
define('leg_','<legend>');
/**
 * Close a caption for a <fieldset>, < figure>, or <details> element
 */
define('_leg','</legend>'.BK);
/**
 * Defines a list item
 */
define('li_','<li>');
/**
 * Close a list item
 */
define('_li','</li>'.BK);
/**
 * Defines a client-side image-map
 */
define('map_','<map>');	
/**
 * Close a client-side image-map
 */
define('_map','</map>'.BK);
/**
 * Defines marked/highlighted text
 */
define('mark_','<mark>');
/**
 * Close marked/highlighted text
 */
define('_mark','</mark>'.BK);
/**
 * Defines a list/menu of commands
 */
define('menu_','<menu>');	
/**
 * Close a list/menu of commands
 */
define('_menu','</menu>'.BK);
/**
 * Defines an alternate content for users that do not support client-side scripts
 */
define('noscr_','<noscript>'.BK);	
/**
 * Close an alternate content for users that do not support client-side scripts
 */
define('_noscr','</noscript>'.BK);
/**
 * Defines an embedded object
 */
define('obj_','<object>');	
/**
 * Clse an embedded object
 */
define('_obj','</object>'.BK);
/**
 * Defines an ordered list
 */
define('ol_','<ol>');	
/**
 * Close an ordered list
 */
define('_ol','</ol>'.BK);
/**
 * Defines a group of related options in a drop-down list
 */
define('optg_','<optgroup>');	
/**
 * Close a group of related options in a drop-down list
 */
define('_optg','</optgroup>'.BK);
/**
 * Defines an option in a drop-down list
 */
define('opt_','<option>');
/**
 * Close an option in a drop-down list
 */
define('_opt','</option>'.BK);
/**
 * Defines a paragraph
 */
define('p_','<p>');
/**
 * Close a paragraph
 */
define('_p','</p>'.BK);
/**
 * Defines a parameter for an object
 */
define('param_','<param>');
/**
 * Close a parameter for an object
 */
define('_param','</param>'.BK);
/**
 * Defines preformatted text
 */
define('pre_','<pre>');	
/**
 * Close preformatted text
 */
define('_pre','</pre>'.BK);
/**
 * Defines a short quotation
 */
define('q_','<q>');
/**
 * Close a short quotation
 */
define('_q','</q>');
/**
 * Defines text that is no longer correct
 */
define('s_','<s>');
/**
 * Close text that is no longer correct
 */
define('_s','</s>');
/**
 * Defines a client-side script
 */
define('scr_','<script>'.BK);
/**
 * Close a client-side script
 */
define('_scr','</script>'.BK);
/**
 * Defines a drop-down list
 */
define('select_','<select>');
/**
 * Close a drop-down list
 */
define('_select','</select>'.BK);
/**
 * Defines a section in a document
 */
define('span_','<span>');
/**
 * Close a section in a document
 */
define('_span','</span>');
/**
 * Defines important text
 */
define('strong_','<strong>');
/**
 * Close important text
 */
define('_strong','</strong>');
/**
 * Defines subscripted text
 */
define('sub_','<sub>');	
/**
 * Close subscripted text
 */
define('_sub','</sub>'.BK);
/**
 * Defines superscripted text
 */
define('sup_','<sup>');	
/**
 * Close superscripted text
 */
define('_sup','</sup>'.BK);
/**
 * Defines a table
 */
define('table_','<table>');
/**
 * Close a table
 */
define('_table','</table>'.BK);
/**
 * Groups the body content in a table
 */
define('tbody_','<tbody>');
/**
 * Close groups the body content in a table 
 */
define('_tbody','</tbody>'.BK);
/**
 * Defines a cell in a table
 */
define('td_','<td>');
/**
 * Close a cell in a table *
 */
define('_td','</td>'.BK);
/**
 * Defines a multiline input control (text area)
 */
define('textarea_','<textarea>');
/**
 * Close a multiline input control (text area)
 */
define('_textarea','</textarea>'.BK);
/**
 * Groups the footer content in a table
 */
define('tfoot_','<tfoot>');
/**
 * Close groups the footer content in a table
 */
define('_tfoot','</tfoot>'.BK);
/**
 * Defines a header cell in a table
 */
define('th_','<th>');
/**
 * Close a header cell in a table
 */
define('_th','</th>'.BK);
/**
 * Groups the header content in a table
 */
define('thead_','<thead>');
/**
 * Close groups the header content in a table
 */
define('_thead','</thead>'.BK);
/**
 * Defines a row in a table
 */
define('tr_','<tr>');
/**
 * Close a row in a table
 */
define('_tr','</tr>'.BK);
/**
 * Defines an unordered list
 */
define('ul_','<ul>');	
/**
 * Close an unordered list
 */
define('_ul','</ul>'.BK);
?>