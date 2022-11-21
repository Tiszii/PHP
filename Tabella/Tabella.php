<!DOCTYPE html>
<html>
    <body>
        <style>
            body{
                text-align: center;
            }
        </style>
        <?php
        $x = 1;
        $numeroMaterie = 6;
        $numeroGiorni = array("Lunedi", "Martedi", "Mercoledi", "Giovedi", "Venerdi", "Sabato");

        echo "<table border=$x cellspacing=$x cellpadding=$x align=center>
               <thead>
                <tr>";
        foreach ($numeroGiorni as $y) {
            echo "<th>$t</th>";
        }
        echo "</tr></thead><tbody>";

        for ($i = 1; $i <= $numeroMaterie; $i++) {
            echo "<tr>";
            for ($z = 1; $z <= count($numeroGiorni); $z++) {
                echo "<th>Materia $i</th>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
        ?>
    </body>
</html>

