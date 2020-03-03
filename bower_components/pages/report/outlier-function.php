<?php

function mean($list){
    $avg = array_sum($list)/count($list);
    return $avg;
};

function variance($list){
    $sum = 0;
    $avg = mean($list);

    for($i = 0; $i < (count($list)); $i++){
        $sum = $sum + pow($list[$i]-$avg, 2);
    }
    $var = $sum/(count($list)-1);
    return $var;
}


function zScore($x ,$list){
    $std = sqrt(variance($list));
    $avg = mean($list);

    $z = abs($x - $avg)/$std;

    return $z;
}

function findOutlier($list){
    $zScore = 0;
    $outlierIndex = array();
    for($i = 0; $i < (count($list)); $i++){
        $zScore = zScore($list[$i],$list);
        if($zScore >= 3){
            array_push($outlierIndex, $i);
        }
    }

    return $outlierIndex;
}

?>