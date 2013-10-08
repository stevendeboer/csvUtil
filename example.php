<?php

include ("class.csvUtil.php");
$websites = new csvUtil("websites.csv", ",");

# Define column names
define (NAME, "0");
define (URL, "1");

# Print our links
echo "<B>Print complete content.</B><BR>";
$i = 0;
while ($result = $websites->getField($i, NAME)) {
        $link = $websites->getField($i, URL);
        echo "<A HREF='$link'>$result</A><BR>";
        $i++;
}
?>


<BR><BR><B>Search for "php" sites.</B><BR>
<?
# Use search
$result = $websites->search(NAME, "php");

# Print result
$i = 0;
do {
        $name = $websites->getField($result[$i], NAME);
        $link = $websites->getField($result[$i], URL);
        echo "<A HREF='$link'>$name</A><BR>";
        $i++;
} while ($result[$i]);


?>