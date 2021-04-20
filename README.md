<h3>¡Bienvenid@!</h3>
En la sección <b>[Inicio]</b> encontrará los comentarios, tips y mayor información sobre el proyecto y requerimientos

En las secciones <b>[Usuarios]</b> y <b>[Tipo de documento]</b> encontrará los CRUDs requeridos.

A continuación, se muestran los comentarios de los requerimientos expuestos en el documento <b>[Prueba Técnica Backend]</b> compartido al correo.

<b>[1]</b> La construcción de la base de datos, se realiza desde la migración con el comando:

<b><i>php artisan migrate --seed</i></b>
Es importante agregar el comando <b>--seed</b> ya que los documentos y usuarios ejemplo son agregados desde el mismo.

<b>[2.b]</b> Los stored procedures solicitados se crean durante la migración, en el documento llamado <b>2021_04_20_121258_create_stored_procedures.php</b>

<b>[3]</b> Por otra parte, para ejecutar las pruebas unitarias de <b>DocumentTest.php</b> y <b>UserTest.php</b>, debe ejecutarse el comando desde la consola:

<b>[4.a]</b> Los tiempos de respuesta pueden ser verificados al inspeccionar la página web, en la pestaña Network. En la prueba local a la hora de entregar este proyecto, ninguno pasa del límite indicado.

<b>[4.b]</b> Alterando los valores predispuestos de las pruebas unitarias (como nombre o email) se pueden comprobar las validaciones requeridas.

<b>[5]</b> Todos los consumos (excepto el de home) se realizan desde un ajax, facilitando así el análisis en la implementación de código laravel con un front de otro tipo.

Finalmente, agradezco mucho su tiempo y consideración para formar parte de su equipo. Cualquier duda, comentario o sugerencia, lo puede dirigir conmigo.
