-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS cafeteria1;

-- Usar la base de datos
USE cafeteria1;

-- Estructura de tabla para la tabla `configuraciones`
CREATE TABLE IF NOT EXISTS tbl_configuraciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  valor VARCHAR(255) NOT NULL
);

-- Estructura de tabla para la tabla `mensajes`
CREATE TABLE IF NOT EXISTS tbl_mensajes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NOT NULL,
  asunto VARCHAR(255) NOT NULL,
  mensaje VARCHAR(255) NOT NULL
);

-- Estructura de tabla para la tabla `menu`
CREATE TABLE IF NOT EXISTS tbl_menu (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  precio VARCHAR(255) NOT NULL
);

-- Estructura de tabla para la tabla `reservas`
CREATE TABLE IF NOT EXISTS tbl_reservas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NOT NULL,
  fecha VARCHAR(255) NOT NULL,
  hora VARCHAR(255) NOT NULL
);

-- Estructura de tabla para la tabla `nosotros`
CREATE TABLE IF NOT EXISTS tbl_nosotros (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  subtitulo VARCHAR(255) NOT NULL,
  descripcion TEXT NOT NULL 
);

-- Estructura de tabla para la tabla `detalle de ventas`
CREATE TABLE IF NOT EXISTS tbl_detalledeventas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_venta  INT(11) NOT NULL,
  id_producto  INT(11) NOT NULL,
  precio_unitario DECIMAL(20,2) NOT NULL,
  cantidad INT(11) NOT NULL
);

-- Estructura de tabla para la tabla `roles`
CREATE TABLE IF NOT EXISTS tbl_roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rol VARCHAR(2) NOT NULL
);

-- Estructura de tabla para la tabla `servicios`
CREATE TABLE IF NOT EXISTS tbl_servicios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  imagen VARCHAR(255) NOT NULL  
);

-- Estructura de tabla para la tabla `testimonios`
CREATE TABLE IF NOT EXISTS tbl_testimonios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  profesion VARCHAR(1000) NOT NULL,
  descripcion TEXT NOT NULL,
  imagen VARCHAR(255) NOT NULL
);

-- Estructura de tabla para la tabla `ventas`
CREATE TABLE IF NOT EXISTS tbl_ventas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  claveTransaccion VARCHAR(255) NOT NULL,
  paypalDatos TEXT NOT NULL,
  fecha DATETIME NOT NULL,
  correo VARCHAR(255) NOT NULL,
  total DECIMAL(60,2) NOT NULL,
  status VARCHAR(255) NOT NULL
);

-- Estructura de tabla para la tabla `usuarios`
CREATE TABLE IF NOT EXISTS tbl_usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NOT NULL
);


-- Volcado de datos para la tabla `configuraciones`
INSERT INTO tbl_configuraciones (nombre, valor)
VALUES
  ('Titulo principal index', 'Los tres chiflados'),
  ('subtitulo index', 'Cafeteria'),
  ('Titulo nosotros', 'Sirviendo desde el año 2000'),
  ('Titulo de servicios', 'Algunos de nuestros productos'),
  ('Titulo del menú', 'Menú y precios'),
  ('Oferta del index', '50% de descuento'),
  ('Oferta index', 'Oferta especial!'),
  ('Oferta descripcion', 'Sólo para los domingo desde el 1 al 31 de enero de 2024'),
  ('Descuento de reserva', '30% Descuento'),
  ('Titulo de reserva', 'Solo para reservas en línea'),
  ('Descripcion Reserva', 'A través de los años nos encontramos mejorando y actualizando los productos que ofrecemos a nuestros clientes, destacamos los productos de Cafetería, Confitería y Panadería.'),
  ('Descripcion de reserva', 'Local en Haedo!'),
  ('Reservas tilde 1', 'Confitería'),
  ('Reservas tilde 2', 'Servicios de Lunch & Repartos!'),
  ('Reservas tilde 3', 'Local en Haedo!'),
  ('Reservas on-line2', 'Reserva tu mesa'),
  ('Boton de reserva', 'Reservar ahora!'),
  ('Tetimonios', 'Testimonios'),
  ('Subtitulo de testimmonios', 'Nuestros clientes dicen'),
  ('Contacto', 'Contacto'),
  ('Direcccion fisica', '123 Street, New York, USA'),
  ('Telefono de contacto', '+012 345 67890'),
  ('E-mail de contacto', 'info@example.com'),
  ('Horarios', 'HORARIOS DE APERTURA'),
  ('L-V', 'Lunes a Viernes'),
  ('Horarios', 'De 8:00 AM. HASTA LAS 22:00 PM.'),
  ('Sabados - Domingos y Feriados', 'Sabados - Domingos - Feriados'),
  ('Horarios de fines de semana', 'De 10:00 AM. HASTALAS 20:00 PM.'),
  ('Derechos de autor', 'Derechos de autor'), 
  ('Autores', 'Luciano, Maximiliano y Santiago'),
  ('Todos los derechos reservados', 'Todos los derechos reservados');

 -- Volcado de datos para la tabla `detalle de ventas`
