<?php
 if ( -1 == $number ) {
    /* default options go here */
    $title = 'Blogroll';
    $text = '';
    $showLinkCount = 'no';
    $catSort = 'linkName';
    $catSortOrder = 'ASC';
    $linkSort = 'linkName';
    $linkSortOrder = 'ASC';
    $defaultExpand='';
    $number = '%i%';
    $expand='1';
    $inExclude='include';
    $inExcludeCats='';
    $animate=1;
  } else {
    $title = attribute_escape($options[$number]['title']);
    $showLinkCount = $options[$number]['showLinkCount'];
    $expand = $options[$number]['expand'];
    $inExcludeCats = $options[$number]['inExcludeCats'];
    $inExclude = $options[$number]['inExclude'];
    $catSort = $options[$number]['catSort'];
    $catSortOrder = $options[$number]['catSortOrder'];
    $linkSort = $options[$number]['linkSort'];
    $linkSortOrder = $options[$number]['linkSortOrder'];
    $defaultExpand = $options[$number]['defaultExpand'];
    $animate = $options[$number]['animate'];
  }
?>
