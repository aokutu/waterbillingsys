<?php 
function x()
{
 $arr = array(
0 => array(1, 2, 3, 4),
1 => array(2, 1, 4, 3),
2 => array(3, 4, 1, 2),
3 => array(4, 3, 2, 1)
);
$x=$arr[0][0]+$arr[1][1]+$arr[2][2]+$arr[3][3];
print $x;   
    
    
}
x();
/*
print $arr[1][1]
*/

?>