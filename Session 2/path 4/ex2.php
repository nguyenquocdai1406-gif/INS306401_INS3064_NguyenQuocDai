<?php
$students = [
    ['name' => 'An',  'grade' => 90],
    ['name' => 'Binh','grade' => 85],
    ['name' => 'Chi', 'grade' => 78]
];
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Name</th>
        <th>Grade</th>
    </tr>

    <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo $student['name']; ?></td>
            <td><?php echo $student['grade']; ?></td>
        </tr>
    <?php endforeach; ?>

</table>
