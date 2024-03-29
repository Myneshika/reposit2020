<?php
require "db.php";
require "includes/func.php";
 //R::fancyDebug( TRUE );
ini_set('display_errors',-1);
error_reporting(E_ALL);


$id_m = $_SESSION['id_m'];
$id_d = $_SESSION['id_d'];


$dog = new Dog();

?> 
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<title>Cимулятор заводчика</title>
</head>
<body>
    <style>
        @font-face {
        font-family: '11365';
        src: url('/fonts/s/11365.ttf');
        }
        span {
            font-family: '11365';
            color: rgb(65, 55, 255);
            font-size: 20px;
        }
        #text2{
            font-family: '11365';
            color: rgb(65, 55, 255);
            font-size: 45px;
            /*text-shadow: rgb(3, 3, 3) -1px 4px 4px;*/
        }
        
    </style>
    
    <div class="cont" ><h1 align="center">АКТ ВЯЗКИ</h1>
        <div><img src = "/pici/bred_mini.png"><h3>Питомник: <?php echo $dog->retKennel($id_m);?></h3><hr></div>
        <table width="50%" cellpadding="5" cellspacing="0" border="1">
            <caption>СВЕДЕНИЯ О ПЕРВОНАЧАЛЬНОЙ ВЯЗКЕ.</caption><br>
            <tr><td><strong>Мы, владельцы собак породы: </strong></td><td id="text2"><?php echo $dog->retRace($id_m);?></td>  </tr>
            <br>
            <tr><td>1) КОБЕЛЯ(полная кличка):</td><td id="text2"><?php echo $dog->retName($id_d);?></td></tr>
         <tr><td>Родословная РКФ(клеймо):</td><td id="text2"><?php echo $id_d;?></td></tr>
         <br>
         <tr><td>2) СУКИ(полная кличка):</td><td id="text2"><?php echo $dog-> retName($id_m)?></td></tr>
         <tr><td>Родословная РКФ(клеймо):</td><td id="text2"><?php echo $id_m;?></td></tr>
         <br>
         <td colspan="2"><strong>подтверждаем,</strong> <br> а) что "<span><?php echo date("d/m/Y");?></span>" произведена идентификация вышеуказанных собак по имеющимся на них клеймам
         на соответствие их Свидетельствам о происхождении(родословном) и собаки соответствуют своим родословным;</td>
        
         <tr><td colspan="2">б) что "<span><?php echo date("d/m/Y");?></span>" в присутствии инструктора после идентификации указанного кобеля и суки осуществлена <strong>
             первоначальная вязка </strong> вушеуказанной суки с вышеуказанным кобелем.</tr>
         </table>
        <br>
        <table width="25%" cellpadding="2" cellspacing="0" border="0">
            <tr><td><strong>  Владелец кобеля: </strong></td><td><?php echo $dog->retBreeder($id_d);?></td><td>  Электронная подпись: </td></tr>
             <tr><td><strong>  Владелец суки: </strong></td><td><?php echo $dog->retBreeder($id_m);?></td><td>  Электронная подпись: </td></tr>
             <tr><td><strong>  Инструктор вязки: </strong></td><td><?php echo $dog->retBreeder($id_m);?></td><td>  Электронная подпись: </td></tr>
        </table> 
        <br><br><br>
        <table width="50%" cellpadding="5" cellspacing="0" border="1">
            <caption>СВЕДЕНИЯ О КОНТРОЛЬНОЙ ВЯЗКЕ.</caption>
            <td colspan="2"><strong>подтверждаем,</strong> <br> а) что "<span><?php echo date("d/m/Y");?> </span>" произведена идентификация вышеуказанных собак по имеющимся на них клеймам
         на соответствие их Свидетельствам о происхождении(родословном) и собаки соответствуют своим родословным;</td>
        
         <tr><td colspan="2">б) что "<span><?php echo date("d/m/Y");?> </span>" в присутствии инструктора после идентификации указанного кобеля и суки осуществлена <strong>
             контрольная вязка </strong> вушеуказанной суки с вышеуказанным кобелем.</tr>
        </table>
         <br>
        <table width="25%" cellpadding="2" cellspacing="0" border="0">
        <tr><td><strong>  Владелец кобеля: </strong></td><td><?php echo $dog->retBreeder($id_d);?></td><td>  Электронная подпись: </td></tr>
             <tr><td><strong>  Владелец суки: </strong></td><td><?php echo $dog->retBreeder($id_m);?></td><td>  Электронная подпись: </td></tr>
             <tr><td><strong>  Инструктор вязки: </strong></td><td><?php echo $dog->retBreeder($id_m);?></td><td>  Электронная подпись: </td></tr>
        </table> 
        <br><br><br>
        <form method="POST" action="/breedding.php">
            <input type="submit" name="exit" value="вернуться" class="btn btn btn-dark"/>
            
        </form>
    </div>  

</body>
