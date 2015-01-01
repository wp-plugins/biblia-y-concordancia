=== Biblia y Concordancia ===

Contributors: bendicion.net
Donate link: http://bendicion.net/
Tags: biblia, bible
Requires at least: 4.0.1
Stable tag: 5.9
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
* Sagradas Escrituras 1569
* Nueva Traduccion Viviente (NTV 2009)
* Reina Valera Contemporanea (RVC 2011)
* Reina Valera Gomez (RVG 2004)
* La Biblia de las Americas (LBLA 1997)
* Palabra de Dios para Todos (PDT 2005)
* La Nueva Biblia de los Hispanos (NBLH 2005)
* Dios Habla Hoy Edicion Latinoamericana (DHHL 1996)
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

= Cambios y actualizaciones del plugin =


= Por hacer... = 

* **Compatibilidad:** Hacer el plugin compatible con WordPress Multisite.

= 7.0 (28-30 Diciembre 2014) =

* **Nueva version:** El plugin ahora incluye la version "Dios Habla Hoy Edición Latinoamericana" (DHHL 1996).
* **Nueva version:** El plugin ahora incluye la version "La Nueva Biblia de los Hispanos" (NBLH 2005).
* **Compatibilidad:** Compatible con la version de WordPress 4.1.
* **Nueva funcion:** Cuando se selecciona un libro de la Biblia en el menu desplegable, aparece el numero de capitulos correspondiente automaticamente.
* **Nueva funcion:** Se agrego el boton "Agregar Paralelo" para ver la Biblia en 3 versiones diferentes.
* **Navegacion:** En la vista de paralelo se agrego un boton para 'Remover Paralelo'.
* **Navegacion:** En la vista de paralelo se agregaron los botones 'libro anterios' y 'libro siguiente' para navegacion.
* **Bug:** Se agrego "order by ... asc" para mostrar los versiculos y capitulos en el orden correcto ascendente.
* **Bug:** Se agrego una funcion nueva para corregir cuando la palabra de busqueda en la concordancia no era subrayada (highlighted).
* **Optimizacion:** Los numeros de los versiculos ahora son pequeños usando el codigo sup, por ejemplo <sup>3</sup>.
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
