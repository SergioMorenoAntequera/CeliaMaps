<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celia Maps</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/css/home.css')}}">
</head>
<body>
    <div class="container-fluid bg-primary text-center">

        <img id="background" src="{{url('img/resources/background.jpeg')}}" alt="">

        <div id="pageCenter">
            <div id="pageContent" class="noselect">
                <div id="logo">
                    <img class="img-fluid" src="{{url('img/icons/icon.png')}}" alt="">
                </div>
                <div id="title" style="opacity: 0">
                    CELIA MAPS
                </div>
                <div id="subTitle" style="opacity: 0">
                    Paseo por Almería a través del tiempo
                </div>
                <button id="startButton" class="fill" style="opacity:0"  onclick="location.href = (location.href.replace('/home', ''))">
                    COMENZAR
                </button>

                {{-- Las tres cosillas esas de ahí abajo --}}
                <div id="bottom">
                    <div id="bottomElements">
                        <a class="text-decoration-none text-reset" href="https://iescelia.org/web/">
                            <div class="element">
                                Centro Celia Viñas
                            </div>
                        </a>
                        |
                        <a class="devLink text-decoration-none text-reset" href="">
                            <div class="element">
                               <b>Desarrolladores</b>
                            </div>
                        </a>
                        |
                        <a class="privLink text-decoration-none text-reset" href="">
                            <div class="element">
                                Políticas de privacidad
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Ventana de los desarrolladores --}}
            <div id="developers" >
                <div class="container-fluid">
                    <div class="row justify-content-center mt-4">
                        <div class="studentContainer" style="margin-right: 5%  !important">
                            <div class="student">
                                <div class="studentHead">
                                    <img class="user" src="{{url("img/resources/luis.jpg")}}" alt="">
                                </div>
                                
                                <div class="studentBody">
                                    <p class="name">
                                        Luis David Fernández Marín
                                    </p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col p-2">
                                                <a href="mailto:luis.david.fer@gmail.com">
                                                    <img class="img-fluid" src="{{url("img/icons/email.svg")}}" alt="">
                                                </a>
                                            </div>
                                            <div class="col p-2">
                                                <a href="https://github.com/luisdavidfer">
                                                    <img class="img-fluid" src="{{url("img/icons/github.svg")}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="studentContainer" style="margin-right: 13% !important">
                            <div class="student">
                                <div class="studentHead">
                                    <img class="user" src="{{url("img/resources/carmen.jpg")}}" alt="">
                                </div>
                                
                                <div class="studentBody">
                                    <p class="name">
                                        Carmen Castro Gutierrez
                                    </p>
                                    <br>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col p-2">
                                                <a href="mailto:carmencastro0101@gmail.com">
                                                    <img class="img-fluid" src="{{url("img/icons/email.svg")}}" alt="">
                                                </a>
                                            </div>
                                            <div class="col p-2">
                                                <a href="https://github.com/karmela01">
                                                    <img class="img-fluid" src="{{url("img/icons/github.svg")}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="studentContainer" style="margin-left: 13% !important">
                            <div class="student">
                                <div class="studentHead">
                                    <img class="user" src="{{url("img/resources/paula.jpg")}}" alt="">
                                </div>
                                
                                <div class="studentBody">
                                    <p class="name">
                                        Paula Asensio Sánchez
                                    </p>
                                    <br>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col p-2">
                                                <a href="mailto:paulaasensiodaw@gmail.com">
                                                    <img class="img-fluid" src="{{url("img/icons/email.svg")}}" alt="">
                                                </a>
                                            </div>
                                            <div class="col p-2">
                                                <a href="https://github.com/paulaasensio14">
                                                    <img class="img-fluid" src="{{url("img/icons/github.svg")}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="studentContainer" style="margin-left: 5% !important">
                            <div class="student">
                                <div class="studentHead">
                                    <img class="user" src="{{url("img/resources/sergio.jpg")}}" alt="">
                                </div>
                                <div class="studentBody">
                                    <p class="name">
                                        Sergio Moreno Antequera
                                    </p> <br>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col p-2">
                                                <a href="mailto:seranmoreno500@gmail.com">
                                                    <img class="img-fluid" src="{{url("img/icons/email.svg")}}" alt="">
                                                </a>
                                            </div>
                                            <div class="col p-2">
                                                <a href="https://github.com/SergioMorenoAntequera">
                                                    <img class="img-fluid" src="{{url("img/icons/github.svg")}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="privacy">
                <div id="closePrivacy" class="cornerButton">
                    <img style="position: relative; top: 6px" src="{{url('img/icons/close.svg')}}" alt="">
                </div>
                <div class="content">
                    <strong>DATOS DEL RESPONSABLE</strong><br>
                    <br>
                    Identidad del Responsable: IES Celia Viñas (Junta de Andalucía)<br>
                    NIF/CIF: s4111001f<br>
                    Dirección: C/ Javier Sanz 15, 04004 Almería (España)<br>
                    Correo electrónico: 04001151.edu@juntadeandalucia.es<br>
                    <br>
                    En este página encontrará la información relativa a los términos y condiciones legales que definen las relaciones entre los usuarios y el IES Celia Viñas como responsable de esta web. Como usuario, es importante que conozca estos términos antes de continuar su navegación.<br>
                    <br>
                    El IES Celia Viñas, como responsable de esta web, asume el compromiso de procesar la información de sus usuarios con plenas garantías y cumplir con los requisitos nacionales y europeos que regulan la recopilación y uso de los datos personales de los usuarios.<br>
                    <br>
                    El IES Celia Viñas ha adecuado esta web a las exigencias del Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016 relativo a la protección de datos de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos y por el que se deroga la Directiva 95/46/CE (RGPD), así como con la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y Comercio Electrónico (LSSICE o LSSI).<br>
                    <br>
                    <strong>CONDICIONES GENERALES DE USO</strong><br>
                    <br>
                    Las presentes Condiciones Generales regulan el uso (incluyendo el mero acceso) a las páginas de web integrantes del sitio web del IES Celia Viñas, incluidos los contenidos y servicios puestos a disposición en ella. Toda persona que acceda a la web (la denominaremos "usuario" a partir de ahora), acepta someterse a las Condiciones Generales vigentes en cada momento del portal https://iescelia.org<br>
                    <br>
                    El usuario tendrá acceso a toda la información disponible gratuitamente y sin ninguna contrapartida en la web. Esta web solo tiene propósitos informativos y carece de cualquier validez oficial.<br>
                    <br>
                    <strong>DATOS PERSONALES QUE RECABAMOS Y CÓMO LO HACEMOS</strong><br>
                    <br>
                    El sitio web iescelia.org no recoge ningún tipo de datos de tipo personal de sus usuarios.<br>
                    <br>
                    <strong>COMPROMISOS Y OBLIGACIONES DE LOS USUARIOS</strong><br>
                    <br>
                    El usuario queda informado, y acepta, que el acceso a la presente web no supone, en modo alguno, el inicio de una relación institucional con el IES Celia Viñas. De esta forma, el usuario se compromete a utilizar el sitio web, sus servicios y contenidos sin contravenir la legislación vigente, la buena fe y el orden público.<br>
                    <br>
                    Queda prohibido el uso de la web con fines ilícitos o lesivos, o que, de cualquier forma, puedan causar perjuicio o impedir el normal funcionamiento del sitio web. Respecto de los contenidos de esta web, se prohíbe: Su reproducción, distribución o modificación, total o parcial, a menos que se cuente con la autorización del IES Celia Viñas como legítimo titular; Cualquier vulneración de los derechos del prestador o del IES Celia Viñas como legítimo titular; Su utilización para fines comerciales o publicitarios.<br>
                    <br>
                    En la utilización de la web https://iescelia.org, el usuario se compromete a no llevar a cabo ninguna conducta que pudiera dañar la imagen, los intereses y los derechos del IES Celia Viñas o de terceros, así que ninguna acción que pudiera dañar, inutilizar o sobrecargar los portales de modo que se impidiera, de cualquier forma, la normal utilización de la web.<br>
                    <br>
                    No obstante, el usuario debe ser consciente de que las medidas de seguridad de los sistemas informáticos en Internet no son enteramente fiables y que, por tanto, el IES Celia Viñas no puede garantizar la inexistencia de malware u otros elementos que puedan producir alteraciones en los sistemas informáticos (software y hardware) del usuario o en sus documentos electrónicos y ficheros contenidos en los mismos, aunque se hayan puesto todos los medios posibles y las medidas de seguridad oportunas para evitar la presencia de estos elementos dañinos.<br>
                    <br>
                    <strong> PLATAFORMA DE RESOLUCIÓN DE CONFLICTOS</strong><br>
                    <br>
                    La Comisión Europea pone a disposición de todos los ciudadanos y ciudadanas una plataforma gratuita de resolución de litigios en el ámbito de internet. Esta plataforma se encuentra disponible en el siguiente enlace: <a href="http://ec.europa.eu/consumers/odr/">http://ec.europa.eu/consumers/odr/</a><br>
                    <br>
                    <strong> DERECHOS DE PROPIEDAD INTELECTUAL E INDUSTRIAL</strong><br>
                    <br>
                    En virtud de lo dispuesto en los artículos 8 y 32.1, párrafo segundo, de la Ley de Propiedad Intelectual, quedan expresamente prohibidas la reproducción, la distribución y la comunicación pública, incluida su modalidad de puesta a disposición, de la totalidad o parte de los contenidos de esta página web, con fines comerciales, en cualquier soporte y por cualquier medio técnico, sin la autorización expresa del IES Celia Viñas. El usuario se compromete a respetar los derechos de Propiedad Intelectual titularidad del IES Celia Viñas.<br>
                    <br>
                    Sí podrán utilizarse los contenidos publicados en esta web con fines exclusivamente no comerciales, siempre que se cite la fuente y no se altere el contenido ni se saque de contexto, y, en cualquier caso, dentro de los términos del <em>fair use</em> o uso razonable.<br>
                    <br><
                    El usuario conoce y acepta que la totalidad de los sitios web, conteniendo sin carácter exhaustivo el texto, software, contenidos (incluyendo estructura, selección, ordenación y presentación de los mismos) podcast, fotografías, material audiovisual y gráficos, está protegida por los derechos de autor que se derivan de los tratados internacionales en los que España es parte y otros derechos de propiedad y leyes de España.<br>
                    <br>
                    En el caso de que un usuario o un tercero consideren que se ha producido una violación de sus legítimos derechos de propiedad intelectual por la introducción de un determinado contenido en la web, deberá notificar dicha circunstancia al IES Celia Viñas indicando<br>
                    <br>
                    <strong>ENLACES EXTERNOS</strong><br>
                    <br>
                    La página web del IES Celia Viñas proporciona enlaces a otros sitios web propios y a contenidos que son propiedad de terceros. Las condiciones de uso de esos contenidos deben consultarse en los respectivos sitios web que los alojan.<br>
                    <br>
                    <strong>POLÍTICA DE COMENTARIOS</strong><br>
                    <br>
                    En nuestra web no se permite la publicación de comentarios.<br>
                    <br>
                    <strong>EXCLUSIÓN DE GARANTÍAS Y RESPONSABILIDAD</strong><br>
                    <br>
                    El IES Celia Viñas no otorga ninguna garantía ni se hace responsable, en ningún caso, de los daños y perjuicios de cualquier naturaleza que pudieran traer causa de:<br>
                    <ul>
                        <li>La falta de disponibilidad, mantenimiento y efectivo funcionamiento de las webs, o de sus servicios y contenidos.</li>
                        <li>La existencia de malware, programas maliciosos o lesivos en los contenidos.</li>
                        <li>El uso ilícito, negligente, fraudulento o contrario a este Aviso Legal.</li>
                        <li>La falta de licitud, calidad, fiabilidad, utilidad y disponibilidad de los servicios prestados por terceros y puestos a disposición de los usuarios en el sitio web.</li><br>
                    </ul>
                    El prestador no se hace responsable bajo ningún concepto de los daños que pudieran derivarse del uso ilegal o indebido de las presentes páginas web.<br>
                    <br>
                    <strong>LEY APLICABLE Y JURISDICCIÓN</strong><br>
                    <br>
                    Con carácter general, las relaciones entre el IES Celia Viñas y los usuarios de sus servicios telemáticos presentes en esta web se encuentran sometidas a la legislación y jurisdicción españolas y a los tribunales de Andalucía.<br>
                    <br>
                    <strong>POLÍTICA DE PRIVACIDAD</strong><br>
                    <br>
                    Su privacidad es importante para nosotros.<br>
                    <br>
                    Nunca solicitamos información personal en nuestra web ni, en consecuencia, guardamos datos personales de los usuarios.<br>
                    <br>
                    El IES Celia Viñas ha adecuado esta web a las exigencias del Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016 relativo a la protección de datos de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos y por el que se deroga la Directiva 95/46/CE (RGPD), así como con la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y Comercio Electrónico (LSSICE o LSSI).<br>
                    <br>
                    <strong>RESPONSABILIDAD DEL TRATAMIENTO DE LOS DATOS PERSONALES</strong><br>
                    <br>
                    En este momento, el IES Celia Viñas no almacena ningún dato personal de sus usuarios. No obstante, por imperativo legal, le indicamos que el responsable del tratamiento de esos datos, en caso de que se trataran de algún modo, es:<br>
                    <br>
                    Identidad del Responsable: IES Celia Viñas<br>
                    NIF/CIF: s4111001f<br>
                    Dirección: C/ Javier Sanz 15, 04004 Almería (España)<br>
                    Correo electrónico: 04001151.edu@juntadeandalucia.es<br>
                    Actividad: Educación<br>
                    <br>
                    <strong>PRINCIPIOS QUE APLICAREMOS A SU INFORMACIÓN PERSONAL</strong><br>
                    <br>
                    En el tratamiento de sus datos personales, en el caso de que algún día necesitemos recabar alguno, aplicaremos los siguientes principios que se ajustan a las exigencias del nuevo reglamento europeo de protección de datos:<br>
                    <br>
                    Principio de licitud, lealtad y transparencia: Siempre vamos a requerir su consentimiento para el tratamiento de sus datos personales para uno o varios fines específicos, siempre le informaremos previamente con absoluta transparencia.<br>
                    <br>
                    Principio de minimización de datos: Solo vamos a solicitar datos estrictamente necesarios en relación con los fines para los que los requerimos, y siempre los mínimos posibles.<br>
                    <br>
                    Principio de limitación del plazo de conservación: Los datos serán mantenidos durante no más tiempo del necesario para los fines del tratamiento. Le informaremos del plazo de conservación correspondiente y periódicamente revisaremos nuestras listas y eliminaremos aquellos registros inactivos durante un tiempo considerable.<br>
                    <br>
                    Principio de integridad y confidencialidad: Sus datos serán tratados de tal manera que se garantice una seguridad adecuada y la confidencialidad.<br>
                    <br>
                    <strong>¿CÓMO HEMOS OBTENIDO SUS DATOS?</strong><br>
                    <br>
                    En el momento actual, como ya hemos dicho, el IES Celia Viñas no recaba ningún dato de carácter personal.<br>
                    <br>
                    <strong>CAMBIOS EN LA POLÍTICA DE PRIVACIDAD</strong><br>
                    <br>
                    El IES Celia Viñas se reserva el derecho a modificar la presente política para adaptarla a novedades legislativas o jurisprudenciales, así como a prácticas de la industria. En dichos supuestos, el IES Celia Viñas anunciará en esta página los cambios introducidos con razonable antelación a su puesta en práctica.<br>
                    <br>
                    <strong>CONTACTO</strong><br>
                    <br>
                    En caso de que cualquier usuario tuviese alguna duda acerca de estas condiciones legales o cualquier comentario sobre el portal https://iescelia.org, por favor, diríjase a 04001151.edu@juntadeandalucia.es.<br>
                    <br>
                    Este aviso legal ha sido actualizado por última vez el 29 de mayo de 2019.<br>
                    <br>
                </div>
            </div>
            {{-- Boton para ir al menu de admin --}}
            <div id="admin">
                <a href="{{route('login')}}">
                    <img src="{{url('img/icons/admin.png')}}" alt="">
                </a>
            </div>
        </div>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function(){
            //Celia maps aparece
            $("#title").animate({
                opacity:1
                }, 600, function(){
                //El subtitulo aparece
                $("#subTitle").css({display:"block"});
                $("#subTitle").animate({
                    top:"0px",
                    opacity:"1",
                }, 500, function(){
                    //El subtitulo rebota
                    $("#subTitle").animate({
                        top:"-3px",
                    }, 200, function(){
                        //El boton aparece
                        $("#startButton").animate({
                            opacity:1,
                        }, function(){
                            //creditos de abajo aparecen
                            $("#bottom").fadeToggle();
                        });
                    });
                });
            });

            $("#admin").click(function(){
                window.location.href = "{{route("map.index")}}";
            });

            $(".devLink").click(function(e){
                e.preventDefault();
                var devs = $("#developers");
                if(devs.css("display") == "none"){
                    devs.css({
                        display: "block",
                    });
                    devs.animate({
                        opacity: 1,
                        top: "5%",
                    }, 400);
                } else {
                    devs.animate({
                        opacity: 0,
                        top: "30%",
                    }, 400, function(){
                        devs.css({
                            display: "none",
                        });
                    });
                }
                
                
                
                
            });

            $(".privLink").click(function(e){
                e.preventDefault();
                var priv = $("#privacy");

                if(priv.css("display") == "none"){
                    priv.css({
                        display: "block",
                    });
                    priv.animate({
                        top:"10%",
                        opacity: 1,
                    }, 400);
                } else {
                    priv.animate({
                        opacity: 0,
                        top: "30%",
                    }, 600, function(){
                        priv.css({
                            display: "none",
                        });
                    });
                }
                
            })

            $("#closePrivacy").click(function(){
                var priv = $(this).parents("#privacy");
                priv.animate({
                    top:"30%",
                    opacity: 0,
                }, 400, function(){
                    priv.css({
                        display:"none",
                    });
                });
            });
        });
    </script>
</body>
</html>