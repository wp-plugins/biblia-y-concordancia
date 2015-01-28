=== Biblia y Concordancia ===

Contributors: bendicion.net
Donate link: http://bendicion.net/
Tags: biblia, bible
Requires at least: 4.0.1
Stable tag: 6.4
Tested up to: 4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Este plugin permite buscar en varias versiones de la Biblia. Incluye Audio. Visita Bendicion.net

== Description ==
En Bendicion.net desarrollamos este plugin de WordPress con varias versiones de la Biblia en espanol y audio, y permite al usuario buscar en la Biblia por medio de libro, capitulo, versiculo y tambien por palabras como una concordancia. Los capitulos tambien se pueden ver en forma paralela. Visita Bendicion.net

= Ver demo aqui: =  http://bibleplugin.com/biblia/

= Versiones disponibles en el plugin =

* Reina Valera 1960 (RVR 1960)
* Reina Valera 1909 (RVR 1909)
* Reina Valera Actualizada (RVA 1989)
* Reina Valera (RV 1977)
* Reina Valera (RV 2000)
* Reina Valera Contemporanea (RVC 2011)
* Reina Valera Gomez (RVG 2004)
* Sagradas Escrituras 1569
* Nueva Traduccion Viviente (NTV 2009)
* Nueva Version Internacional (NVI 1999)
* Nueva Biblia de los Hispanos (NBLH 2005)
* La Biblia de las Americas (LBLA 1997)
* Palabra de Dios para Todos (PDT 2008)
* Traduccion en Lenguaje Actual (TLA 2002)
* Dios Habla Hoy Edicion Latinoamericana (DHHL 1996)
* Biblia Version Israelita Nazarena (VIN 2007)
* Biblia en Lenguaje Sencillo (BLS 2008)
* Biblia Version Moderna de H.B. Pratt (VM 1929)
* Biblia La Palabra Version Hispanoamericana (BLPH 2011)
* King James Version (KJV)

== Installation ==
1. Sube el plugin 'biblia y concordancia' al directorio `/wp-content/plugins/`.
2. Activa el plugin por medio del menu 'Plugins' en WordPress.
3. Agrega el codigo `[bendicion_biblia]` en una pagina nueva o tambien en un post.
4. Tambien puede ser activado al agregar este codigo en un template:
   `<?php if (function_exists('display_bible_form')) { display_bible_form(); } ?>`
5. El plugin tambien puede ser usado por medio de los widgets en `Apariencia > Widgets > Biblia y Concordancia`

== Frequently Asked Questions ==
   Preguntas Frecuentes

= Si tengo una pregunta tecnica de la instalacion  =
   Puede contactarnos a info@bendicion.net

== Upgrade Notice == 
No changes yet

== Screenshots ==

1. Biblia y Concordancia
2. Busqueda de un solo versiculo
3. Busqueda de un solo capitulo
4. Vista en paralelo can versiones diferentes
5. Resultados de busqueda de la Concordancia
6. Vista en paralelo con tres versiones

== Changelog ==

= Ver demo aqui: =  http://bibleplugin.com/biblia/

= Cambios y actualizaciones del plugin =

= Por hacer... = 
* Hacer el plugin compatible con WordPress Multisite.
* Usar diferentes lenguajes para el plugin con archivos po.

= 6.4 (Enero 27, 2015) =
* **Actualizacion:** El plugin ahora funciona por medio de un API de manera que todas las actualizaciones 
ya no requieren hacer un "upgrade" del plugin a una nueva version. Todos los cambios son automaticos.
* **Bug:** Se quito el boton de "<< libro anterior" ya que no debe aparecer cuando el libro es Genesis y se quito 
el boton de "libro siguiente >>" cuando el libro es Apocalipsis.

= 6.3 (Enero 14, 2015) =
* **Nueva version:** El plugin ahora incluye la "Traduccion en Lenguaje Actual" (TLA 2002).

= 6.2 (Enero 13, 2015) =
* **Bug:** Se arreglo el boton del "capitulo siguiente >>" ya que no debe aparecer cuando el libro no tiene ese capitulo Ej.: Hebreos 14 no existe,
por lo tanto el plugin no debe mostrar el boton de "proximo capitulo" en este caso.

