<?php
function calculateBMI(float $kg, float $m): string {
    if ($m <= 0) {
        return "Invalid height";
    }

    $bmi = $kg / ($m * $m);

    if ($bmi < 18.5) {
        $category = "Under";
    } elseif ($bmi < 25) {
        $category = "Normal";
    } else {
        $category = "Over";
    }

    return "BMI: " . number_format($bmi, 1) . " ($category)";
}
?>
