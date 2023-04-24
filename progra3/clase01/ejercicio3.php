<?php
$a=3;
$b=3;
$c=3;

if(($a<$b && $a>$c) ||($a>$b && $a<$c) )
echo "$a es el del medio";
else if (($b<$a && $b>$c) || ($b>$a && $b<$c))
echo "$b es el del medio";
else if(($c<$b && $c>$a) || ($c>$b && $a>$c))
echo "$c es el dem medio";
else
echo "No hay medio";
?>