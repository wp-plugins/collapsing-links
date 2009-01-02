<?php
/*
Collapsing Links version: 0.2.1
Copyright 2008 Robert Felty

This file is part of Collapsing Links

		Collapsing Links is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License as published by 
    the Free Software Foundation; either version 2 of the License, or (at your
    option) any later version.

    Collapsing Links is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Collapsing Links; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

check_admin_referer();

if( isset($_POST['infoUpdate']) ) {
	include('updateOptions.php');
}
?>
<div class=wrap>
 <form method="post">
  <h2>Collapsing Links Options</h2>
  <fieldset name="Collapsing Links Options">
   <legend><?php _e('Display Options:'); ?></legend>
   <ul style="list-style-type: none;">
   <?php include('options.txt'); ?>
  </fieldset>
  <div class="submit">
   <input type="submit" name="infoUpdate" value="<?php _e('Update options', 'Collapsing Links'); ?> &raquo;" />
  </div>
 </form>
</div>
