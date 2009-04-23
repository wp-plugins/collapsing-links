<?php
/*
Collapsing Links version: 0.2.7
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

if (isset($_POST['infoUpdate'])) {
  $style=$_POST['collapsLinkStyle'];
  update_option('collapsLinkStyle', $style);
  if ($widgetOn==0) {
		include('updateOptions.php');
  }
}
//include('processOptions.php');
?>
<div class=wrap>
 <form method="post">
  <h2>Collapsing Links Options</h2>
  <fieldset name="Collapsing Links Options">
   <legend><?php _e('Display Options:'); ?></legend>
   <ul style="list-style-type: none;">
    <p>
  <input type='hidden' id='collapsLinkOrigStyle' value="<?php echo
stripslashes(get_option('collapsLinkOrigStyle')) ?>" />
<label for="collapsLinkStyle">Style info:</label>
   <input type='button' value='restore original style'
onclick='restoreStyle();' /><br />
   <textarea cols='78' rows='10' id="collapsLinkStyle" name="collapsLinkStyle">
    <?php echo stripslashes(get_option('collapsLinkStyle')) ?>
   </textarea>
    </p>
<script type='text/javascript'>
function restoreStyle() {
  var defaultStyle = document.getElementById('collapsLinkOrigStyle').value;
  var catStyle = document.getElementById('collapsLinkStyle');
  catStyle.value=defaultStyle;
}
</script>
   </ul>
  </fieldset>
  <div class="submit">
   <input type="submit" name="infoUpdate" value="<?php _e('Update options', 'Collapsing Links'); ?> &raquo;" />
  </div>
 </form>
</div>
