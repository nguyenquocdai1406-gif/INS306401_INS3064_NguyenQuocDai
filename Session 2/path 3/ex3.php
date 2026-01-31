<?php
function isAdult(?int $age) :bool{
if($age===null){
return false;}
return $age>=18;}
$input= isAdult(null);
echo $input ? "true":"false";
?>