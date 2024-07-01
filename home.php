<<<<<<< HEAD
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
//ANCHOR - PHP CODE

// Desarrollo para produccion comentar esta linea

// URL de la imagen
    $image_url = "http://192.168.2.15:9000/api/project_badges/quality_gate?project=redar&token=sqb_f7501d5b23a650c8c43e65464a40b51808b6cdd4";
    # $image_url_bug = "http://192.168.2.15:9000/api/project_badges/measure?project=redar&metric=bugs&token=sqb_f7501d5b23a650c8c43e65464a40b51808b6cdd4";
    $image_url_security_rating = "http://192.168.2.15:9000/api/project_badges/measure?project=redar&metric=security_rating&token=sqb_f7501d5b23a650c8c43e65464a40b51808b6cdd4";
    $image_url_vulnerabilities = "http://192.168.2.15:9000/api/project_badges/measure?project=redar&metric=vulnerabilities&token=sqb_f7501d5b23a650c8c43e65464a40b51808b6cdd4";
    
    
    // http://192.168.2.15:9000/api/project_badges/measure?project=redar&metric=vulnerabilities&token=sqb_f7501d5b23a650c8c43e65464a40b51808b6cdd4

// Obtener el contenido de la imagen
    $image_data = file_get_contents($image_url);
    # $image_data_bug = file_get_contents($image_url_bug);
    $image_data_security_rating = file_get_contents($image_url_security_rating);
    $image_data_vulnerabilities = file_get_contents($image_url_vulnerabilities);


// Opcional: Guardar la imagen en el servidor
    $image_path = 'src/img/certification/quality_gate.svg';
    # $image_path_bug = 'src/img/certification/quality_bug.svg';
    $image_path_security_rating = 'src/img/certification/security_rating.svg';
    $image_path_vulnerabilities = 'src/img/certification/vulnerabilities.svg';

    file_put_contents($image_path, $image_data);
    # file_put_contents($image_path_bug, $image_data_bug);
    file_put_contents($image_path_security_rating, $image_data_security_rating);
    file_put_contents($image_path_vulnerabilities, $image_data_vulnerabilities);


// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->SMTPDebug = 0; // 0 para no mostrar salida de depuración
        $mail->isSMTP();
        $mail->Host       = 'mail.redesargentinassa.com.ar'; // Servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tu_correo@example.com'; // Usuario SMTP
        $mail->Password   = 'tu_contraseña'; // Contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 465;

        // Configuración del correo
        $mail->setFrom('de@example.com', 'Mailer');
        $mail->addAddress('a@example.com', 'Joe User'); // Destinatario
        $mail->addReplyTo($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body    = '<p><strong>Nombre:</strong> ' . htmlspecialchars($name) . '</p>
                          <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
                          <p><strong>Mensaje:</strong><br>' . nl2br(htmlspecialchars($message)) . '</p>';
        $mail->AltBody = 'Nombre: ' . htmlspecialchars($name) . "\n" .
                         'Email: ' . htmlspecialchars($email) . "\n" .
                         'Mensaje: ' . htmlspecialchars($message);

        $mail->send();
        echo 'El mensaje ha sido enviado';
    } catch (Exception $e) {
        echo "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
    }
}
?>