INSERT INTO tbl_detalledeventas (id_venta , id_producto , precio_unitario, cantidad)
VALUES
  ('83', '69', '33000.00', '1'),
  ('83', '53', '4500.00', '1'),
  ('83', '35', '4000.00', '1');

 -- Volcado de datos para la tabla `mensajes`
INSERT INTO tbl_mensajes (nombre , correo , asunto, mensaje)
VALUES
  ('maxi', 'maxi@algo.com', 'test', 'mensaje de prueba');

    -- Volcado de datos para la tabla `menu`
INSERT INTO tbl_menu (titulo , descripcion , imagen, precio)
VALUES
  ('Cafe', 'Shot de cafe negro', '1707509411_cafe.jpg', '1510'),
  ('Cafe doble', 'Dos cafés espresso en la taza de cappuccino.', '1707509162_images.jpg', '2700'),
  ('Capuccino', 'Contiene cafe expreso, vapor y espuma de leche en partes iguales.', '1707509246_CAPUCCINO.jpg', '2700'),
  ('Cappuccino a la italiana', 'Está compuesto de espresso, leche y espuma de leche, servido en taza grande y ancha.', '1707509312_CAPUCCINO A LA ITALIANA.jpg', '3000'),
  ('Cafe con leche', 'Shot de cafe con espuma de leche.', 'esta-deliciosa-combinacion-podria-traerte-grandes-NAOKFIPPXBG4PL2ESK5LFWCKBA.avif', '2400'),
  ('Cafe en jarrito', 'Shot de cafe.', '1707509500_descarga.jpg', '1800'),
  ('Cafe completo', 'Con tostado.', '1707509676_CAFE + TOSTADO.jpg', '1'),
  ('Cafe completo opcional sin TACC', 'Con tostado', '1707509676_CAFE + TOSTADO.jpg', '3500'),
  ('Cafe con leche con 3 medialunas', 'medialunas de mateca o de grasa', '1707509634_paginaoia2.jpeg', '3500'),
  ('Té', 'Una típica infusión de té preparada a partir de un gramo de hoja de té y 100 mL de agua caliente.', '1707509949_TÉ.jpg', '2200'),
  ('Té con leche', 'Una típica infusión de té y agregado de leche.', '1707511291_1707509949_TÉ.jpg', '2300'),
  ('Té digestivo', 'Infusion de finas hierbas', '1707511435_images (1).jpg', '2300'),
  ('Té en hebras Calma-Té', 'Té verde, lavanda, manzanilla, melisa, cedron, tilo, menta, calendula y pétalos de rosas.', '1707511736_TÉ en hebrasjpg.jpg', '3500'),
  ('Earl Grey Touché', 'Té negro con aceite esencial de bergamota y pétalos de rosas.', '1707511752_descarga (1).jpg', '3500'),
  ('Té chaí', 'Las especias que tiene el chai son canela, cardamomo, jengibre, clavo, pimienta negra y nuez moscada.', '1707512346_TÉ chai.jpg', '2500'),
  ('Thai Matea Tea', 'Té verde y yerba mate, con limon y jengibre.', '1707511964_images (3).jpg', '3500'),
  ('Rooibos Calma', 'Trozitos de manzana roja, cedrón, tilo,, melisa y pétalos de rosa.', 'rooibos-propiedades-y-variantes_1d14538c_1200x1200.jpg', '3500'),
  ('Té Manzanilla', 'Infusion con finas hierbas.', '1707512259_descarga (2).jpg', '2500'),
  ('Milkshake de Chocolate', 'Bebida frozen con una base de chocolate', '1707512634_descarga (3).jpg', '4000'),
  ('Milkshake de Vainilla', 'Bebida frozen con una base de vainilla.', '1707512646_descarga (4).jpg', '4000'),
  ('Milkshake de Princesa', 'El milkshake Princesa sus ingredientes son básicos del batido son la fruta y la leche.', '1707512897_descarga (5).jpg', '4000'),
  ('Milkshake de Oreo', 'El milkshake Princesa sus ingredientes son básicos del batido con galletitas oreo y la leche.', '1707512950_descarga (6).jpg', '4000'),
  ('Milkshake de Nescafe', 'El milkshake Princesa sus ingredientes son básicos del batido con nescafe y la leche.', '1707512977_descarga (7).jpg', '4000'),
  ('Milkshake de Papaya', 'El milkshake Princesa sus ingredientes son básicos del batido con papaya y la leche.', '1707513463_PAPAYA.jpg', '4000'),
  ('Milkshake de Maracuyá', 'El milkshake Princesa sus ingredientes son básicos del batido con maracuyá y la leche.', '1707513483_MARACUYÁ.jpg', '4000'),
  ('Milkshake de Cappuccino', 'El milkshake Princesa sus ingredientes son básicos del batido con cappuccino y la leche.', '1707513497_MILSHAKE CAPUCCINO.jpg', '4000'),
  ('Milkshake de Nutela', 'El milkshake Princesa sus ingredientes son básicos del batido con nutela y la leche.', 'El milkshake Princesa sus ingredientes son básicos del batido con nutela y la leche.', '4000'),
  ('Medialunas de manteca', '3 medialunas de manteca.', '1707513203_images (5).jpg', '750'),
  ('Medialunas de grasa', '3 medialunas de grasa.', '1707513293_images (6).jpg', '750'),
  ('Tostado de J y Q', 'Pan lactal, jamón cocido y queso.', '1707513347_descarga (8).jpg', '1000'),
  ('Tarta Bombom', 'Base de chocolate y dulce de leche', '1707513621_descarga (9).jpg', '4500'),
  ('Torta Oreo', '	Bizcochuelo de chocolate, piso de galletita oreo, dulce de leche con queso crema y chantilly con oreo.', '1707513673_images (7).jpg', '4500'),
  ('Torta Selva Negra', 'Bizcochuelo de chocolate, crema, frutilla y rhum.', '1707513738_descarga (10).jpg', '4500'),
  ('Torta Cheesecake', 'Masa sablée, queso Philadelphia, frambuesa.', '1707513805_descarga (11).jpg', '4500'),
  ('Torta Cheesecake de dulce de leche', 'Masa sablée, queso Philadelphia y dulce de leche.', '1707513856_descarga (12).jpg', '4500'),
  ('Torta Cheesecake de Maracuyá', 'Masa sablée, queso Philadelphia con maracuyá y salsa de maracuya.', '1707513899_descarga (13).jpg', '4500'),
  ('Torta Balcarce', '	Bizcochuelo, vainilla, merengue, cerezas, crema, nuez y dulce de leche.', '1707513933_descarga (14).jpg', '4500'),
  ('Torta Lemon pie', 'Crema de limón y merengue italiano.', '1707513971_descarga (15).jpg', '4500'),
  ('Torta Ana', 'Base de brownie, dulce de leche, crema, chantilly y merengue italiano.', '1707514032_descarga (16).jpg', '4500'),
  ('Tarta de Frutillas', 'Pastelera, frutilla y base de tarta.', '1707514110_descarga (17).jpg', '4500'),
  ('Torta Nacional', 'Bizcochuelo mixto, 2 cortes de crema y dulce de leche.', '1707514558_descarga (18).jpg', '4500'),
  ('Torta Marroc', '	Bizcochuelo mixto, crema marroc, bombom marroc, chantilly y dulce de leche.', '1707514395_descarga (19).jpg', '4500'),
  ('Torta Baileys', 'Bizcochuelo de chocolate, mouse de dulce de leche, crema chantilly y baileys.', '1707514432_descarga (20).jpg', '4500'),
  ('Torta Larsen', 'Bizcochuelo de chocolate relleno de mouse de chocolate y chema chantilly. Terrminada en espejo de dulce de leche.', '1707514604_images (8).jpg', '4500'),
  ('Chocotorta', '	Base de galletitas chocolinas, dulcce de leche y queso crema.', '1707514483_descarga (21).jpg', '4500'),
  ('Granos de café Colombiano', 'Fragancia: Aroma fuerte, frutado e intenso, Acidez: Pronunciada y equilibrada, cuerpo: Bueno, brilloso e intenso.', '1707514182_GRANO COLOMBIANO.png', '51000'),
  ('Granos de café Brasilero', 'Un café que combina la fuerza y el sabor de los orígenes de Brasil de aroma intenso cuerpo cremoso y notas dulces a canela.', '1707514220_GRANOS BR.jpg', '34500'),
  ('Granos de café Italiano', 'Sabor: Muy pronunciado con tonos de caramelo, acidez: Media, aroma: Muy pronunciado, color: Oscuro y cuerpo: Muy completo.', '1707514260_GRANO ITALIANO.jpg', '33000');

