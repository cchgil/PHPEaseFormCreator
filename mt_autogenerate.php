<?  
  //include ("f.php"); 
  //os();
 
  ob_start();
  
  $archivo_salida="mt_xyz.php";   //Nombre del archivo a Generar

  $titulo_form           ="Registro  de Usuarios";
  $NombreBBDD            ="sistemap_metro";
  $UserBBDD              ='sistemap_ppal';
  $PassBBDD              ='mws2011';
  $ServerBBDD            ='localhost';
  $NombreTabla           ="ctes";
  $campo_clave           ="EMAIL_CTE";
  $NomForm               ="frm_user";
  $AnchoTabla            ="750px";
  
  $archivo_procesamiento = "p_".$archivo_salida;
  
  $TamCamp               =30;
  $cuerpo_1archivo       = "\$con_pro  = \"INSERT INTO `$NombreTabla` ("; 
  $cuerpo_2archivo       = ") VALUES (";
  $cuerpo_3archivo       = "\$con_bus = \"SELECT * FROM $NombreTabla WHERE $campo_clave='\$_POST[$campo_clave]'\";\n";
  $cuerpo_3archivo       =$cuerpo_3archivo."\$res_bus = mysql_query(\$con_bus) or die(\"La consulta falló:\" . mysql_error());\n";
  $cuerpo_3archivo       =$cuerpo_3archivo."echo '$res_bus';\n";
  $cuerpo_3archivo       =$cuerpo_3archivo."\$existe=mysql_num_rows(\$res_bus);\n";
  $cuerpo_3archivo       =$cuerpo_3archivo."if (\$existe>0){ //Si es un registro existente debemos hacer una actualización, no inclusion.\n";
  $cuerpo_3archivo       =$cuerpo_3archivo."\$sSQL=\"UPDATE $NombreTabla SET ";

  
    //Abrir la BBDD 
  //$vkl=aDB($x,$q);
  //mysql_select_db($db,$vkl) or die("No pudo seleccionarse la BD.<BR>"); // Abrir la BBDD
  
  $enlaze=mysql_connect($ServerBBDD,$UserBBDD, $PassBBDD) or die("No pudo conectarse a la BD: ".mysql_error());
  mysql_select_db($NombreBBDD,$enlaze);
  
  $con = "SHOW COLUMNS FROM  $NombreTabla";
  //echo $con;exit;
  $res = mysql_query($con) or die("La consulta fallo: " . mysql_error());


	

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><? echo $titulo_form; ?></title>
<link href="seflt_style.css" rel="stylesheet" type="text/css">
</head>

<body>
 <form name="<? echo $NomForm ?>" id="<? echo $NomForm ?>" method="post" action="<? echo $archivo_procesamiento ?>">
<table width="<? echo $AnchoTabla; ?>" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="FormTitle"><? echo $titulo_form ?></span></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="<? echo $AnchoTabla; ?>" border="0" align="center" cellpadding="4" cellspacing="2" class="TableForm">
  <tr>
    <td class="FormTitle">&nbsp;</td>
    <td>
      </td>
  </tr>
  <?
  
  if (mysql_num_rows($res) > 0) {
    while ($fila = mysql_fetch_assoc($res)) {
		
		$maxlenth = ereg_replace("[^0-9]", "", $fila[Type]);
        echo "<tr>
              <td class=\"FormLabelText\">$fila[Field] </td>
              <td><input type=\"text\" name=\"$fila[Field]\" id=\"$fila[Field]\" size=\"$TamCamp\" maxlength=\"$maxlenth\"></td>
             </tr>";
			 
	    $cuerpo_1archivo= $cuerpo_1archivo."\n `$fila[Field]`," ;
		$cuerpo_2archivo= $cuerpo_2archivo."\n '\$_POST[$fila[Field]]',";
        $cuerpo_3archivo= $cuerpo_3archivo."\n $fila[Field]='\$_POST[$fila[Field]]',";
    }
  }
  $cuerpo_1archivo = substr ($cuerpo_1archivo, 0, -1);
  $cuerpo_2archivo = substr ($cuerpo_2archivo, 0, -1).")\"; \n  \$res_pro = mysql_query(\$con_pro) or die(\"La consulta fallo:\" . mysql_error());\n";
  $cuerpo_2archivo = $cuerpo_2archivo." echo \"REGISTRO AGREGADO\";exit;\n";
  $cuerpo_3archivo = substr ($cuerpo_3archivo, 0, -1)." WHERE $campo_clave='\$_POST[$campo_clave]'\";\n";
  $cuerpo_3archivo= $cuerpo_3archivo." \$res2 = mysql_query(\$sSQL) or die(\"La consulta fallo:\" . mysql_error());\n";
  $cuerpo_3archivo= $cuerpo_3archivo." echo \"REGISTRO ACTUALIZADO\";exit;\n";
  $cuerpo_3archivo= $cuerpo_3archivo."}\n";
  
   $file = fopen($archivo_procesamiento, "w");
   fwrite($file, "<?" . PHP_EOL);
   fwrite($file, "header(\"Cache-Control: no-store, no-cache,must-revalidate\");" . PHP_EOL);
   
   //$enlace = mysql_connect($y,$l, $p) or die("No pudo conectarse a la BD: " . mysql_error());
   
   fwrite($file, "mysql_connect('$ServerBBDD','$UserBBDD', '$PassBBDD') or die(\"No pudo conectarse a la BD: \".mysql_error());" . PHP_EOL);
   fwrite($file, "mysql_select_db('$NombreBBDD');\n" . PHP_EOL);
   fwrite($file, $cuerpo_3archivo . PHP_EOL);
   fwrite($file, $cuerpo_1archivo.$cuerpo_2archivo . PHP_EOL);
   fwrite($file, "?>" . PHP_EOL);
   fclose($file);

  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="<? echo $AnchoTabla; ?>" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input name="btn" type="submit" class="boton azul" id="btn" value="Guardar"></td>
  </tr>
</table>
</form>
<?
  $html = ob_get_contents();
  file_put_contents($archivo_salida, $html);
  ob_end_flush();
?>

</body>
</html>