<!-- home.php -->
=======
>>>>>>> 734a982 (envio de mail)
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Redar</title>
    <!-- <link href="tailwind.css" rel="stylesheet"> -->
    <!-- 
    Desarrollado por: Sergio Scardigno
    Contacto: sergioscardigno82@gmail.com
              https://www.linkedin.com/in/sergio-scardigno/
    -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


    <style>
    /* Simple loader styles */

    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    .color-celeste {
        color: #3498db;
    }


    .infraestructura {
        height: 300px;
    }

    .slider-hero {
        height: 600px;
    }

    .color-violeta {
        color: #302C5F !important;
    }

    .color-violeta-fondo {
        background-color: #302C5F;
    }


    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .hidden {
        display: none;
    }

    .contenedor-movil {
        display: flex;
        justify-content: center;
        /* Centra horizontalmente */
        align-items: center;
        /* Centra verticalmente (si deseas centrar vertical también) */
        height: 100%;
        /* Asegúrate de que el contenedor padre tenga altura si deseas centrar verticalmente */
    }

    /* Media query para pantallas menores de 900px */
    @media (max-width: 899px) {
        .menu-desktop {
            display: none;
        }
    }


    /* Círculo en el centro */
    .decorative-circle {
        margin-top: 115px;
        width: 24px;
        height: 24px;
        background-color: #00B4D8;
        /* color del círculo */
        border-radius: 50%;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        z-index: 1;
    }

    /* Círculo en la derecha */
    .decorative-circle2 {
        margin-top: 115px;
        width: 24px;
        height: 24px;
        background-color: #00B4D8;
        /* color del círculo */
        border-radius: 50%;
        position: absolute;
        top: 0;
        right: 230px;
        /* Alineado a la derecha */
        transform: translateY(-50%);
        z-index: 1;
    }

    /* Círculo en la izquierda */
    .decorative-circle3 {
        margin-top: 115px;
        width: 24px;
        height: 24px;
        background-color: #00B4D8;
        /* color del círculo */
        border-radius: 50%;
        position: absolute;
        top: 0;
        left: 230px;
        /* Alineado a la izquierda */
        transform: translateY(-50%);
        z-index: 1;
    }


    .decorative-line {
        margin-top: 100px;
        height: 4px;
        background-color: #D1D5DB;
        /* color de la línea */
        width: 100%;
        position: absolute;
        top: 12px;
        /* ajusta según necesites para alinear con el círculo */
    }

    .decorative-circle,
    .decorative-circle2,
    .decorative-circle3 {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s;
    }

    .card {
        padding: 10px;
        background-color: #E3E3E3;
    }

    .pico {
        content: "";
        margin-left: 42%;
        top: 0;
        left: 50%;
        width: 0;
        height: 0;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        border-bottom: 20px solid #E3E3E3;
    }

    .div-gradiente-vertical {
        background: linear-gradient(to bottom,
                rgba(48, 44, 95, 0.8),
                rgba(64, 187, 204, 0.8));
        height: 100%;
        width: 100%;
    }

    /* // Boton de Whatsapp */
    .whatsapp-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #25D366;
        color: white;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        z-index: 1000;
    }

    .whatsapp-button img {
        width: 40px;
        height: 40px;
    }

    .badge-text {
        font-weight: bold;
        display: block;
        margin-bottom: 0.5rem;
    }

    .badge-images {
        display: flex;
        gap: 1rem;
        /* Espacio entre las imágenes */
    }

    .badge-image {
        width: auto;
        /* Permite que la imagen mantenga su proporción */
        height: 70px;
        /* Ajusta la altura según tus necesidades */
        border: 1px solid #ccc;
        /* Borde opcional para las imágenes */
        padding: 0.5rem;
        /* Espacio interno opcional alrededor de las imágenes */
        object-fit: contain;
        /* Asegura que la imagen se ajuste sin distorsionarse */
    }
    </style>

</head>

