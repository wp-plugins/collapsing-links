<?php
    foreach ( (array) $_POST['collapsLink'] as $widget_number => $widget_collapsLink ) {
      if ( !isset($widget_collapsLink['title']) && isset($options[$widget_number]) ) // user clicked cancel
        continue;
      $title = strip_tags(stripslashes($widget_collapsLink['title']));
      $showLinkCount= 'no' ;
      if( isset($widget_collapsLink['showLinkCount']) ) {
        $showLinkCount= 'yes' ;
      }  
      $catSortOrder= 'ASC' ;
      if($widget_collapsLink['catSortOrder'] == 'DESC') {
        $catSortOrder= 'DESC' ;
      }
      if($widget_collapsLink['catSort'] == 'linkName') {
        $catSort= 'linkName' ;
      } elseif ($widget_collapsLink['catSort'] == 'linkId') {
        $catSort= 'linkId' ;
      } elseif ($widget_collapsLink['catSort'] == 'linkSlug') {
        $catSort= 'linkSlug' ;
      } elseif ($widget_collapsLink['catSort'] == 'linkOrder') {
        $catSort= 'linkOrder' ;
      } elseif ($widget_collapsLink['catSort'] == 'linkCount') {
        $catSort= 'linkCount' ;
      } elseif ($widget_collapsLink['catSort'] == '') {
        $catSort= '' ;
        $catSortOrder= '' ;
      }
      $linkSortOrder= 'ASC' ;
      if($widget_collapsLink['linkSortOrder'] == 'DESC') {
        $linkSortOrder= 'DESC' ;
      }
      if($widget_collapsLink['linkSort'] == 'linkName') {
        $linkSort= 'linkName' ;
      } elseif ($widget_collapsLink['linkSort'] == 'linkId') {
        $linkSort= 'linkId' ;
      } elseif ($widget_collapsLink['linkSort'] == 'linkRating') {
        $linkSort= 'linkRating' ;
      } elseif ($widget_collapsLink['linkSort'] == 'linkUrl') {
        $linkSort= 'linkUrl' ;
      } elseif ($widget_collapsLink['linkSort'] == '') {
        $linkSort= '' ;
        $linkSortOrder= '' ;
      }
      $expand= $widget_collapsLink['expand'];
      $inExclude= 'include' ;
      if($widget_collapsLink['inExclude'] == 'exclude') {
        $inExclude= 'exclude' ;
      }
      $animate=1;
      if( !isset($widget_collapsLink['animate'])) {
        $animate= 0 ;
      }
      $inExcludeCats=addslashes($widget_collapsLink['inExcludeCats']);
      $defaultExpand=addslashes($widget_collapsLink['defaultExpand']);
      $options[$widget_number] = compact( 'title','showLinkCount','catSort','catSortOrder','defaultExpand','expand','inExclude','inExcludeCats','linkSort','linkSortOrder','animate' );
    }

    update_option('collapsLinkOptions', $options);
    $updated = true;
    $style=$_POST['collapsPageStyle'];
    update_option('collapsPageStyle', $style);
?>
