<!DOCTYPE html>
<html>
    <body>
        <style>
            body{
                text-align: center;
            }
        </style>
        <h1>Tabella</h1>
        <?php
        // oer migliorare l'efficienza è bene far interpretare il codice dal browser piuttosto che php
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
            ?>
            <table border=<?= $x ?> cellspacing=<?= $x ?> cellpadding=<?= $x ?> align=center>
                <thead>
                    <tr>
                        <?php
                            foreach ($Giorni as $y) {
                        ?>                
                            <th><?= $y ?></th>
                        <?php
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for ($i = 0; $i < count($Materie); $i++) {
                    ?>
                        <tr>
                    <?php
                        for ($z = 0; $z < count($Materie[$i]); $z++) {
                    ?>
                        <th> <?= $Materie[$i][$z] ?></th>
                    <?php
                        }
                    ?>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <?php
               }
                rappresentaTabella($Giorni, $Materie);
            ?>
    </body>
</html>

