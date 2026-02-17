<?php 
function sumDiagonal($array) {
    $sum = 0;
    $length = count($array);
    for ($i = 0; $i < $length; $i++) {
        $sum += $array[$i][$i];
    }
    return $sum;
}

// Example usage
$array = array(
 array(1, 2, 3, 4),
array(2, 1, 4, 3),
array(3, 4, 1, 2),
array(4, 3, 2, 1)
);

$diagonalSum = sumDiagonal($array);
echo "The diagonal sum is: " . $diagonalSum;




function sumHorizontal($array) {
    $sum = 0;
    $length = count($array);
    for ($i = 0; $i < $length; $i++) {
        $sum += $array[$i][3];
    }
    return $sum;
}

// Example usage
$array =array(2,3,6,7);

$diagonalSum = sumHorizontal($array);
echo "The horizontal sum is: " . $diagonalSum;
?>