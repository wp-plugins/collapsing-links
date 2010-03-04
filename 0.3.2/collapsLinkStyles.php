    <?php
$style="#sidebar span.collapsing.links {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
} 

#sidebar li.widget_collapslink h2 span.sym {float:right;padding:0 .5em}
#sidebar li.collapsing.links a.self {font-weight:bold}
#sidebar ul.collapsing.links.list ul.collapsing.links.list:before {content:'';} 
#sidebar ul.collapsing.links.list li.collapsing.links:before {content:'';} 
#sidebar ul.collapsing.links.list li.collapsing.links {list-style-type:none}
#sidebar ul.collapsing.links.list li.collapsing.links {
       padding:0 0 0 1em;
       text-indent:-1em;
}
#sidebar ul.collapsing.links.list li.collapsing.links.item:before {content: '\\\\00BB \\\\00A0' !important;} 
#sidebar ul.collapsing.links.list li.collapsing.links .sym {
   cursor:pointer;
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    padding-right:5px;}";

$default=$style;

$block="#sidebar ul.collapsing.links.list li a {
            display:block;
            text-decoration:none;
            margin:0;
            padding:0;
            }
#sidebar ul.collapsing.links.list li a:hover {
            background:#CCC;
            text-decoration:none;
          }
#sidebar span.collapsing.links {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
}

#sidebar li.widget_collapslink h2 span.sym {float:right;padding:0 .5em}
#sidebar li.collapsing.links a.self {background:#CCC;
                       font-weight:bold}
#sidebar ul.collapsing.links.list ul.collapsing.links.list:before {content:'';} 
#sidebar ul.collapsing.links.list li.collapsing.links {list-style-type:none}
#sidebar ul.collapsing.links.list li.collapsing.links.item:before, 
  #sidebar ul.collapsing.links.list li.collapsing.links:before {
       content:'';
  } 
#sidebar ul.collapsing.links.list li.collapsing.links .sym {
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    cursor:pointer;
    float:left;
    padding-right:5px;
}
";

$noArrows="#sidebar span.collapsing.links {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
}
#sidebar li.collapsing.links a.self {font-weight:bold}

#sidebar li.widget_collapslink h2 span.sym {float:right;padding:0 .5em}
#sidebar ul.collapsing.links.list li.collapsing.links.item:before {content:'';} 
#sidebar ul.collapsing.links.list li.collapsing.links:before {content:'';} 
#sidebar ul.collapsing.links.list li.collapsing.links {list-style-type:none}
#sidebar ul.collapsing.links.list li.collapsing.links .sym {
   cursor:pointer;
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    padding-right:5px;}";
$selected='default';
$custom=get_option('collapsing.linksStyle');
?>