<body class="bg-white-100 text-white-900">

    <div id="preloader" class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="loader"></div>
    </div>

    <div class="whatsapp-button" onclick="openWhatsApp()">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
    </div>

    <header id="content" class="bg-white shadow p-4 hidden">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo a la izquierda -->
            <div>
                <img id="left-logo" src="src/img/logo-new.webp" alt="Left Logo" class="h-auto">
            </div>

            <!-- Logo a la derecha -->
            <div>
                <img id="right-logo" src="src/img/30_webp.webp" alt="Right Logo" class="w-20 h-auto"
                    style="margin-top:-20px;">
            </div>
        </div>

        <!-- //ANCHOR - MENU -->


        <!-- Botón de menú para móviles -->
        <div class="contenedor-movil">
            <div class="lg:hidden">
                <button id="menu-button" class="text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menú de navegación (móvil) -->
        <nav id="menu" class="hidden lg:hidden flex-col mt-4">
            <ul class="flex flex-col space-y-2">
                <li><a href="#home"
                        class="color-violeta hover:text-gray-700 font-semibold tracking-wide text-xl">Inicio</a></li>
                <li><a href="#sobre-nosotros"
                        class="color-violeta hover:text-gray-700 font-semibold tracking-wide text-xl">Sobre Nosotros</a>
                </li>
                <li><a href="#servicios"
                        class="color-violeta hover:text-gray-700 font-semibold tracking-wide text-xl">Servicios</a></li>
                <li><a href="#contacto"
                        class="color-violeta hover:text-gray-700 font-semibold tracking-wide text-xl">Contacto</a></li>
            </ul>
        </nav>
        <nav class="menu-desktop md:flex justify-center items-center space-x-6">
            <a href="#home" class="color-violeta hover:text-gray-700 font-semibold tracking-wide text-xl">Inicio</a>
            <a href="#sobre-nosotros"
                class="color-violeta hover:text-gray-700 font-semibold tracking-wide text-xl">Sobre Nosotros</a>
            <a href="#servicios"
                class="color-violeta hover:text-gray-700 font-semibold tracking-wide text-xl">Servicios</a>
            <a href="#contacto"
                class="color-violeta hover:text-gray-700 font-semibold tracking-wide text-xl">Contacto</a>
        </nav>




    </header>


    <!-- //ANCHOR - HERO -->

    <!-- Hero Section con Imagen de Fondo -->
    <div class="bg-cover bg-center h-screen slider-hero" style="background-image: url('src/img/slider_webp.webp');">
        <div class="flex items-center justify-center h-full bg-black bg-opacity-20">
            <div class="text-center text-white px-6 md:px-12">
                <h2 class="text-xl md:text-3xl font-bold mb-4">Construimos conexiones que te llevan a donde querés estar
                </h2>
            </div>
        </div>
    </div>




    <!-- //ANCHOR - ESPECIALISTAS -->

    <div class="bg-white-100 p-8 md:p-20" style="padding-top:100px; padding-bottom:100px;">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row">
            <div
                class="md:w-1/2 relative text-center md:text-left md:pr-10 mb-10 md:mb-0 h-[400px] overflow-hidden order-1 md:order-1">
                <img src="src/img/mundo.png" alt="Imagen de fondo"
                    class="absolute inset-0 z-0 object-contain object-left w-full h-full opacity-100">
                <div class="relative z-10 bg-white bg-opacity-0 p-6">
                    <h2 class="text-3xl font-semibold" style="color: #302C5F;">Especialistas en el diseño, construcción,
                        mantenimiento y puesta en marcha de redes de telecomunicaciones.</h2>
                    <p class="mt-4 text-xl" style="color: #302C5F;">Relevamiento, digitalización, diseño e integración
                        de redes.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-center md:justify-start order-2 md:order-2">
                <button @click="open = true"
                    class="bg-gray-300 shadow-md hover:bg-gray-200 font-bold py-1 px-2 rounded text-sm sm:text-base beforeMd:px-1"
                    style="color: #302C5F;">REDES FTTH</button>
                <button @click="open = true"
                    class="bg-gray-300 shadow-md hover:bg-gray-200 font-bold py-1 px-2 rounded text-sm sm:text-base beforeMd:px-1"
                    style="color: #302C5F;">REDES FTTX</button>
                <button @click="open = true"
                    class="bg-gray-300 shadow-md hover:bg-gray-200 font-bold py-1 px-2 rounded text-sm sm:text-base beforeMd:px-1"
                    style="color: #302C5F;">REDES HFC</button>
                <button @click="open = true"
                    class="bg-gray-300 shadow-md hover:bg-gray-200 font-bold py-1 px-2 rounded text-sm sm:text-base beforeMd:px-1"
                    style="color: #302C5F;">TRONCALES Y SUB TRONCALES</button>
            </div>
        </div>
    </div>
    </div>


    <!-- //ANCHOR -  INFRAESTRUCTURA     -->

    <!-- Seccion Infraestructura -->

    <div class="flex flex-col md:flex-row w-full color-violeta-fondo">
        <div class="md:w-1/2 flex justify-center items-center h-full order-2 md:order-1">
            <img src="src/img/trabajador1_webp.webp" alt="Trabajador de telecomunicaciones"
                class="object-contain w-45 h-full">
        </div>

        <div class="md:w-1/2 color-violeta-fondo text-white p-8 flex items-center order-1 md:order-2">
            <div>
                <p class="text-2xl font-bold">
                    Contamos con la infraestructura para realizar los traslados del personal, y las herramientas
                    necesarias para brindar servicios en diferentes regiones de Argentina, y climas adversos
                </p>
            </div>
        </div>
    </div>

    <!-- //ANCHOR -  CARD -->

    <!-- Seccion de Card -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative bg-white-800">
        <div id="servicios" class="text-center mt-12 mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900" style="color: #302C5F">Nuestros Servicios</h2>
            <p class="text-md text-gray-500">Brindamos respuestas integrales para un mercado cambiante y dinámico</p>
        </div>

        <div class="decorative-circle"></div>
        <div class="decorative-circle2"></div>
        <div class="decorative-circle3"></div>

        <div class="decorative-line"></div>

        <div class="container mx-auto px-4 " style="margin-top:100px">
            <div class="flex flex-wrap -mx-2">
                <!-- Tarjeta 1: Cooperativas -->
                <div class="w-full sm:w-1/2 md:w-1/3 px-2">
                    <div class="pico"></div>
                    <div class="card bg-white rounded-lg shadow overflow-hidden relative"
                        onmouseover="showCircle('.decorative-circle3')" onmouseout="hideCircle('.decorative-circle3')">
                        <img class="w-full object-cover rounded-md" src="src/img/cooperativas.jpg" alt="Cooperativas">
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-gray-800">Cooperativas</h3>
                            <p class="text-gray-600">Desde el año 1999, brindamos servicios a cooperativas de Argentina.
                                Conocemos la dinámica del trabajo y los requerimientos necesarios.</p>
                            <button class="accordion-button color-celeste hover:underline pb-6"
                                onclick="toggleAccordion('accordion1')">Leer más</button>
                            <div id="accordion1" class="accordion-content hidden text-gray-600 mt-2">
                                Cooperativa Pop de Electricidad Obras y Servicios Públicos de Santa Rosa limitada.
                                Desde sus inicios participamos en el proyecto de red HFC, desde la startup. <br>
                                Seguimos colaborando en la solución de eventos (mantenimientos de red / instalaciones /
                                reparaciones de cliente final),
                                participamos de la migración a redes de fibra en Santa Rosa , y redes en Toay / Catriló
                                / Anguil.<br><br>

                                LAS VARILLAS (Córdoba)<br>
                                Estamos realizando un trabajo de reordenamiento de armarios de distribución FTTH para
                                mejorar la migración de la antigua
                                red semi distribuida a la nueva red distribuida.<br>
                                Otras Cooperativas que confían en REDAR son: <strong>Coop. Las VARILLAS, Coop Villa del
                                    Rosario, Coop Colsemur
                                    (Fuentes – Casilda – Bigand -. Chabas – Sanford)
                                    Coop de Venado Tuerto, Coop. Servicoopsa ( Villegas / <br>3 Algarrobos / Bunge /
                                    Piedritas / Charlone ).</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 2: Gobiernos -->
                <div class="w-full sm:w-1/2 md:w-1/3 px-2">
                    <div class="pico"></div>
                    <div class="card bg-white rounded-lg shadow overflow-hidden relative"
                        onmouseover="showCircle('.decorative-circle')" onmouseout="hideCircle('.decorative-circle')">
                        <img class="w-full object-cover rounded-md" src="src/img/gobierno.jpg" alt="Gobiernos">
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-gray-800">Gobiernos</h3>
                            <p class="text-gray-600">Trabajamos para organismos municipales y provinciales brindando
                                todo lo necesario para cumplimentar los requerimientos que demandan estos organismos.
                            </p>
                            <button class="accordion-button color-celeste hover:underline"
                                onclick="toggleAccordion('accordion2')">Leer más</button>
                            <div id="accordion2" class="accordion-content hidden text-gray-600 mt-2">
                                Municipalidad de Santa Fe, tendido subterráneo de fibra óptica a los largo de la
                                peatonal en la Capital
                                santafesina, para la instalación de cámaras de seguridad.
                                Municipalidad de Villa Constitución, se realizó el cableado para la intercomunicación
                                entre dependencias
                                y el palacio municipal. Se ejecutó el tendido de Fibra óptica para la instalación de
                                cámaras de seguridad
                                en distintos puntos de la ciudad.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 3: Empresas -->
                <div class="w-full sm:w-1/2 md:w-1/3 px-2">
                    <div class="pico"></div>
                    <div class="card bg-white rounded-lg shadow overflow-hidden relative"
                        onmouseover="showCircle('.decorative-circle2')" onmouseout="hideCircle('.decorative-circle2')">
                        <img class="w-full object-cover rounded-md" src="src/img/empresas.jpg" alt="Empresas">
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-gray-800">Empresas</h3>
                            <p class="text-gray-600">Acompañamos a empresas privadas, ayudando a extender sus redes de
                                comunicaciones tanto internas como externas, enlazando nodos para brindar un mejor
                                servicio.</p>
                            <button class="accordion-button color-celeste hover:underline"
                                onclick="toggleAccordion('accordion3')">Leer más</button>
                            <div id="accordion3" class="accordion-content hidden text-gray-600 mt-2">
                                Contamos con la infraestructura para realizar los traslados del personal y las
                                herramientas necesarias
                                para trabajar en diferentes regiones de Argentina, y climas adversos. Desde 1999,
                                mantenemos nuestra
                                presencia en el sur de nuestro país:<br> <br>
                                Ushuaia -Río Grande - Tolhuin - Pto San Julian - Piedrabuena - Río Gallegos<br><br>
                                Actualmente, seguimos con la construcción de redes FTTH en nuevos loteos pertenecientes
                                a las
                                localidades donde presta servicio Alvarez Cable Hogar, en este momento, en pleno
                                desarrollo
                                barrio La Toscana en Piñero y Barrio Santa Susana en la localidad de Alvear.<br><br>

                                USHUAIA VISIÓN<br>
                                SYNGENTA –IPTEL – PLATINUM<br>
                                ALVAREZ CABLE HOGAR<br>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- //ANCHOR -  SOBRE NOSOTROS -->



        <!-- Seccion de Sobre nosotros -->
        <div class="container items-center mt-6 mb-6">
            <h2 id="sobre-nosotros" class="text-3xl font-extrabold text-center mb-4" style="color: #302C5F">Sobre
                Nosotros</h2>
        </div>

        <section class="color-violeta-fondo p-8 rounded-lg">
            <div class="container mx-auto flex flex-wrap items-center">
                <div class="w-full lg:w-1/2 p-4">

                    <div class="mb-6">
                        <img src="src/img/red2_webp.webp" alt="REDar Logo" class="w-24 mb-4">
                        <p class="text-lg text-white">Bienvenidos a REDar</p>
                        <p class="text-lg text-white">Desde hace <span class="text-blue-300 font-bold">30 años</span>,
                            somos líderes en el <strong>diseño, construcción, mantenimiento y puesta en marcha de redes
                                de telecomunicaciones</strong>. Brindamos respuestas integrales, consolidándonos atentos
                            a las demandas de un mercado cambiante y dinámico.</p>
                    </div>
                    <div>
                        <p class="text-lg text-white mb-4">Nos destacamos por ofrecer un servicio completo, con un
                            equipo altamente capacitado y en constante actualización, preparado para adaptarse y brindar
                            las mejores soluciones.</p>
                        <p class="text-lg text-white mb-4">En REDar, la satisfacción del cliente es nuestra prioridad.
                            Nuestro compromiso en la atención <strong>post venta</strong> asegura el correcto
                            funcionamiento de todos los trabajos realizados. Propiciamos una comunicación abierta y
                            constante, brindando soporte técnico y resolviendo cualquier inconveniente que pueda surgir.
                        </p>
                        <p class="text-lg text-white mb-4">Formamos nuestro <strong>propio equipo de
                                especialistas</strong>, por lo que no subcontratamos personal. Además, contamos con una
                            <strong>flota de vehículos propia</strong>, que nos permite recorrer Argentina, garantizando
                            eficiencia y calidad en cada proyecto.
                        </p>
                        <p class="text-lg text-white">Acompañamos el éxito de tu negocio y gestión en el <strong>mundo
                                digital</strong>.</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 p-4">
                    <img src="src/img/trabajador3_webp.webp" alt="Trabajador de REDar"
                        class="w-full h-auto rounded lg:w-auto md:w-1/2 mx-auto md:float-right">
                </div>



            </div>
        </section>

        <!-- Sección Confían en Nosotros -->
        <section class="bg-white p-8 mb-6 mt-6">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold mb-4" style="color: #302C5F; margin-bottom: 50px;">Confían en Nosotros
                </h2>
                <!-- <div class="flex flex-wrap justify-center items-center mb-8">
                    <img src="src/img/partner-webp/partner14_webp_webp.webp" alt="Logo 1" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner7_webp_webp.webp" alt="Logo 2" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner5_webp_webp.webp" alt="Logo 3" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner8_webp_webp.webp" alt="Logo 4" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner3_webp_webp.webp" alt="Logo 5" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner10_webp_webp.webp" alt="Logo 6" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner11_webp_webp.webp" alt="Logo 7" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner12_webp_webp.webp" alt="Logo 8" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner16_webp_webp.webp" alt="Logo 9" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner13_webp_webp.webp" alt="Logo 10" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner9_webp_webp.webp" alt="Logo 11" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner15_webp_webp.webp" alt="Logo 12" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner17_webp_webp.webp" alt="Logo 13" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner2_webp_webp.webp" alt="Logo 14" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner_webp_webp.webp" alt="Logo 15" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner4_webp_webp.webp" alt="Logo 16" class="w-24 m-2">
                    <img src="src/img/partner-webp/partner6_webp_webp.webp" alt="Logo 17" class="w-24 m-2">
                </div> -->
                <div id="map" style="height: 500px; width: 100%;"></div>
            </div>
        </section>



        <!-- Sección Atención Postventa -->
        <section class="color-violeta-fondo p-8 rounded-lg mb-6">
            <div class="container mx-auto flex flex-col md:flex-row items-center">
                <div class="md:w-1/5 mb-4 md:mb-0 md:mr-8 order-1 md:order-2">
                    <img src="src/img/escudo_webp.webp" alt="Logo 1" class="w-50 pb-3 ml-10">
                </div>
                <div class="md:w-4/5 text-white text-center md:text-left order-1 md:order-2">
                    <p class="text-3xl font-bold">Atención POSVENTA</p>
                    <p class="text-2xl">que garantiza el funcionamiento de los elementos que colocamos en las redes. Te
                        acompañamos en todas las etapas.</p>
                </div>
            </div>
        </section>



        <!-- Sección Contacto -->
        <section class="bg-white p-8">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4 color-violeta" style="color: #302C5F">¿LISTO PARA
                    INICIAR TU PRÓXIMO PROYECTO?</h2>
                <h3 class="text-2xl text-gray-700 mb-8 color-violeta" style="color: #302C5F">¡Contáctanos hoy mismo!
                </h3>
            </div>
        </section>







        <!-- Footer y Formulario de Contacto -->
        <footer id="contacto" class="relative bg-teal-500 p-8 rounded-lg" style="background-color: #00B4D8;">
            <img src="src/img/backgroud-red-footer_webp.webp" alt="Imagen de fondo"
                class="absolute bottom-0 left-0 z-0 object-cover w-3/6 h-22 opacity-100">

            <div class="container mx-auto flex flex-wrap items-center relative z-10">
                <div class="w-full lg:w-1/2 p-4 text-white">
                    <img src="src/img/logo-fotter_webp.webp" alt="REDar Logo" class="w-24 mb-4">
                    <p class="text-lg">REDar REDES ARGENTINAS</p>
                    <p class="text-lg">Gral. López 968, 2919 Villa Constitución, Santa Fe</p>
                    <p class="text-lg">WhatsApp de contacto: +54 9 3400 65-9933</p>
                    <p class="text-lg"><a href="mailto:info@redesargentinassa.com.ar">info@redesargentinassa.com.ar</a>
                    </p>
                    <div class="flex space-x-4 mt-4">
                        <a href="https://www.facebook.com/redesargentinasvc" class="text-white"><img
                                src="src/img/facebook_webp.webp" alt="Logo 1" class="w-10 m-2"></a>
                        <a href="https://www.instagram.com/redesargentinasvc" class="text-white"><img
                                src="src/img/instagram_webp.webp" alt="Logo 1" class="w-10 m-2"></a>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 p-4 rounded-lg">
                    <form class="bg-teal-600 p-8 rounded-lg shadow-lg div-gradiente-vertical md:mt-8">
                        <div class="mb-4">
                            <label for="name" class="block text-white text-sm font-bold mb-2">Nombre</label>
                            <input type="text" id="name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Tu nombre">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-white text-sm font-bold mb-2">Email</label>
                            <input type="email" id="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Tu email">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-white text-sm font-bold mb-2">Mensaje</label>
                            <textarea id="message"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Tu mensaje"></textarea>
                        </div>
                        <div class="flex items-center justify-center">
                            <button
                                class="bg-purple-700 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="button">
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </footer>


        <script>
        function openWhatsApp() {
            window.open('https://wa.me/+5493400659933', '_blank'); // Reemplaza # con el número de WhatsApp
        }
        </script>

        <script>
        function toggleAccordion(id) {
            var content = document.getElementById(id);
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
            } else {
                content.classList.add('hidden');
            }
        }
        </script>



        <script>
        // Function to check if both images are loaded
        function imagesLoaded() {
            const leftLogo = document.getElementById('left-logo');
            const rightLogo = document.getElementById('right-logo');
            return leftLogo.complete && rightLogo.complete;
        }

        // Event listener for image load
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            const content = document.getElementById('content');

            // Check if images are loaded
            if (imagesLoaded()) {
                preloader.classList.add('hidden');
                content.classList.remove('hidden');
            } else {
                // If not, wait until they are loaded
                const leftLogo = document.getElementById('left-logo');
                const rightLogo = document.getElementById('right-logo');
                leftLogo.addEventListener('load', () => {
                    if (imagesLoaded()) {
                        preloader.classList.add('hidden');
                        content.classList.remove('hidden');
                    }
                });
                rightLogo.addEventListener('load', () => {
                    if (imagesLoaded()) {
                        preloader.classList.add('hidden');
                        content.classList.remove('hidden');
                    }
                });
            }
        });

        // Toggle menu visibility
        document.getElementById('menu-button').addEventListener('click', () => {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });

        function highlightLine() {
            document.getElementById('decorativeLine').style.width = '900px'; // Establece el ancho de la línea
        }

        function unhighlightLine() {
            document.getElementById('decorativeLine').style.width = '0'; // Restablece el ancho
        }

        function showCircle(selector) {
            const circle = document.querySelector(selector);
            circle.style.opacity = '1';
            circle.style.visibility = 'visible';
        }

        function hideCircle(selector) {
            const circle = document.querySelector(selector);
            circle.style.opacity = '0';
            circle.style.visibility = 'hidden';
        }
        </script>


        <script>
        // Inicializar el mapa centrado en Argentina
        var map = L.map('map').setView([-38.4161, -63.6167], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Coordenadas de las capitales de las provincias argentinas con imágenes y descripciones
        var provinces = [
            // partner 1
            {
                name: 'Alvarez Cable Hogar S.A.',
                lat: -33.127605,
                lng: -60.8054242,
                image: 'src/img/partner-webp/partner3_webp_webp.webp',
                description: 'Alvarez Cable Hogar S.A. está ubicado en Álvarez.',
                logo: 'src/img/partner-webp/partner3_webp_webp.webp',
                iconSize: [90, 50]
            },
            // partner 2
            {
                name: 'Coop.de E.E.y O.S.P. Varillas',
                lat: -31.87208,
                lng: -62.71946,
                image: 'src/img/partner-webp/partner8_webp_webp.webp',
                description: 'Coop.de E.E.y O.S.P. Varillas está ubicado en Las Varillas.',
                logo: 'src/img/partner-webp/partner8_webp_webp.webp',
                iconSize: [50, 50]
            },
            // partner 3
            {
                name: 'Coop.de Elect.,O.y Serv.Púb.Cañada Seca Ltda.',
                lat: -34.4167208,
                lng: -62.960475,
                image: 'src/img/partner-webp/partner17_webp_webp.webp',
                description: 'Coop.de Elect.,O.y Serv.Púb.Cañada Seca Ltda. está ubicado en Cañada Seca.',
                logo: 'src/img/partner-webp/partner17_webp_webp.webp',
                iconSize: [90, 50]
            },
            // partner 4
            {
                name: 'Coop.de Servicios, Pub y Sociales Villa Del Rosario Ltda.',
                lat: -31.5564672,
                lng: -63.5340735,
                image: 'src/img/partner-webp/partner5_webp_webp.webp',
                description: 'Coop.de Servicios, Pub y Sociales Villa Del Rosario Ltda. está ubicado en Villa Del Rosario',
                logo: 'src/img/partner-webp/partner5_webp_webp.webp',
                iconSize: [90, 60]
            },
            // partner 5
            {
                name: 'Coop.Luz y Fueza Pozo del Molle',
                lat: -32.0220802,
                lng: -62.9193987,
                image: 'src/img/partner-webp/partner18_webp_webp.png',
                description: 'Coop.Luz y Fueza Pozo del Molle está ubicado en Pozo del Molle',
                logo: 'src/img/partner-webp/partner18_webp_webp.png',
                iconSize: [60, 60]
            },
            // partner 6
            {
                name: 'Coop.Pop.de E.,O.yS.P.Sta Rosa',
                lat: -36.6148995,
                lng: -64.289786,
                image: 'src/img/partner-webp/partner7_webp_webp.webp',
                description: 'Coop.Pop.de E.,O.yS.P.Sta Rosa está ubicado en Santa Rosa, La Pampa',
                logo: 'src/img/partner-webp/partner7_webp_webp.webp',
                iconSize: [50, 50]
            },
            // partner 7
            {
                name: 'IP-TEL SA.',
                lat: -34.6185489,
                lng: -58.4761871,
                image: 'src/img/partner-webp/partner9_webp_webp.webp',
                description: 'IP-TEL SA. está ubicado en Capital Federal Prov. de Buenos Aires',
                logo: 'src/img/partner-webp/partner9_webp_webp.webp',
                iconSize: [50, 50]
            },
            // partner 8
            {
                name: 'MUNICIPALIDAD VILLA CONSTITUCIÓN',
                lat: -33.2358677,
                lng: -60.3188354,
                image: 'src/img/partner-webp/partner12_webp_webp.webp',
                description: 'MUNICIPALIDAD VILLA CONSTITUCIÓN está ubicado en VILLA CONSTITUCIÓN',
                logo: 'src/img/partner-webp/partner12_webp_webp.webp',
                iconSize: [50, 50]
            },
            // partner 9
            {
                name: 'Nexodigital SA.',
                lat: -33.8928333,
                lng: -60.5723565,
                image: 'src/img/partner-webp/partner6_webp_webp.webp',
                description: 'Nexodigital SA. está ubicado en Pergamino',
                logo: 'src/img/partner-webp/partner6_webp_webp.webp',
                iconSize: [60, 30]
            },
            // partner 10
            {
                name: 'Pampacom SRL',
                lat: -33.4574389,
                lng: -61.4876371,
                image: 'src/img/partner-webp/partner16_webp_webp.webp',
                description: 'Pampacom SRL está ubicado en Firmat',
                logo: 'src/img/partner-webp/partner16_webp_webp.webp',
                iconSize: [90, 50]
            },
            // partner 11
            {
                name: 'Paralelo 52 TV. SA.',
                lat: -51.6188386,
                lng: -69.2161305,
                image: 'src/img/partner-webp/partner13_webp_webp.webp',
                description: 'Paralelo 52 TV. SA. está ubicado en Río Gallegos',
                logo: 'src/img/partner-webp/partner13_webp_webp.webp',
                iconSize: [50, 50]
            },
            // partner 12
            {
                name: 'Ramirez Cablevisión SRL.',
                lat: -32.1843577,
                lng: -60.2078691,
                image: 'src/img/partner-webp/partner2_webp_webp.webp',
                description: 'Ramirez Cablevisión SRL. está ubicado en General Ramirez',
                logo: 'src/img/partner-webp/partner2_webp_webp.webp',
                iconSize: [50, 50]
            },
            // partner 13
            {
                name: 'Trasvision SA.',
                lat: -34.8650157,
                lng: -61.5237088,
                image: 'src/img/partner-webp/partner4_webp_webp.webp',
                description: 'Trasvision SA. está ubicado en Lincoln',
                logo: 'src/img/partner-webp/partner4_webp_webp.webp',
                iconSize: [50, 50]
            },
            // partner 14
            {
                name: 'TV Fuego SA.',
                lat: -53.7907829,
                lng: -67.6912976,
                image: 'src/img/partner-webp/partner11_webp_webp.webp',
                description: 'TV Fuego SA. está ubicado en Río Grande',
                logo: 'src/img/partner-webp/partner11_webp_webp.webp',
                iconSize: [50, 50]
            },
            // partner 15
            {
                name: 'Universal Video Cable SRL.',
                lat: -49.3032898,
                lng: -67.7403706,
                image: 'src/img/partner-webp/partner15_webp_webp.webp',
                description: 'Universal Video Cable SRL. está ubicado en Puerto San Julián',
                logo: 'src/img/partner-webp/partner15_webp_webp.webp',
                iconSize: [40, 30]
            },
            // partner 16
            {
                name: 'Ushuaia Vision SA',
                lat: -54.8021386,
                lng: -68.3023342,
                image: 'src/img/partner-webp/partner14_webp_webp.webp',
                description: 'Ushuaia Vision SA está ubicado en Ushuaia',
                logo: 'src/img/partner-webp/partner14_webp_webp.webp',
                iconSize: [50, 50]
            },
            // partner 17
            {
                name: 'Villeneuve Group SA.',
                lat: -32.8989788,
                lng: -60.9063684,
                image: 'src/img/partner-webp/partner10_webp_webp.webp',
                description: 'Villeneuve Group SA. está ubicado en Roldán',
                logo: 'src/img/partner-webp/partner10_webp_webp.webp',
                iconSize: [50, 50]
            },

        ];


        // Agregar marcadores para cada provincia con icono personalizado
        provinces.forEach(function(province) {
            var popupContent = `
        <div>
            <h3>${province.name}</h3>
            <img src="${province.image}" alt="${province.name}" style="width:100%;height:auto;">
            <p>${province.description}</p>
        </div>
    `;

            var customIcon = L.icon({
                iconUrl: province.logo,
                iconSize: province.iconSize, // Tamaño del logo especificado para cada provincia
                iconAnchor: [province.iconSize[0] / 2, province.iconSize[
                    1]], // Punto del icono que se ubicará en la coordenada
                popupAnchor: [0, -province.iconSize[
                    1]] // Punto desde donde se abrirá el popup con respecto al icono
            });

            L.marker([province.lat, province.lng], {
                    icon: customIcon
                }).addTo(map)
                .bindPopup(popupContent);
        });
        </script>




</body>

</html>