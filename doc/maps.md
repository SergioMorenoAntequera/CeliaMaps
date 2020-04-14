# Administración de mapas
La administración de mapas está recogida sobre el siguiente icono dentro del backend de la aplicación en la barra de navegación de la izquierda.


Podemos hacer click directamente en este icono y nos llevará al índice donde se encuentran todos los mapas que hayamos introducido, al igual que si ponemos el ratón encima de este icono y seleccionamos “Índice” en el menú desplegable que nos aparece.

## Añadir un nuevo mapa
Si no tendremos ningún registro nos aparecerá una lista vacía con el siguiente icono en la parte inferior de la página.

Si le hacemos click nos dirigirá al formulario de inserción de mapas.

En el cual tendremos que añadir la información referente al mapa, siendo los campos con * los obligatorios, Título del mapa, Fecha del mapa y el mapa en si. Si queremos detallar más tendremos un menú desplegable.

El desplegable de información adicional donde podremos añadir más información útil a nuestro mapa como una descripción ligera, la ciudad de la que se trata y una miniatura. Si no se añade miniatura se creará una automáticamente basada en el mapa.

Aparte de ese desplegable tendremos otro en la parte inferior antes de poder continuar, el de inserción de calles.

En este podremos seleccionar un mapa ya existente del cual podremos heredar las calles que contenga para agilizar el proceso de asociación de calles al la mayoría de las calles en un mapa estar incluidas en otro.

Una vez hayamos seleccionado las propiedad deseadas para nuestro mapa tendremos que darle al botón de continuar donde iremos a la vista de alineamiento que explicaremos a continuación cuando hablemos de “El botón de alineamiento” en el siguiente punto. Por ahora volvamos al índice de mapas.

## Índice de mapas
En esta nueva vista podremos identificar unas tarjetas las cuales representan nuestros mapas introducidos. Formadas por un número a la izquierda justo a dos flechas.

Las cuales usaremos para organizar el orden en el que queramos que aparezcan los mapas en el menú del frontend. Es decir, cuanto más arriba estén más importancia se les dará (Es recomendable hacer que el de mayor importancia sea el más actual para que sirva como base para el resto).

En la parte derecha de las tarjetas podemos ver alguna información del mapa como su título, una miniatura del mismo, la ciudad a la que se refiere, el año y una pequeña descripción.

### Ver información de un mapa
En esta parte si decidimos hacer click en la miniatura del mapa nos dirigirá a una página en la cual podemos ver información más detallada. Como por ejemplo el listado de calles que se encuentren asociadas al mapa en cuestión un botón de modificar del que ya hablaremos.

Volviendo al panel anterior, en la parte superior derecha de las tarjetas aparecen los botones de opciones de los mapas.

### Alinear
Nos llevará a una página donde podremos ver de qué forma está nuestro mapa alineado con un mapa real de la zona en la cual estemos trabajando. Además de modificar la misma. Si lo pulsamos llegaremos a la siguiente vista:

En esté menú nuestra labor será la de hacer coincidir las calles de nuestro mapa con las formas geométricas azules que representan calles reales en nuestro mapa, hablaremos de como se pueden adaptar estás formas geométricas (O mejor llamadas marcadores) más adelante en el apartado de “Marcadores”.

Por ahora centrémonos en el mapa y en nuestras herramientas para trabajar con él, En la parte superior podremos encontrar una serie de iconos los cuales usaremos para modificar las propiedades del mismo y como se verá representado.

Con todas ellas sus efectos se verán representados al ¡hacer click y arrastrar en las esquinas del mapa. Ordenado de izquierda a derecha sus funciones son:
- Redimensionar el mapa
- Rotar el mapa
- Redimensionar y rotal el mapa
- Distorsionarl el mapa
- Mostrar contorno del mapa
- Modificar su transparencia
- Deshacer cambios
- Bloquear mapa

Además de todo esto se podrá arrastrar el mapa el mapa en cualquier momento manteniendo el click y moviendo el cursor por encima del mapa.

Una vez nos encontremos satisfechos con el resultado tendremos que dar click en el botón de guardado en la parte inferior derecha de la pantalla para confirmar los cambios.

### Editar

Haciendo click en esta opción se nos dirigirá a la siguiente parte de la aplicación donde seremos capaces de modificar la información que ya hayamos introducido previamente, incluso subir una imagen para sustituir al mapa o a su miniatura.

Podremos ver dos menús desplegables que al hacer click se abrirán para mostrar por un lado información no obligatoria y adicional de los mapas.

Y el de calles asociadas donde podremos modificar todas las calles que tiene un mapas además de asociarlas/Quitarlas al mapa todas a la vez haciendo uso de las cajas con tics en el menú de “Calles actuales”

Las calles bajo “Calles del mapa” son las que este contiene, mientras que las que están bajo “Añadir calles” son las que están en la base de datos y se pueden añadir.

Por otro lado, en el panel de “Heredar” tendremos las siguientes opciones:

Aquí tendremos la opción de seleccionar un mapa que aparezca en la parte izquierda de la lista para que aparezcan todas las calles que tiene ese mapa y con las cajas poder seleccionar las calles que queremos que tenga al igual que buscarlas con la barra de búsqueda de arriba.

Cuando hayamos terminado con todas las opciones al final del formulario podremos ver 2 botones.

El primero de los cuales nos devolverá al índice de mapas confirmando los cambios mientras que el segundo nos llevará al menú de alineamiento del mapa que ya hemos mencionado antes.

### Eliminar

Esté botón sirve para mostrar una ventana que nos preguntara si de verdad queremos borrarlo o cancelar la acción:

En caso afirmativo y si el mapa no tiene ninguna calle asociada la información del mapa se perderá, en caso de que tenga calles asociadas nos tendremos que dirigir al menú de modificación de mapa para retirarlas en la sección de “Calles asociadas” como ya hemos explicado anteriormente.


## Mapas en el frontend:

El usuario no administrador podrá ver todo lo relacionado con los mapas si hace click en el menú superior izquierdo del mapa desplegando el menú donde encontrará todos los mapas y podrá habilitarlo y deshabilitarlo:
