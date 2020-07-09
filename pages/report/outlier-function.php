<?php

function mean($list){
    $avg = array_sum($list)/count($list);
    return $avg;
}

function variance($list){
    $sum = 0;
    $avg = mean($list);

    for($i = 0; $i < (count($list)); $i++){
        $sum = $sum + pow($list[$i]-$avg, 2);
    }
    $jlist = (count($list) -1);
    if ($jlist>0){
    $var = $sum/$jlist;
    return $var;}
}


function zScore($x ,$list){
    $std = sqrt(variance($list));
    $avg = mean($list);
    if ($std>0){
    $z = abs($x - $avg)/$std;
    
    return $z;}
}

function findOutlier($list){
    $zScore = 0;
    $outlierIndex = array();
    for($i = 0; $i < (count($list)); $i++){
        $zScore = zScore($list[$i],$list);
        if($zScore >= 3 && $list[$i]>= $avg){
            array_push($outlierIndex, $i);
        }
    }

    return $outlierIndex;
}

?>