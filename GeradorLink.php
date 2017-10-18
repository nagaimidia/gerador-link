<?php
##########################Criado por Jose Robson#########################################################
##########################ATUALIZAÇÃO 23/07/2013#########################################################
//Update 22/06/2011-------------------------------------------------------------------------
class GeradorLink{
		  //Troca valor por outro
		  protected function trocaPor($texto,$palavra,$trocaPor){
		  return ereg_replace($palavra, $trocaPor, $texto);}
		
		  //Remover acentos sem utf8
		  public function removeAcentos($Msg){
		  $a = array(
					'/[ÂÀÁÄÃ]/'=>'A',
				  '/[âãàáä]/'=>'a',
					'/[ÊÈÉË]/'=>'E',
				   '/[êèéë]/'=>'e',
					 '/[ÎÍÌÏ]/'=>'I',
					 '/[îíìï]/'=>'i',
					 '/[ÔÕÒÓÖ]/'=>'O',
					'/[ôõòóö]/'=>'o',
					'/[ÛÙÚÜ]/'=>'U',
					'/[ûúùü]/'=>'u',
					'/ç/'=>'c',
					'/Ç/'=> 'C');
			// Tira o acento pela chave do array                        
			 return preg_replace(array_keys($a), array_values($a), $Msg);
			 unset($a); unset($Msg);
		 }
		 
		 //Nessa parte remove conteúdo com codificação UTF8
		 private function removeAcentosUtf8($str, $enc = "UTF-8"){
			$acentos = array(
			"A" => "/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/",
			"a" => "/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/",
			"C" => "/&Ccedil;/",
			"c" => "/&ccedil;/",
			"E" => "/&Egrave;|&Eacute;|&Ecirc;|&Euml;/",
			"e" => "/&egrave;|&eacute;|&ecirc;|&euml;/",
			"I" => "/&Igrave;|&Iacute;|&Icirc;|&Iuml;/",
			"i" => "/&igrave;|&iacute;|&icirc;|&iuml;/",
			"N" => "/&Ntilde;/",
			"n" => "/&ntilde;/",
			"O" => "/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/",
			"o" => "/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/",
			"U" => "/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/",
			"u" => "/&ugrave;|&uacute;|&ucirc;|&uuml;/",
			"Y" => "/&Yacute;/",
			"y" => "/&yacute;|&yuml;/",
			"a." => "/&ordf;/",
			"o." => "/&ordm;/");
			
			return preg_replace($acentos,
			array_keys($acentos),
			htmlentities($str,ENT_NOQUOTES, $enc));
		}
		 
		
	 	//funcão para eliminar todo html
		public function eliminaHtml($document){
			$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
						   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
						   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
						   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
							);
			$document = trim($document);
			$text = preg_replace($search, '', $document);
			// para garantir
			$text = strip_tags($text);
			return $text;
			unset($text);
			unset($document);
		}
		
		//Removendo caracteres tipo html
		private function cEspeciaisHtml($palavra)
		{
				$palavra = trim($palavra);
				//variavel com caracter invalido para a string requerida
				$vowels = array(chr(130),"&sbquo;",chr(131),"&fnof",chr(132),"&bdquo;",chr(133),"&hellip;",chr(134),"&dagger;",chr(135),"&Dagger;",chr(136),"&circ;",chr(137),"&permil;",chr(138),"&Scaron;",chr(139),"&lsaquo;",chr(140),"&OElig;",chr(145),"&lsquo;",chr(146),"&rsquo;",chr(147),"&ldquo;",chr(148),"&rdquo;",chr(149),"&bull;",chr(150),"&ndash;",chr(151),"&mdash;",chr(152),"&tilde;",chr(153),"&trade;",chr(154),"&scaron;",chr(155),"&rsaquo;",chr(156),"&oelig;",chr(159),"&Yuml;","&euro;","&quot;","&amp;","&lt;","&gt;","&nbsp;","&copy;","&curren;","&deg;","&divide;","&iquest;","&laquo;","&not;","&middot;","&macr;","&micro;","&acute;");
				//tirando "
				$texto = str_replace($vowels, "", "$palavra");
				$texto = $this->trocaPor($texto,"-"," ");
				$texto = $this->trocaPor($texto,"_"," ");
				//echo $texto.'<br />';
				return $texto;
				unset($texto);
				unset($palavra);
				unset($vowels);
		}
		 
		//Removendo caracteres especiais
		private function cEspeciais($palavra)
		{
				$palavra = trim($palavra);
				//retira possíveis entradas html
				$palavra = $this->cEspeciaisHtml($palavra);
				//variavel com caracter invalido para a string requerida
				$vowels = array("!","?","(",")","[","]","{","}",":","|","\\",",",";","`",".","'","\"","''","'",",","","^","~","&","$","%","@","+","*","/","#","=","»","«","<",">","¶","´","ß","º","¿","®","ñ","Ñ","Ø","×","ƒ","Æ","æ","¥","•","¸","¹","³","²",".","?",":","=","-","+","*","?","?","?","?");
				
				//tirando "
				$texto = str_replace($vowels, "", "$palavra");
				$texto = $this->trocaPor($texto,"-"," ");
				$texto = $this->trocaPor($texto,"_"," ");
				//echo $texto.'<br />';
				return $texto;
				unset($texto);
				unset($palavra);
				unset($vowels);
		}
		
		
		//Transforma caracteres especiais e espacos em tracos
		private function tiraCaracterTraco($palavra)
		{
				$palavra = $this->cEspeciais(trim($palavra));
				//variavel com caracter invalido para a string requerida
				$texto = $this->trocaPor(trim($palavra),"     "," ");
				$texto = $this->trocaPor(trim($palavra),"    "," ");
				$texto = $this->trocaPor(trim($texto),"   "," ");
				$texto = $this->trocaPor(trim($texto),"  "," ");
				$texto = $this->trocaPor(trim($texto),"\r"," ");
				$texto = $this->trocaPor(trim($texto),"\n"," ");
				$texto = $this->trocaPor(trim($texto),"\r\n"," ");
				$texto = $this->trocaPor(trim($texto),"\t"," ");
				$texto = preg_replace("/(<br.*?>)/i","", $texto);
				$texto = $this->trocaPor($texto," ","-");
				return $texto;
				unset($texto);
				unset($palavra);
		}
		
		//Transforma caracteres especiais e espacos em underline
		private function tiraCaracterUnderline($palavra)
		{
				$palavra = $this->cEspeciais(trim($palavra));
				//variavel com caracter invalido para a string requerida
				$texto = $this->trocaPor(trim($palavra),"     "," ");
				$texto = $this->trocaPor(trim($palavra),"    "," ");
				$texto = $this->trocaPor(trim($texto),"   "," ");
				$texto = $this->trocaPor(trim($texto),"  "," ");
				$texto = $this->trocaPor($texto," ","_");
				return $texto;
				unset($texto);
				unset($palavra);
		}
		
		//Gera link com traço
		public function gerarLinkTraco($link)
		{ return strtolower(trim($this->tiraCaracterTraco($this->removeAcentos($this->eliminaHtml(trim($link))))));}
		
		//Gera link com underline
		public function gerarLinkUnderline($link)
		{ return strtolower(trim($this->tiraCaracterUnderline($this->removeAcentos($this->eliminaHtml(trim($link))))));}
		
		//Gera link com traço com utf8
		public function gerarLinkTracoUtf8($link)
		{ return strtolower(trim($this->tiraCaracterTraco($this->removeAcentosUtf8($this->eliminaHtml(trim($link))))));}
		
		//Gera link com underline com utf8
		public function gerarLinkUnderlineUtf8($link)
		{ return strtolower(trim($this->tiraCaracterUnderline($this->removeAcentosUtf8($this->eliminaHtml(trim($link))))));}
		
}//fim Classe
?>
