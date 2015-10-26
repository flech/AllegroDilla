<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form method="POST" action="">
<table style="border:1px solid black;">
<tr>
<td>Cena zakupu towaru netto</td><td><input type="text" name="liczba1" size="10"></td></tr>
<tr>
<td>Cena sprzedaży towaru BRUTTO</td><td><input type="text" name="liczba2" size="10"></td></tr>
<tr>
<td>Zysk netto/brutto ?</td>
<td>
<select name="znak">
<option>ZyskNetto</option>
<option>ZyskBrutto</option>
</select>
</td>
<tr><td>
<input type="submit" value="Oblicz"></tr></td></table>
</form>



<?php
$liczba1 = $_POST['liczba1'];
$liczba2 = $_POST['liczba2'];
$znak = $_POST['znak'];
$wynik = "";
switch ($znak)
{
 case "ZyskNetto":
   echo ("Zysk Netto wyniesie = ");
   $wynik = (($liczba2/1.23)-$liczba1)-(($liczba2/1.23)*1.23*0.07);
   break;
 case "ZyskBrutto":
    echo ("Zysk Brutto(minus dochodowy) wyniesie = ");
   $wynik = ((($liczba2/1.23)-$liczba1)-(($liczba2/1.23)*1.23*0.07))*0.82;
   break;
}
echo "<b>" . $wynik . "</b>";
?>
</body>
</html>