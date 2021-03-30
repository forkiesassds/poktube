<ul id="subnavSidebar">
  <?php
    $arr = array(

      'About squareBracket' => '/about.php', 
      'Contact Us'=> '/contact.php',
      'Help Center' => '/help.php',
    );


    foreach($arr as $key => $page){

      $class = "class='navItem'";

      $currentPage = $_SERVER['REQUEST_URI']; // check its value and get page name
      if($currentPage ==  $page){

       $class = "class='navItemHighlight'";
      }
    ?>
    <li <?php echo $class; ?>>
        <a href="<?php echo $page; ?>">
           <?= $key; ?>
        </a>
    </li>
    <?php
    }
    ?>
</ul>