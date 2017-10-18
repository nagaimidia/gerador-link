<?php
require("GeradorLink.php");
//estamos considerando que esse arquivo foi gerado na codificacao iso-8859-1

//Inicializando
$OB = new GeradorLink;

//variavel 1
$textinho11 = "?MARIA « TAL »/? &euro; &amp; &&& #! ``~()TAL VOCê é isso ai fautão é legalzinho É muito ísso ACHA \"\" '' LEGAL?? OlÁ mundo CABUlóSÀO SANSão &gt; &lt; &euro; é &acute; & &nbsp;  um &copy; = animalzÃOß ínigualável éssa úva óvo &quot; &amp;? SÀO São ` PÃO ";

$textinho11utf = utf8_encode("?MARIA « TAL »/? &euro; &amp; &&& #! ``~()TAL VOCê é isso ai fautão é legalzinho É muito ísso ACHA \"\" '' LEGAL?? OlÁ mundo = SÀO São ` PÃO CABUlóSÀO SANSão &gt; &lt; &euro; é &acute; & &nbsp;  um &copy; animalzÃOß ínigualável éssa úva óvo &quot; &amp;?");

//Em açao
$textinho    = $OB->gerarLinkTraco($textinho11);
$textinho11  = $OB->gerarLinkUnderline($textinho11);
$textinho2   = $OB->gerarLinkTracoUtf8($textinho11utf);
$textinho22  = $OB->gerarLinkUnderlineUtf8($textinho11utf);

//Imprimindo
echo $textinho;
echo '<br><br>'.$textinho11;
echo '<br><br>'.$textinho2;
echo '<br><br>'.$textinho22;
?>
