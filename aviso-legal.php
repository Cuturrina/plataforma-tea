<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso Legal</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <h1>🌈 Plataforma Infantil para Niños con TEA 🌟</h1>
        <nav>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="recursos.php"><i class="fas fa-book"></i> Recursos</a></li>
                <li><a href="padres.php"><i class="fas fa-user-friends"></i> Para Padres</a></li>
                <li><a href="foro.php"><i class="fas fa-comments"></i> Foro</a></li>
                <li><a href="juegos.php"><i class="fas fa-gamepad"></i> Juegos</a></li>
                <li><a href="contacto.php"><i class="fas fa-envelope"></i> Escríbenos</a></li>
                <li><a href="sugerencias.php"><i class="fas fa-lightbulb"></i> Buzón de Sugerencias</a></li>
                <li><a href="sobre-el-proyecto.php"><i class="fas fa-info-circle"></i> Sobre el Proyecto</a></li>
                <?php session_start(); ?>
                <?php if (isset($_SESSION['username'])): ?>
                <li class="dropdown">
                    <div class="dropdown-toggle" id="user-menu">
                        <?= htmlspecialchars($_SESSION['username']) ?> <i class="fas fa-chevron-down"></i>
                    </div>
                    <ul class="dropdown-menu" id="dropdown-menu" style="display: none;">
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="login.php">Iniciar sesión</a> | <a href="register.php">Crear Cuenta</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <button 
        id="toggle-view-button" 
        style="position: fixed; top: 15px; right: 20px; padding: 10px 15px; background-color:rgb(11, 142, 230); color: white; border: none; border-radius: 5px; cursor: pointer; z-index: 1000;">
        Vista Móvil 📱
    </button>

    <div id="simulacion-movil-overlay" class="simulacion-movil">
        <div class="marco-movil">
          <div class="pantalla-movil">
              <iframe id="iframe-movil" class="iframe-movil" src="vista-movil.php"></iframe>
          </div>
          <button id="cerrar-simulador-iframe-boton">Cerrar</button>
        </div>
    </div>

    <main style="padding: 2em; max-width: 800px; margin: 2em auto; background-color: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h1 style="color: #333; text-align: center; margin-bottom: 1.5em;">AVISO LEGAL</h1>
        <p style="text-align: center; font-style: italic; color: #666;">LEY DE LOS SERVICIOS DE LA SOCIEDAD DE LA INFORMACIÓN (LSSI)</p>

        <p>PLATAFORMA TEA, responsable del sitio web, en adelante RESPONSABLE, pone a disposición de los usuarios el presente documento, con el que pretende dar cumplimiento a las obligaciones dispuestas en la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico (LSSICE), así como informar a todos los usuarios del sitio web respecto a cuáles son las condiciones de uso.</p>
        <p>Toda persona que acceda a este sitio web asume el papel de usuario, comprometiéndose a la observancia y cumplimiento riguroso de las disposiciones aquí dispuestas, así como a cualquier otra disposición legal que fuera de aplicación.</p>
        <p>PLATAFORMA TEA se reserva el derecho de modificar cualquier tipo de información que pudiera aparecer en el sitio web, sin que exista obligación de preavisar o poner en conocimiento de los usuarios dichas obligaciones, entendiéndose como suficiente con la publicación en el sitio web de PLATAFORMA TEA</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">1. DATOS IDENTIFICATIVOS</h2>
        <p>Denominación social: <strong>PLATAFORMA TEA, S.L.</strong></p>
        <p>Nombre comercial: <strong>PLATAFORMA TEA</strong></p>
        <p>CIF: <strong>NUMERO CIF</strong></p>
        <p>Domicilio: <strong>DIRECCION DE TU NEGOCIO</strong></p>
        <p>e-mail: <a href="mailto:tuemail@tudominio.com" style="color: #6A0DAD; text-decoration: none;">tuemail@tudominio.com</a></p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">2. OBJETO</h2>
        <p>A través del Sitio Web, les ofrecemos a los Usuarios la posibilidad de acceder a la información sobre nuestros servicios.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">3. PRIVACIDAD Y TRATAMIENTO DE DATOS</h2>
        <p>Cuando para el acceso a determinados contenidos o servicio sea necesario facilitar datos de carácter personal, los Usuarios garantizarán su veracidad, exactitud, autenticidad y vigencia. La empresa dará a dichos datos el tratamiento automatizado que corresponda en función de su naturaleza o finalidad, en los términos indicados en la sección de Política de Privacidad.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">4. PROPIEDAD INDUSTRIAL E INTELECTUAL</h2>
        <p>El Usuario reconoce y acepta que todos los contenidos que se muestran en el Espacio Web y en especial, diseños, textos, imágenes, logos, iconos, botones, software, nombres comerciales, marcas, o cualesquiera otros signos susceptibles de utilización industrial y/o comercial están sujetos a derechos de Propiedad Intelectual y todas las marcas, nombres comerciales o signos distintivos, todos los derechos de propiedad industrial e intelectual, sobre los contenidos y/o cualesquiera otros elementos insertados en la página, que son propiedad exclusiva de la empresa y/o de terceros, quienes tienen el derecho exclusivo de utilizarlos en el tráfico económico. Por todo ello el Usuario se compromete a no reproducir, copiar, distribuir, poner a disposición o de cualquier otra forma comunicar públicamente, transformar o modificar tales contenidos manteniendo indemne a la empresa de cualquier reclamación que se derive del incumplimiento de tales obligaciones. En ningún caso el acceso al Espacio Web implica ningún tipo de renuncia, transmisión, licencia o cesión total ni parcial de dichos derechos, salvo que se establezca expresamente lo contrario. Las presentes Condiciones Generales de Uso del Espacio Web no confieren a los Usuarios ningún otro derecho de utilización, RRHH, alteración, explotación, reproducción, distribución o comunicación pública del Espacio Web y/o de sus Contenidos distintos de los aquí expresamente previstos. Cualquier otro uso o explotación de cualesquiera derechos estará sujeto a la previa y expresa autorización específicamente otorgada a tal efecto por la empresa o el tercero titular de los derechos afectados.</p>
        <p>Los contenidos, textos, fotografías, diseños, logotipos, imágenes, programas de ordenador, códigos fuente y, en general, cualquier creación intelectual existente en este Espacio, así como el propio Espacio en su conjunto, como obra artística multimedia, están protegidos como derechos de autor por la legislación en materia de propiedad intelectual. La empresa es titular de los elementos que integran el diseño gráfico del Espacio Web, lo menús, botones de navegación, el código HTML, los textos, imágenes, texturas, gráficos y cualquier otro contenido del Espacio Web o, en cualquier caso dispone de la correspondiente autorización para la utilización de dichos elementos. El contenido dispuesto en el Espacio Web no podrá ser reproducido ni en todo ni en parte, ni transmitido, ni registrado por ningún sistema de recuperación de información, en ninguna forma ni en ningún medio, a menos que se cuente con la autorización previa, por escrito, de la citada Entidad.</p>
        <p>Asimismo queda prohibido suprimir, eludir y/o manipular el «copyright» así como los dispositivos técnicos de protección, o cualesquiera mecanismos de información que pudieren contener los contenidos. El Usuario de este Espacio Web se compromete a respetar los derechos enunciados y a evitar cualquier actuación que pudiera perjudicarlos, reservándose en todo caso la empresa el ejercicio de cuantos medios o acciones legales le correspondan en defensa de sus legítimos derechos de propiedad intelectual e industrial.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">5. OBLIGACIONES Y RESPONSABILIDADES DEL USUARIO DEL ESPACIO WEB</h2>
        <p>El Usuario se compromete a:</p>
        <ul>
            <li>Hacer un uso adecuado y lícito del Espacio Web así como de los contenidos y servicios, de conformidad con: (i) la legislación aplicable en cada momento; (ii) las Condiciones Generales de Uso del Espacio Web; (iii) la moral y buenas costumbres generalmente aceptadas y (iv) el orden público.</li>
            <li>Proveerse de todos los medios y requerimientos técnicos que se precisen para acceder al Espacio Web.</li>
            <li>Facilitar información veraz al cumplimentar con sus datos de carácter personal los formularios contenidos en el Espacio Web y a mantenerlos actualizados en todo momento de forma que responda, en cada momento, a la situación real del Usuario. El Usuario será el único responsable de las manifestaciones falsas o inexactas que realice y de los perjuicios que cause a la empresa o a terceros por la información que facilite.</li>
        </ul>
        <p>No obstante lo establecido en el apartado anterior el Usuario deberá asimismo abstenerse de:</p>
        <ul>
            <li>Hacer un uso no autorizado o fraudulento del Espacio Web y/o de los contenidos con fines o efectos ilícitos, prohibidos en las presentes Condiciones Generales de Uso, lesivos de los derechos e intereses de terceros, o que de cualquier forma puedan dañar, inutilizar, sobrecargar, deteriorar o impedir la normal utilización de los servicios o los documentos, archivos y toda clase de contenidos almacenados en cualquier equipo informático.</li>
            <li>Acceder o intentar acceder a recursos o áreas restringidas del Espacio Web, sin cumplir las condiciones exigidas para dicho acceso.</li>
            <li>Provocar daños en los sistemas físicos o lógicos del Espacio Web, de sus proveedores o de terceros.</li>
            <li>Introducir o difundir en la red virus informáticos o cualesquiera otros sistemas físicos o lógicos que sean susceptibles de provocar daños en los sistemas físicos o lógicos de la empresa, proveedores o de terceros.</li>
            <li>Intentar acceder, utilizar y/o manipular los datos de la empresa, terceros proveedores y otros Usuarios.</li>
            <li>Reproducir o copiar, distribuir, permitir el acceso del público a través de cualquier modalidad de comunicación pública, transformar o modificar los contenidos, a menos que se cuente con la autorización del titular de los correspondientes derechos o ello resulte legalmente permitido.</li>
            <li>Suprimir, ocultar o manipular las notas sobre derechos de propiedad intelectual o industrial y demás datos identificativos de los derechos de la empresa o de terceros incorporados a los contenidos, así como los dispositivos técnicos de protección o cualesquiera mecanismos de información que puedan insertarse en los contenidos.</li>
            <li>Obtener e intentar obtener los contenidos empleando para ello medios o procedimientos distintos de los que, según los casos, se hayan puesto a su disposición a este efecto o se hayan indicado expresamente en las páginas web donde se encuentren los contenidos o, en general, de los que se empleen habitualmente en Internet por no entrañar un riesgo de daño o inutilización del Espacio web y/o de los contenidos.</li>
        </ul>
        <p>En particular, y a título meramente indicativo y no exhaustivo, el Usuario se compromete a no transmitir, difundir o poner a disposición de terceros informaciones, datos, contenidos, mensajes, gráficos, dibujos, archivos de sonido y/o imagen, fotografías, grabaciones, software y, en general, cualquier clase de material que:</p>
        <ul>
            <li>De cualquier forma sea contrario, menosprecie o atente contra los derechos fundamentales y las libertades públicas reconocidas constitucionalmente, en los Tratados Internacionales y en el resto de la legislación vigente.</li>
            <li>Induzca, incite o promueva actuaciones delictivas, denigratorias, difamatorias, violentas o, en general, contrarias a la ley, a la moral, a las buenas costumbres generalmente aceptadas o al orden público.</li>
            <li>Induzca, incite o promueva actuaciones, actitudes o pensamientos discriminatorios por razón de sexo, raza, religión, creencias, edad o condición.</li>
            <li>Incorpore, ponga a disposición o permita acceder a productos, elementos, mensajes y/o servicios delictivos, violentos, ofensivos, nocivos, degradantes o, en general, contrarios a la ley, a la moral y a las buenas costumbres generalmente aceptadas o al orden público.</li>
            <li>Induzca o pueda inducir a un estado inaceptable de ansiedad o temor.</li>
            <li>Induzca o incite a involucrarse en prácticas peligrosas, de riesgo o nocivas para la salud y el equilibrio psíquico.</li>
            <li>Se encuentra protegido por la legislación en materia de protección intelectual o industrial perteneciente a la sociedad o a terceros sin que haya sido autorizado el uso que se pretenda realizar.</li>
            <li>Sea contrario al honor, a la intimidad personal y familiar o a la propia imagen de las personas.</li>
            <li>Constituya cualquier tipo de publicidad.</li>
            <li>Incluya cualquier tipo de virus o programa que impida el normal funcionamiento del Espacio Web.</li>
        </ul>
        <p>Si para acceder a algunos de los servicios y/o contenidos del Espacio Web, se le proporcionara una contraseña, se obliga a usarla de manera diligente, manteniéndola en todo momento en secreto. En consecuencia, será responsable de su adecuada custodia y confidencialidad, comprometiéndose a no cederla a terceros, de manera temporal o permanente, ni a permitir el acceso a los mencionados servicios y/o contenidos por parte de personas ajenas. Igualmente, se obliga a notificar a la sociedad cualquier hecho que pueda suponer un uso indebido de su contraseña, como, a título enunciativo, su robo, extravío o el acceso no autorizado, con el fin de proceder a su inmediata cancelación. En consecuencia, mientras no efectúe la notificación anterior, la empresa quedará eximida de cualquier responsabilidad que pudiera derivarse del uso indebido de su contraseña, siendo de su responsabilidad cualquier utilización ilícita de los contenidos y/o servicios del Espacio Web por cualquier tercero ilegítimo. Si de manera negligente o dolosa incumpliera cualquiera de las obligaciones establecidas en las presentes Condiciones Generales de Uso, responderá por todos los daños y perjuicios que de dicho incumplimiento pudieran derivarse para la empresa.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">6. RESPONSABILIDADES</h2>
        <p>No se garantiza el acceso continuado, ni la correcta visualización, descarga o utilidad de los elementos e informaciones contenidas en la web que puedan verse impedidos, dificultados o interrumpidos por factores o circunstancias que están fuera de su control. No se hace responsable de las decisiones que pudieran adoptarse como consecuencia del acceso a los contenidos o informaciones ofrecidas.</p>
        <p>Se podrá interrumpir el servicio, o resolver de modo inmediato la relación con el Usuario, si se detecta que un uso de su Espacio Web, o de cualquiera de los servicios ofertados en el mismo, es contrario a las presentes Condiciones Generales de Uso. No nos hacemos responsables por daños, perjuicios, pérdidas, reclamaciones o gastos derivados del uso del Espacio Web.</p>
        <p>Únicamente será responsable de eliminar, lo antes posible, los contenidos que puedan generar tales perjuicios, siempre que así se notifique. En especial no seremos responsables de los perjuicios que se pudieran derivar, entre otros, de:</p>
        <ul>
            <li>Interferencias, interrupciones, fallos, omisiones, averías telefónicas, retrasos, bloqueos o desconexiones en el funcionamiento del sistema electrónico, motivadas por deficiencias, sobrecargas y errores en las líneas y redes de telecomunicaciones, o por cualquier otra causa ajena al control de la empresa.</li>
            <li>Intromisiones ilegítimas mediante el uso de programas malignos de cualquier tipo y a través de cualquier medio de comunicación, tales como virus informáticos o cualesquiera otros.</li>
            <li>Abuso indebido o inadecuado del Espacio Web.</li>
            <li>Errores de seguridad o navegación producidos por un mal funcionamiento del navegador o por el uso de versiones no actualizadas del mismo. El administrador del espacio web se reservan el derecho de retirar, total o parcialmente, cualquier contenido o información presente en el Espacio Web.</li>
        </ul>
        <p>La empresa excluye cualquier responsabilidad por los daños y perjuicios de toda naturaleza que pudieran deberse a la mala utilización de los servicios de libre disposición y uso por parte de los Usuarios de Espacio Web. Asimismo queda exonerado de cualquier responsabilidad por el contenido e informaciones que puedan ser recibidas como consecuencia de los formularios de recogida de datos, estando los mismos únicamente para la prestación de los servicios de consultas y dudas. Por otro lado, en caso de causar daños y perjuicios por un uso ilícito o incorrecto de dichos servicios, podrá ser el Usuario reclamado por los daños o perjuicios causados.</p>
        <p>Usted mantendrá a la empresa indemne frente a cualesquiera daños y perjuicios que se deriven de reclamaciones, acciones o demandas de terceros como consecuencia de su acceso o uso del Espacio Web. Asimismo, usted se obliga a indemnizar frente a cualesquiera daños y perjuicios, que se deriven del uso por su parte de “robots”, “spiders”, “crawlers” o herramientas similares empleadas con el fin de recabar o extraer datos o de cualquier otra actuación por su parte que imponga una carga irrazonable sobre el funcionamiento del Espacio Web.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">7. HIPERVÍNCULOS</h2>
        <p>El Usuario se obliga a no reproducir de ningún modo, ni siquiera mediante un hiperenlace o hipervínculo, el Espacio Web, así como ninguno de sus contenidos, salvo autorización expresa y por escrito del responsable del fichero.</p>
        <p>El Espacio Web puede incluir enlaces a otros espacios web, gestionados por terceros, con objeto de facilitar el acceso del Usuario a la información de empresas colaboradoras y/o patrocinadoras. Conforme con ello, la sociedad no se responsabiliza del contenido de dichos Espacios web, ni se sitúa en una posición de garante ni/o de parte ofertante de los servicios y/o información que se puedan ofrecer a terceros a través de los enlaces de terceros.</p>
        <p>Se concede al Usuario un derecho limitado, revocable y no exclusivo a crear enlaces a la página principal del Espacio Web exclusivamente para uso privado y no comercial. Los Espacios web que incluyan enlace a nuestro Espacio Web (i) no podrán falsear su relación ni afirmar que se ha autorizado tal enlace, ni incluir marcas, denominaciones, nombres comerciales, logotipos u otros signos distintivos de nuestra sociedad; (ii) no podrán incluir contenidos que puedan considerarse de mal gusto, obscenos, ofensivos, controvertidos, que inciten a la violencia o la discriminación por razón de sexo, raza o religión, contrarios al orden público o ilícitos; (iii) no podrán enlazar a ninguna página del Espacio Web distinta de la página principal; (iv) deberá enlazar con la propia dirección del Espacio Web, sin permitir que el Espacio web que realice el enlace reproduzca el Espacio Web como parte de su web o dentro de uno de sus “frames” o crear un “browser” sobre cualquiera de las páginas del Espacio Web. La empresa podrá solicitar, en cualquier momento, que elimine cualquier enlace al Espacio Web, después de lo cual deberá proceder de inmediato a su eliminación.</p>
        <p>La empresa no puede controlar la información, contenidos, productos o servicios facilitados por otros Espacios web que tengan establecidos enlaces con destino al Espacio Web.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">8. PROTECCIÓN DE DATOS</h2>
        <p>Para utilizar algunos de los Servicios, el Usuario debe proporcionar previamente ciertos datos de carácter personal. La empresa tratará automatizadamente estos datos y aplicará las correspondientes medidas de seguridad, todo ello en cumplimiento del RGPD, LOPDGDD y LSSI. El Usuario puede acceder a la política seguida en el tratamiento de los datos personales, así como el establecimiento de las finalidades previamente establecidas, en las condiciones definidas en la Política de Privacidad.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">9. COOKIES</h2>
        <p>La empresa se reserva el derecho de utilizar la tecnología “cookie” en el Espacio Web, a fin de reconocerlo como Usuario frecuente y personalizar el uso que realice del Espacio Web mediante la preselección de su idioma, o contenidos más deseados o específicos.</p>
        <p>Las cookies recopilan la dirección IP del usuario siendo Google el responsable del tratamiento de esta información.</p>
        <p>Las cookies son ficheros enviados a un navegador, por medio de un servidor Web, para registrar la navegación del Usuario en el Espacio Web, cuando el Usuario permita su recepción. Si usted lo desea puede configurar su navegador para ser avisado en pantalla de la recepción de cookies y para impedir la instalación de cookies en su disco duro. Por favor consulte las instrucciones y manuales de su navegador para ampliar esta información.</p>
        <p>Gracias a las cookies, resulta posible que se pueda reconocer el navegador del ordenador utilizado por el Usuario con la finalidad de facilitar contenidos y ofrecer las preferencias de navegación u publicitarias que el Usuario, a los perfiles demográficos de los Usuarios así como para medir las visitas y parámetros del tráfico, controlar el progreso y número de entradas.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">10. DECLARACIONES Y GARANTÍAS</h2>
        <p>En general, los contenidos y servicios ofrecidos en el Espacio Web tienen carácter meramente informativo. Por consiguiente, al ofrecerlos, no se otorga garantía ni declaración alguna en relación con los contenidos y servicios ofrecidos en el Espacio web, incluyendo, a título enunciativo, garantías de licitud, fiabilidad, utilidad, veracidad, exactitud, o comerciabilidad, salvo en la medida en que por ley no puedan excluirse tales declaraciones y garantías.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">11. FUERZA MAYOR</h2>
        <p>La empresa no será responsable en todo en caso de imposibilidad de prestar servicio, si ésta se debe a interrupciones prolongadas del suministro eléctrico, líneas de telecomunicaciones, conflictos sociales, huelgas, rebelión, explosiones, inundaciones, actos y omisiones del Gobierno, y en general todos los supuestos de fuerza mayor o de caso fortuito.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">12. RESOLUCIÓN DE CONTROVERSIAS. LEY APLICABLE Y JURISDICCIÓN</h2>
        <p>Las presentes Condiciones Generales de Uso, así como el uso del Espacio Web, se regirán por la legislación española. Para la resolución de cualquier controversia las partes se someterán a los Juzgados y Tribunales del domicilio social del Responsable del sitio web.</p>
        <p>En el supuesto de que cualquier estipulación de las presentes Condiciones Generales de Uso resultara inexigible o nula en virtud de la legislación aplicable o como consecuencia de una resolución judicial o administrativa, dicha inexigibilidad o nulidad no hará que las presentes Condiciones Generales de Uso resulten inexigibles o nulas en su conjunto. En dichos casos, la empresa procederá a la modificación o sustitución de dicha estipulación por otra que sea válida y exigible y que, en la medida de lo posible, consiga el objetivo y pretensión reflejados en la estipulación original.</p>
    </main>

    <footer>
        <p>&copy; Ayuda para Niños con Autismo. Todos los derechos reservados.</p>
        <div>
            <a href="politica-privacidad.php">Política de Privacidad</a>
            <a href="aviso-legal.php">Aviso Legal</a>
            <a href="politica-cookies.php">Política de Cookies</a>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>