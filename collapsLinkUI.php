<?php
/*
Collapsing Links version: 0.3.5
Copyright 2007 Robert Felty

This work is largely based on the Fancy Links plugin by Andrew Rader
(http://nymb.us), which was also distributed under the GPLv2. I have tried
contacting him, but his website has been down for quite some time now. See the
CHANGELOG file for more information.

This file is part of Collapsing Links

    Collapsing Links is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    Collapsing Links is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Collapsing Links; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

check_admin_referer();

$options=get_option('collapsLinkOptions');
$widgetOn=0;
$number='%i%';
if (empty($options)) {
  $number = '-1';
} elseif (!isset($options['%i%']['title']) || 
    count($options) > 1) {
  $widgetOn=1; 
}

if( isset($_POST['resetOptions']) ) {
  if (isset($_POST['reset'])) {
    delete_option('collapsLinkOptions');   
		$widgetOn=0;
    $number = '-1';
  }
} elseif (isset($_POST['infoUpdate'])) {
  $style=$_POST['collapsLinkStyle'];
  $defaultStyles=get_option('collapsLinkDefaultStyles');
  $selectedStyle=$_POST['collapsLinkSelectedStyle'];
  $defaultStyles['selected']=$selectedStyle;
  $defaultStyles['custom']=$_POST['collapsLinkStyle'];

  update_option('collapsLinkStyle', $style);
  update_option('collapsLinkSidebarId', $_POST['collapsLinkSidebarId']);
  update_option('collapsLinkDefaultStyles', $defaultStyles);

  if ($widgetOn==0) {
    include('updateOptions.php');
  }
}
include('processOptions.php');
?>
<div class=wrap>
 <form method="post">
  <h2><? _e('Collapsing Links Options', 'collapsLink'); ?></h2>
  <fieldset name="Collapsing Links Options">
    <p>
 <?php _e('Id of the sidebar where collapsing links appears:', 'collapsing-links'); ?>
   <input id='collapsLinkSidebarId' name='collapsLinkSidebarId' type='text' size='20' value="<?php echo
   get_option('collapsLinkSidebarId')?>" onchange='changeStyle("collapsLinkStylePreview","collapsLinkStyle", "collapsLinkDefaultStyles", "collapsLinkSelectedStyle", false);' />
   <table>
     <tr>
       <td>
  <input type='hidden' id='collapsLinkCurrentStyle' value="<?php echo
stripslashes(get_option('collapsLinkStyle')) ?>" />
  <input type='hidden' id='collapsLinkSelectedStyle'
  name='collapsLinkSelectedStyle' />
<label for="collapsLinkStyle"><?php _e('Select style:', 'collapsing-links'); ?></label>
       </td>
       <td>
       <select name='collapsLinkDefaultStyles' id='collapsLinkDefaultStyles'
         onchange='changeStyle("collapsLinkStylePreview","collapsLinkStyle", "collapsLinkDefaultStyles", "collapsLinkSelectedStyle", false);' />
       <?php
    $url = get_settings('siteurl') . '/wp-content/plugins/collapsing-links';
       $styleOptions=get_option('collapsLinkDefaultStyles');
       //print_r($styleOptions);
       $selected=$styleOptions['selected'];
       foreach ($styleOptions as $key=>$value) {
         if ($key!='selected') {
           if ($key==$selected) {
             $select=' selected=selected ';
           } else {
             $select=' ';
           }
           echo '<option' .  $select . 'value="'.
               stripslashes($value) . '" >'.$key . '</option>';
         }
       }
       ?>
       </select>
       </td>
       <td><?php _e('Preview', 'collapsing-links'); ?><br />
       <img style='border:1px solid' id='collapsLinkStylePreview' alt='preview'/>
       </td>
    </tr>
    </table>
    <?php _e('You may also customize your style below if you wish', 'collapsing-links'); ?><br />
   <input type='button' value='<?php _e("restore current style", "collapsing-links"); ?>'
onclick='restoreStyle();' /><br />
   <textarea onchange='changeStyle("collapsLinkStylePreview","collapsLinkStyle", "collapsLinkDefaultStyles", "collapsLinkSelectedStyle", true);' cols='78' rows='10' id="collapsLinkStyle"name="collapsLinkStyle"><?php echo stripslashes(get_option('collapsLinkStyle'))?></textarea>
    </p>
<script type='text/javascript'>

function changeStyle(preview,template,select,selected,custom) {
  var preview = document.getElementById(preview);
  var linkstyles = document.getElementById(select);
  var selectedStyle;
  var hiddenStyle=document.getElementById(selected);
  var linkstyle = document.getElementById(template);
  if (custom==true) {
    selectedStyle=linkstyles.options[linkstyles.options.length-1];
    selectedStyle.value=linkstyle.value;
    selectedStyle.selected=true;
  } else {
    for(i=0; i<linkstyles.options.length; i++) {
      if (linkstyles.options[i].selected == true) {
        selectedStyle=linkstyles.options[i];
      }
    }
  }
  hiddenStyle.value=selectedStyle.innerHTML
  preview.src='<?php echo $url ?>/img/'+selectedStyle.innerHTML+'.png';
  var sidebarId=document.getElementById('collapsLinkSidebarId').value;

  var theStyle = selectedStyle.value.replace(/#[a-zA-Z]+\s/g, '#'+sidebarId + ' ');
  linkstyle.value=theStyle
}

function restoreStyle() {
  var defaultStyle = document.getElementById('collapsLinkCurrentStyle').value;
  var linkstyle = document.getElementById('collapsLinkStyle');
  linkstyle.value=defaultStyle;
}
  changeStyle('collapsLinkStylePreview','collapsLinkStyle', 'collapsLinkDefaultStyles', 'collapsLinkSelectedStyle', false);

</script>
  </fieldset>
  <div class="submit">
   <input type="submit" name="infoUpdate" value="<?php _e('Update options', 'collapsLink'); ?> &raquo;" />
  </div>
 </form>
</div>
