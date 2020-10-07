<?php

    // This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
    function breadcrumbs($separator = ' &raquo; ', $home = 'Menu') {

        /* This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into 
        *  an array, and then filters out any empty values
        */

        $path = array_filter(explode('/', $_SERVER['REQUEST_URI']));

        // This will build our "base URL" (Also accounts for HTTPS)
        $base = '/Canteen/admin/index.php';

        // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
        $breadcrumbs = Array("<li class='breadcrumb-item'><a href=\"$base\">$home</a></li>");

        // Find out the index for the last value in our path array
        $full_path = array_keys($path);
        $last = end($full_path);

        // Build the rest of the breadcrumbs
        foreach ($path AS $x => $crumb) {
            // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
            $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));

            // If we are not on the last index, then display an <a> tag
            if ($x = $last)
                $breadcrumbs[] = "<li class='breadcrumb-item'>$title</li>";
                //$breadcrumbs[] = "<li class='breadcrumb-item'><a href=\"$base$crumb\">$title</a></li>";
            // Otherwise, just display the title (minus)
            //else
              //  $breadcrumbs[] = "<li class='breadcrumb-item'>$title</li>";
        }

        // Build our temporary array (pieces of bread) into one big string :)
        return implode($separator, $breadcrumbs);
    }

?>

<p><?= breadcrumbs('') ?></p>