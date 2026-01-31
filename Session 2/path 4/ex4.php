<?php
$scores=[70,80,95,75,50];
$sum=0;
foreach($scores as $score){
$sum += $score;}
$average = $sum/count($scores);
$max=$scores[0];
$min=$scores[0];
foreach($scores as $score){
if ($score>$max){$max=$score;}
if ($score<$min){$min=$score;}
}
$topscores=[];
foreach($scores as $score){
if($score>$average){
$topscores[]=$score;}
}
echo "Average: " . number_format($average,2) . "<br>";
echo "Max: ".$max."<br>";
echo "Min: ".$min."<br>";
echo "Top score: [";
for ($i=0;$i<count($topscores);$i++){
echo $topscores[$i];
if($i<count($topscores)-1){
echo ",";}
}
echo "]";
?>