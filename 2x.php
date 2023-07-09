<?php include "login-control.php"; ?>
<?php include "timeout.php"; ?>
<?php
    function zamVeIndirim () {
        include "database/connect.php";
        $sql = "SELECT COUNT(ID) AS SAYAC FROM `urun` WHERE (`PIECE` <= 10) OR (`PIECE` > 10 AND `CONTROL` = 1)";
        $query = mysqli_query($dbconnect, $sql);
        $kayit = mysqli_fetch_assoc($query);
        $sinir = $kayit['SAYAC'];
        $sql = "SELECT * FROM `urun` WHERE (`PIECE` <= 10) OR (`PIECE` > 10 AND `CONTROL` = 1)";
        $query = mysqli_query($dbconnect, $sql);
        // print "<table style='font-size: 35px;' border='1'>";
        for($j = 0; $j < $sinir; $j++)
        {
            // print "<tr>";

            $kayit = mysqli_fetch_assoc($query);
            $ID = $kayit['ID'];
            $adet = $kayit['PIECE'];
            $fiyat = $kayit['PRICE'];
            $yuzde = 0;
            // echo "<td>{$kayit['PRODUCT_NAME']}</td><td style='width: 50px;'><center>$adet</center></td><td>$fiyat</td>";

            if($adet > 10)
            {
                $update = "UPDATE `urun` SET `EXTRA` = 0, `CONTROL` = 0 WHERE `ID` = $ID AND `CONTROL` = 1 AND `PIECE` > 10";
                mysqli_query($dbconnect, $update);
            }
            else if($adet <= 10)
            {
                $yuzde = ($fiyat / 100) * 20;
                $fiyat += $yuzde;
                $update = "UPDATE `urun` SET `EXTRA` = $fiyat, `CONTROL` = 1 WHERE `ID` = $ID AND `CONTROL` = 0";
                mysqli_query($dbconnect, $update);
            }

            // print "</tr>";
        }
        // print "</table>";
        
        /* kategori durumunu göster */
        /* YÜZDE ORANI İLE ZAMNLANDIR. */
    }


    function toplamKazanc() {
        include "database/connect.php";

        $sql = "SELECT SUM(`PRICE`) AS `TOPLAM_KAZANC` FROM `sold`";
        $query = mysqli_query($dbconnect, $sql);
        $kayit = mysqli_fetch_assoc($query);
        $toplam = $kayit['TOPLAM_KAZANC'];
        return $toplam;
    }


    function toplamSatilanUrun() {
        include "database/connect.php";

        $sql = "SELECT SUM(`PIECE`) AS `SATILAN_URUN` FROM `sold`";
        $query = mysqli_query($dbconnect, $sql);
        $kayit = mysqli_fetch_assoc($query);
        $toplam = $kayit['SATILAN_URUN'];
        return $toplam;
    }


    function enCokTercihEdilenUrunler() {
        include "database/connect.php";

        $sql = "SELECT `U`.`PRODUCT_NAME`, `S`.`PIECE` FROM `sold` AS `S` JOIN `urun` AS `U` ON `U`.`ID` = `S`.`URUN_ID`";
        $query = mysqli_query($dbconnect, $sql);
        $a = 0;
        $array = array();
        while($kayit = mysqli_fetch_assoc($query))
        {
            $name = $kayit['PRODUCT_NAME'];
            $piece = $kayit['PIECE'];

            $array[$a] = $piece." ".$name;
            $a++;
        }
        // $temp = $array[$i];
        // $array[$i] = $array[$i-1];
        // $array[$i-1] = $temp;
        for($j = 0; $j < count($array); $j++)
        {
            for($i = 1; $i < count($array); $i++)
            {
                if(substr($array[$i-1], 0, strpos($array[$i-1], " ")) < substr($array[$i], 0, strpos($array[$i], " ")))
                {
                    $temp = $array[$i];
                    $array[$i] = $array[$i-1];
                    $array[$i-1] = $temp;
                }
            }
        }
        return $array;
    }
    // $enCokAdet = enCokTercihEdilenUrunler();
    // $ad = "";
    // $lol = "";
    // for($j = 0; $j < count($enCokAdet); $j++)
    // {
    //     // echo $enCokAdet[$j]."<br>";
    //     $lol = substr($enCokAdet[$j], 0, strpos($enCokAdet[$j], " "));
    //     $ad = substr($enCokAdet[$j], strpos($enCokAdet[$j], " "));
    //     // echo $lol." - ".$ad."<br>";
    // }
    // echo substr($enCokAdet[0], 0, strpos($enCokAdet[0], " "));

    /* Test amacıyla yazılmış komut ^^ */

    function indexSayac() {
        include "database/connect.php";

        $sayacSql = "SELECT COUNT(`ID`) AS `SAYAC` FROM `urun` WHERE `PIECE` <= 10 AND `PIECE` > 0";
        $sayacQuery = mysqli_query($dbconnect, $sayacSql);
        $sayacKayit = mysqli_fetch_assoc($sayacQuery);
        $sayac = $sayacKayit['SAYAC'];
        if($sayac >= 5) { $sayac = 5; }
        return $sayac;
    }


    function test() {
        include "database/connect.php";

        $sql = "SELECT SUM(`PRICE`) AS `SOLD_PRICE` FROM `sold`";
        $query = mysqli_query($dbconnect, $sql);
        $kayit = mysqli_fetch_assoc($query);
        $sold = $kayit['SOLD_PRICE'];

        /* sold tablosunda price kolonu adetlerin toplanmış fiyatını yansıtmaktadır. */
        /* Bundan dolayı 'urun' tablosunda adet*fiyat olarak hesaplama yaptır. Hadi iyi gecelr :) */

        $sql = "SELECT `PIECE`,`PRICE` FROM `urun`";
        $query = mysqli_query($dbconnect, $sql);
        $urun = 0;
        while($kayit = mysqli_fetch_assoc($query))
        {
            $urunPiece = $kayit['PIECE'];
            $urunPrice = $kayit['PRICE'];
            $urun += $urunPiece * $urunPrice;
        }

        // $toplam = (($urun - $sold) / $urun) * 100;
        // $toplam = (($urun - $sold) / $urun) * 100;
        // echo $urun."<br>".$sold."<br>";
        // echo substr($toplam, 0, 4);

    }
    // test();

    function sold($islemSayisi) {
        for($j = 0; $j < $islemSayisi; $j++)
        {
            include "database/connect.php";
            $sql = "SELECT MIN(ID) AS MIN, MAX(ID) AS MAX FROM `urun`"; // ürün tablosunda min id ve max idyi çekiyor
            $query = mysqli_query($dbconnect, $sql);
            $kayit = mysqli_fetch_assoc($query);
            $randID = rand($kayit['MIN'], $kayit['MAX']); // min ile max arasında rastgele sayı üretiyor.
            
            $sql = "SELECT * FROM `urun` WHERE `ID` = $randID";
            $query = mysqli_query($dbconnect, $sql);
            $kayit = mysqli_fetch_assoc($query);

            $piece = $kayit['PIECE'];
            $price = $kayit['PRICE'];
            if($piece > 25) { $subtraction = 20; } else { $subtraction = 0; } // Eğer id'si gelen ürünün adeti 20den azsa eksiltme sayısı ayarlanır.
            $randPIECE = rand(1, $piece-$subtraction);
            $lastPIECE = $piece - $randPIECE;

            $sqlupdate = "UPDATE `urun` SET `PIECE` = $lastPIECE WHERE `ID` = $randID";
            mysqli_query($dbconnect, $sqlupdate); // yeni adeti günceller.

            $profit = $randPIECE * $price;

            $sqlinsert = "INSERT INTO `sold` (PIECE, PRICE, URUN_ID) VALUES ($randPIECE, $profit, $randID)";
            mysqli_query($dbconnect, $sqlinsert);
        }
    }
?>