= 6.1 =
* **Nueva version:** El plugin ahora incluye la "Biblia La Palabra Version Hispanoamericana" (BLPH 2011) - Enero 10, 2015.

= 6.0 (Enero 1-9, 2015) =
* **Nueva version:** El plugin ahora incluye la "Biblia Version Israelita Nazarena" (VIN 2007).
* **Nueva version:** El plugin ahora incluye la "Nueva Version Internacional" (NVI 1999).
* **Nueva version:** El plugin ahora incluye la "Reina Valera" (RV 1977).
* **Nueva version:** El plugin ahora incluye la "Reina Valera" (RV 2000).
* **Nueva version:** El plugin ahora incluye la "Biblia en Lenguaje Sencillo" (BLS 2008).
* **Nueva version:** El plugin ahora incluye la "Biblia Version Moderna de H.B. Pratt" (VM 1929).

= 5.9 (Diciembre 28-30, 2014) =
* **Nueva version:** El plugin ahora incluye la version "Dios Habla Hoy Edicion Latinoamericana" (DHHL 1996).
* **Nueva version:** El plugin ahora incluye la version "La Nueva Biblia de los Hispanos" (NBLH 2005).
* **Compatibilidad:** Compatible con la version de WordPress 4.1.
* **Nueva funcion:** Cuando se selecciona un libro de la Biblia en el menu desplegable, aparece el numero de capitulos correspondiente automaticamente.
* **Nueva funcion:** Se agrego el boton "Agregar Paralelo" para ver la Biblia en 3 versiones diferentes.
* **Navegacion:** En la vista de paralelo se agrego un boton para 'Remover Paralelo'.
* **Navegacion:** En la vista de paralelo se agregaron los botones 'libro anterios' y 'libro siguiente' para navegacion.
* **Bug:** Se agrego "order by ... asc" para mostrar los versiculos y capitulos en el orden correcto ascendente.
* **Bug:** Se agrego una funcion nueva para corregir cuando la palabra de busqueda en la concordancia no era subrayada (highlighted).
* **Optimizacion:** Los numeros de los versiculos ahora son pequenos usando el codigo sup, por ejemplo <sup>3</sup>.
* **Optimizacion:** Los versiculos cambian de color (highlighter) cuando el mouse se mueve sobre ellos.

= 5.8 =
* Agregamos la version: Palabra de Dios para Todos (PDT)

= 5.7 =
* El plugin ahora tambien es mas rapido

= 5.6 =
* Mantenimiento y algunos cambios en el codigo

= 5.5 =
* Ahora tambien incluye la version en audio de la Reina Valera 1960 tomado de http://server.firefighters.org/bible_sp2.asp

= 5.4 =
* Ahora incluye las versiones:
* Reina Valera Gomez (RVG)
* La Biblia de las Americas (LBLA)
* Version en Portugues
* Version en Italiano
* Opcion para navegar por libros (libro siguiente, libro anterior). 
* Opcion para cambiar de version al leer un capitulo y tambien en la busqueda por palabras.

= 5.0 =
* Agregamos la opcion para ver capitulos en Paralelo.

= 4.0 =
* Agregamos mas versiones de la Biblia: 
* Reina Valera 1960
* Reina Valera 1909 version en Audio tomado de Word Project http://wordproject.org/bibles/audio/07_spanish/index.htm
* Reina Valera Actualizada 1989
* Reina Valera Contemporanea (RVC)
* Sagradas Escrituras 1569
* Nueva Traduccion Viviente (NTV)
* King James Version (KJV)

= 3.6 =
* Ahora se pueden buscar capitulos completos y aparece la opcion para ver el capitulo siguiente y el capitulo anterior.

= 3.5.1 =
* Arreglamos el codigo para ser compatible con la version 3.6.1 de WordPress.

= 2.5 =
* Agregamos la version Reina Valera 1909 (dominio publico) en la opcion de busqueda por palabras.

= 1.0 =
* Busqueda por palabra, verso y capitulo.
