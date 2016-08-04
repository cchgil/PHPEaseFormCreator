# PHPEaseFormCreator
Target de Usuario: conocimiento basico/avanzado de PHP/MySQL

Descripcion:
Codigo tipo framework para crear o autogenerar Formularios en PHP/HTML y su lineas de codigo para guardar datos en Tablas MySQL. 
Disenado para generar un formulario con todos los campos de una tabla MySQL a la cual se tenga conectividad.
Una vez establecidos los datos de configuracion o parametros, el codigo genera 2 archivos
- Archivo HTML/PHP con todos los campos del formulario, como etiquetas de cada canmpo se coloca el nombre (para ser editado)
- Archivo PHP que procesa la data y hace actualizacion o inlcusion en la BBDD.

Es ideal para adelantar la codificacion basica de la fase de diseno de formularios de un proyecto.
PHPEaseFormCreator costa de un archivo PHP (mt_autogenerate.php) donde se debe definir las variables que autogenerann el codigo de formularios,
Estas variables son descritas a continuacion:

  $archivo_salida: nombre de archivo que sera generado como proucto del proceso 
  $titulo_form: frase que encabeza el formulario, titulo del mismo, identificacion literal
  $NombreBBDD: nombre de la Base de Datos alojada en servidor MySQL
  $UserBBDD: username de la BBDD
  $PassBBDD: password de la BBDD
  $ServerBBDD: direccion IP o namesaver del servidor MySQL
  $NombreTabla: nombre de ka tabla de BBDD
  $campo_clave: compo por donde se hara la busqueda en la tabla para actualizar datos desde el formulario, esta version solo 1 campo
  $NomForm : nombre del formulario, para efectos de vallidacion en javascript o frameworks como JQuery
  $AnchoTabla: ancho de la tabla que contiene el formulario, el valor puede estar en pixeles "px" o procentual "%"
  
  Se incluye una pequena hoja de estilo para dar formato a tabla, titulo, etiquetas y botones
  No incorpora ningun metodo de validacion, es un formulario crudo que es enviado a un archivo para su procesamiento.