-- Volcado de datos para la tabla `nosotros`
INSERT INTO tbl_nosotros (titulo, subtitulo, descripcion)
VALUES
  ('Nuestra historia', 'Fundada en el año 2000', 'Nuestra historia comenzó en el 2000, cuando un grupo de amigos compartiendo la misma pasión por el café, empezaron a tostar sus primeros granos. Hoy nuestra filosofía se mantiene intacta, brindándoles a nuestros amigos cafeteros, el placer de disfrutar las sensaciones de un café fresco que con tanto amor tostamos para ustedes. Seguimos aprendiendo y mejorando con nuestra pasión intacta, y fortalecida por la experiencia y por cada uno de ustedes que nos hacen crecer día a día. Les agradecemos y los invitamos a compartir este gran mundo del café. Esperamos verlos pronto.');

   -- Volcado de datos para la tabla `reservas`
INSERT INTO tbl_reservas (nombre , correo , fecha, hora)
VALUES
  ('Maxi', 'maxi@algo.com', '15/01/2024', '7:35 PM');

  -- Volcado de datos para la tabla `Roles`
INSERT INTO tbl_roles (rol)
VALUES 
  ('admin'),
  ('usuario');

  -- Volcado de datos para la tabla `servicios`
INSERT INTO tbl_servicios (titulo, descripcion, imagen)
VALUES
  ('Nuestas tentaciones', 'Mezclamos lo clásico con las últimas tendencias de pastelería. El resultado: los mejores postres y tortas en Buenos Aires.', '1703116138_torta.jpg'),
  ('Cafe en grano fresco', 'Café arábica La planta de café arábica es uno de los dos principales cafetos que existen actualmente. Entre 7 y 8 de cada 10 granos de café que se producen en el mundo pertenecen a este tipo, así que es el tipo de café que más probabilidades tienes de degustar.', '1703117190_cafe-655x368.jpg'),
  ('Café de la mejor calidad', 'Café Colombia-Risalda, Manisales De sabor intenso y concentrado que brinda sensaciones fuertes, duraderas y placenteras.', '1703117075_café-con-leche.jpeg'),
  ('Milkshakes', 'Los milkshakes son batidos elaborados con leche y helado, que pueden ser la alternativa perfecta para que tú o tus hijos, Los sabores más comunes del batido son vainilla, chocolate, y fresa.', '1703116271_milkshake_fresa_chocolate.jpg');
  

