<!DOCTYPE html>
<html>
    <body>
        <?php
            $x = 1;
            $Materie = array(
                array("Lezione(7.50-8.40)", "Inglese", "Italiano", "Inglese", "Inglese", "Italiano", "Tpsit"),
                array("Lezione(8.40-9.30)", "Sir", "Italiano", "Informatica", "Tpsit", "Matematica", "Matematica"),
                array("Lezione(9.40-10.30)", "Informatica", "Sir", "Informatica", "Motoria", "SirLab", "Religione"),
                array("Lezione(10.30-11.20)", "Italiano", "InfoLab", "Storia", "Motoria", "SirLab", "GpoiLab"),
                array("Lezione(11.20-12.10)", "TpsitLab", "InfoLab", "Matematica", "Informatica", "SirLab", "GpoiLab"),
                array("Lezione(12.10-13.00)", "TpsitLab", "InfoLab", "SirLab", "Storia", "Gpoi", " ")
            );
            $Giorni = array("Orario", "Lunedi", "Martedi", "Mercoledi", "Giovedi", "Venerdi", "Sabato");

            function rappresentaTabella($Giorni, $Materie) {
                global $x;
                echo "<table border=$x cellspacing=$x cellpadding=$x align=center>
                   <thead>
                    <tr>";
                foreach ($Giorni as $y) {
                    echo "<th>$y</th>"; 
                }
                echo "</tr></thead><tbody>";
                for ($i = 0; $i < count($Materie); $i++) {
                    echo "<tr>";
                    for ($z = 0; $z < count($Materie[$i]); $z++) {
                        echo "<th>" . $Materie[$i][$z] . "</th>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            }

            rappresentaTabella($Giorni, $Materie);
        ?>
    </body>
</html>

