<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <?php
        $firstName = "Shihab Ahmed";
        echo $firstName."<br>";
        echo var_dump($firstName)."<br>";

        for ($i=0; $i<10; $i++){
            echo $firstName."<br>";
        }

        $ihs = array("MD","BH","ALMAS","SHUVO","KIRON","SHIHAB");
        for($i=0; $i<count($ihs); $i++) {
            $ihs[$i]= strtolower($ihs[$i]);
            echo $ihs[$i]."<br>";
        }
        echo "<h3> Hi HI HI HIH IH IHI HI IH IHI </h3>";
        foreach($ihs as $names) {
            $names= strtolower($names);
            echo $names."<br>";
        }

        function sum($a,$b) {
            if($a > $b) {
                return $a."<br>";
            } else {
                return $b."<br>";
            }
        }
        echo sum(5,10);
    ?>

</body>
</html>