-- Volcado de datos para la tabla `testimonios`
INSERT INTO tbl_testimonios (nombre, profesion, descripcion, imagen)
VALUES
  ('Nadia Sánchez', 'Contadora Pública', 'Lugar agradable, música ambiental que te relaja. Las medialunas son muy buenas, el café cumple perfecto... Muy linda la ambientación y decoración. Seguramente no será la única vez que vayamos.', '1707338775_unnamed.png'),
  ('Carlos Mariano', 'Desempleado', 'Excelente lugar para ir a comer un buen tostado acompañado de un rico licuado. Además la atención es rápida y muy amable. Recomiendo.', '1707338902_unnamed (3).png'),
  ('Carina Solé', 'Empleada', 'El mejor café de la zona! Increíble lugar, súper recomendable todo! Excelente ambiente y atención! Tienen q pasar si andan por ahí ...de lo mejor q conocí. Los felicito Sirona Café!!', '1707338829_unnamed (1).png'),
  ('Esteban Roots', 'Ejecutivo de ventas', 'Excelente precio calidad. Nos gustó y volveremos, sobretodo porque ademas del buen servicio tambien cuentan con una sala de reuniones.', '1707338914_unnamed (2).png'),
  ('Analuz Martinez', 'Ama de casa', 'Horrible el tostado lo hacen con paleta, el café un asco y no había leche descremada.', '1707339353_unnamed (4).png'),
  ('María Isabel Chávez Iturre', 'Empresaria textil', 'Buena propuesta buenos precios', '1707339502_unnamed (5).png'),
  ('DISTRIBUIDORA ND S.R.L.', 'Distribuidora', 'Lejos el mejor café!!!!!', '1707339551_unnamed (6).png');
 
  -- Volcado de datos para la tabla `Usuarios`
INSERT INTO tbl_usuarios (usuario, password, correo)
VALUES 
  ('luciano', '123', 'luciano@algo.com'),
  ('maxi', '123', 'maximilianojlopez@hotmail.com');
 
 -- Volcado de datos para la tabla `Ventas`
INSERT INTO tbl_ventas (claveTransaccion, paypalDatos, fecha, correo, total, status)
VALUES 
  ('kd291ahgj38lahj868smcntsin', '{"id":"PAYID-MXDJZ6Y8LB91240X0068712S","intent":"sale","state":"approved","cart":"7GW9446095557770Y","payer":{"payment_method":"paypal","status":"VERIFIED","payer_info":{"email":"maxilopez@gmail.com","first_name":"Maximiliano Javier","last_name":"López","payer_id":"P3YDU4BU7B9CA","shipping_address":{"recipient_name":"Maximiliano Javier López","line1":"Free Trade Zone","city":"Buenos Aires","state":"Buenos Aires","postal_code":"B1675","country_code":"AR"},"phone":"5428877138","country_code":"AR"}},"transactions":[{"amount":{"total":"41500.00","currency":"USD","details":{"subtotal":"41500.00","shipping":"0.00","insurance":"0.00","handling_fee":"0.00","shipping_discount":"0.00","discount":"0.00"}},"payee":{"merchant_id":"VWH6UUGCB73EQ","email":"sb-dkgzk29102438@business.example.com"},"custom":"kd291ahgj38lahj868smcntsin#sn+4MtT/aS72eo8N6H1hDQ==","soft_descriptor":"PAYPAL *TEST STORE","item_list":{"shipping_address":{"recipient_name":"Maximiliano Javier López","line1":"Free Trade Zone","city":"Buenos Aires","state":"Buenos Aires","postal_code":"B1675","country_code":"AR"}},"related_resources":[{"sale":{"id":"8PU03490FS4384624","state":"completed","amount":{"total":"41500.00","currency":"USD","details":{"subtotal":"41500.00","shipping":"0.00","insurance":"0.00","handling_fee":"0.00","shipping_discount":"0.00","discount":"0.00"}},"payment_mode":"INSTANT_TRANSFER","protection_eligibility":"ELIGIBLE","protection_eligibility_type":"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE","transaction_fee":{"value":"2241.30","currency":"USD"},"parent_payment":"PAYID-MXDJZ6Y8LB91240X0068712S","create_time":"2024-02-09T21:45:55Z","update_time":"2024-02-09T21:45:55Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/sale/8PU03490FS4384624","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/payments/sale/8PU03490FS4384624/refund","rel":"refund","method":"POST"},{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAYID-MXDJZ6Y8LB91240X0068712S","rel":"parent_payment","method":"GET"}],"soft_descriptor":"PAYPAL *TEST STORE"}}]}],"create_time":"2024-02-09T21:45:31Z","update_time":"2024-02-09T21:45:55Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAYID-MXDJZ6Y8LB91240X0068712S","rel":"self","method":"GET"}]}', '2024-02-09 18:46:16', 'luciano@gmail.com', '41500.00', 'Completo');