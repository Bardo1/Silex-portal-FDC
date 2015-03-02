<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$routes = array(
    // nombre de pagina, url donde se encuentra, template asociado a esa pagina
    'homepage' => array('url' => '/', 'template' => 'inicio.twig'),
    'inicio' => array('url' => '/inicio', 'template' => 'inicio.twig'),
    'registrodeusuarios' => array('url' => '/registrodeusuarios', 'template' => 'registrodeusuarios.twig'),
    'informaciones' => array('url' => '/informaciones', 'template' => 'informaciones.twig'),
    'aviso' => array('url' => '/aviso', 'template' => 'aviso.twig'),
    'nosotros' => array('url' => '/nosotros', 'template' => 'nosotros.twig'),
    'noticia1' => array('url' => '/noticia1', 'template' => 'noticia1.twig'),
    'noticia2' => array('url' => '/noticia2', 'template' => 'noticia2.twig'),
    'noticia3' => array('url' => '/noticia3', 'template' => 'noticia3.twig'),
    'noticia4' => array('url' => '/noticia4', 'template' => 'noticia4.twig'),
    'noticia5' => array('url' => '/noticia5', 'template' => 'noticia5.twig'),
    'eventos' => array('url' => '/eventos', 'template' => 'eventos.twig'),
    'noticias' => array('url' => '/noticias', 'template' => 'noticias.twig'),
    'noti' => array('url' => '/noti', 'template' => 'noti.twig'),
    'micv' => array('url' => '/micv', 'template' => 'micv.twig'),
    'email.html' => array('url' => '/email.html', 'template' => 'email.html.twig'),
    'index' => array('url' => '/index.html', 'template' => 'index.html.twig'),
    'layout4' => array('url' => '/layout4', 'template' => 'layout4.twig'),
    'actualizarcv' => array('url' => '/actualizarcv', 'template' => 'actualizarcv.twig'),
    'registroinformacion' => array('url' => '/registroinformacion', 'template' => 'registroinformacion.twig'),
    'registrocontacto' => array('url' => '/registrocontacto', 'template' => 'registrocontacto.twig'),
    'eventos2' => array('url' => '/eventos2', 'template' => 'eventos2.twig'),
    'bienvenida' => array('url' => '/bienvenida', 'template' => 'bienvenida.twig'),
    'pruebeoferta' => array('url' => '/pruebeoferta', 'template' => 'pruebeoferta.twig'),
    'verpostulacionoferta' => array('url' => '/verpostulacionoferta', 'template' => 'verpostulacionoferta.twig'),
    'subircurriculum' => array('url' => '/subircurriculum', 'template' => 'subircurriculum.twig'),
    'ingresarofertalaboral' => array('url' => '/ingresarofertalaboral', 'template' => 'ingresarofertalaboral.twig'),
    'modificarofertalaboral' => array('url' => '/modificarofertalaboral', 'template' => 'modificarofertalaboral.twig'),
    'eliminarofertalaboral' => array('url' => '/eliminarofertalaboral', 'template' => 'eliminarofertalaboral.twig'),
    'postulaciones' => array('url' => '/postulaciones', 'template' => 'postulaciones.twig'),
    'registrodeusuario' => array('url' => '/registrodeusuario', 'template' => 'registrodeusuario.twig'),
    'layout' => array('url' => '/layout', 'template' => 'layout.twig'),
    'layout2' => array('url' => '/layout2', 'template' => 'layout2.twig'),
    'layout3' => array('url' => '/layout3', 'template' => 'layout3.twig'),
    'eventos1' => array('url' => '/eventos1', 'template' => 'eventos1.twig'),
    'ofertadesplegada' => array('url' => '/ofertadesplegada', 'template' => 'ofertadesplegada.twig'),
    'pruebe' => array('url' => '/pruebe', 'template' => 'pruebe.twig'),
    'eliminarusuarios' => array('url' => '/eliminarusuarios', 'template' => 'eliminarusuarios.twig'),
    'reenviarcontrasenia' => array('url' => '/reenviarcontrasenia', 'template' => 'reenviarcontrasenia.twig'),
    'enviarmensaje' => array('url' => '/enviarmensaje', 'template' => 'enviarmensaje.twig'),
);
foreach ($routes as $routeName => $data) {
    $app->get($data['url'], function() use($app, $data) {
        return $app['twig']->render($data['template']);
    })->bind($routeName);
}

$app->match('/ofertadesplegada', function () use ($app) {
    $app['session']->set('user',null );
    return $app->redirect($app['url_generator']->generate('inicio'));
})->bind('ofertadesplegada');

$app->match('/ingresaroferta', function () use ($app) {
    return $app->redirect($app['url_generator']->generate('ingresarofertalaboral'));
})->bind('ingresaroferta');

//subir documento a la plataforma
$app->match('/sub', function (Request $request) use ($app){
    $form = $app['form.factory']->createBuilder('form')
        ->add('FileUpload', 'file')
        ->getForm();
    $request = $app['request'];
    if ($request->isMethod('POST'))
    {
        $form->bind($request);
        if ($form->isValid())
        {

            $files = $request->files->get($form->getName());
            /* Make sure that Upload Directory is properly configured and writable */
            $path = __DIR__.'/../web/upload/';
            $filename = $files['FileUpload']->getClientOriginalName();

        // Cambiamos la variable del nombre
            $rows = $app['db']->update('informacion', array(
                    'curriculum' =>$filename ),
                array(
                    'id' => 1
                ));

            $files['FileUpload']->move($path,$filename);
        }
        return $app['twig']->render('subircurriculum.twig', array(
            'message' => 'Se ha subido el curriculum de forma correcta!',
            'form' => $form->createView()
        ),array('resultado' => true));
    }
    return $app['twig']->render('subircurriculum.twig', array(
            'message' => 'Subir un curriculum',
            'form' => $form->createView()
        ),array('resultado' => true)
    );
}, 'GET|POST')->bind('sub');

//login para acceder a las cuentas de usuario o administrador
$app->post('/login1', function () use ($app) {
    $username = $app['request']->get('username');
    echo "por aca si";
    $password = $app['request']->get('password');
    $em = $app["orm.em"];
    $urep1 = $em->getRepository('Entity\Usuario');
    $usuario =$urep1->findBy(array('email' => $app['request']->get('username') ));

    if ($usuario[0]->getEmail() == $username && $usuario[0]->getClave() == $password) {

        $app['session']->set('user', array('username' => $username));
        $app['session']->set('id', array('id' => $usuario[0]->getId()));

    }
    return $app->redirect($app['url_generator']->generate('inicio'));
})->bind('login1');

$app->match('/login2', function () use ($app) {

    return $app->redirect($app['url_generator']->generate('inicio'));
})->bind('login2');
// Cerrar la cuenta y anula la sesion de usuario
$app->match('/cerrar', function () use ($app) {
    $app['session']->set('user',null );
    return $app->redirect($app['url_generator']->generate('inicio'));
})->bind('cerrar');

//ingresar el registro de usuarios a la base de datos
$app->post('/ingresarmensajes', function() use($app) {
    $rows = $app['db']->insert('mensaje', array(
        'fecha' => $app['request']->get('fecha') ,
        'titulo' => $app['request']->get('titulo'),
        'descripcion' => $app['request']->get('descripcion')
        ));
    if( $rows <= 0 )
    {
        return $app['twig']->render('enviarmensaje.twig', array('resultado' => false));
    }
    else
    {
        return $app['twig']->render('enviarmensaje.twig', array('resultado' => true));
    }
})->bind('ingresarmensajes');


// Para ver los atributos de un usuario
$app->get('/verusuario', function() use($app) {

    // TODO: Obtener este id desde el request
    $id = 45;

    // Obtengo el repositorio (conexion del modelo logico a la base de datos)
    $em = $app["orm.em"];

    // Obtengo el usuario desde la base de datos
    $usuario = $em->find('Entity\Usuario', $id);

    // Muestro la informacion del usuario
    return $app['twig']->render('usuario.twig', array('usuario' => $usuario));

})->bind('verusuario');


//ingresar el registro de usuarios a la base de datos
$app->post('/ingresarusuario', function() use($app) {

    // Crea la entidad Usuario
    $usuario = new \Entity\Usuario();

    // Agrega los atributos de la entidad
    $usuario->setEmail($app['request']->get('email'));
    $usuario->setRut($app['request']->get('rut'));

    // Seguridad: http://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/

    // A higher "cost" is more secure but consumes more processing power
    $cost = 10;

    // Create a random salt
    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

    // Prefix information about the hash so PHP knows how to verify it later.
    // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
    $salt = sprintf("$2a$%02d$", $cost) . $salt;

    // Hash the password with the salt
    $hash = crypt($app['request']->get('password'), $salt);

    // Guardo el hash del usuario
    $usuario->setClave($hash);

    // Construccion de la informacion del usuario
    $informacion = new \Entity\Informacion();
    $informacion->setNombres($app['request']->get('nombres'));
    // ... TODO: Agregar los campos que faltan

    // Agrego la informacion del usuario
    $usuario->setInformacion($informacion);

    // Obtengo el repositorio (conexion del modelo logico a la base de datos)
    $em = $app["orm.em"];

    // Hago persistir en usuario en el backend (o sea, la base de datos)
    $em->persist($usuario);

    // Fuerzo el COMMIT a la BD.
    $em->flush();

    /*
    $rows = $app['db']->insert('usuario', array(
        'id' => $app['request']->get('nombre'),
        'email' => $app['request']->get('nombre'),
        'rut' => $app['request']->get('nombre'),
        'descripcion' => $app['request']->get('descripcion')));
    if( $rows <= 0 )
    {
        $app['session']->setFlash('error', 'Se ha producido un error al insertar
       el elemento');
       return $app['twig']->render('ingresarofertalaboral.twig', array(
            'nombre' => $app['request']->get('nombre'),
            'descripcion' => $app['request']->get('descripcion')));
    }
    else
    {
       // $app['session']->setFlash('ok', 'Elemento insertado correctamente');
        return $app->redirect($app['url_generator']->generate('inicio'));
    }
    */
})->bind('insertar_item');


//ingresar la oferta laboral
$app->post('/ingresarofertalaboral', function() use($app) {
    $rows = $app['db']->insert('ofertalaboral', array(
        'fechapublicacion' => $app['request']->get('fechapublicacion'),
        'Descripcion' => $app['request']->get('Descripcion'),
        'Requisitos' => $app['request']->get('requisitos'),
        'ubicacion' => $app['request']->get('ubicacion'),
        'beneficios' => $app['request']->get('beneficios'),
        'visibilidad' => $app['request']->get('visibilidad')));
    if( $rows <= 0 )
    {
        return $app['twig']->render('ingresarofertalaboral.twig', array('resultado' => false));
    }
    else
    {
        // $app['session']->setFlash('ok', 'Elemento insertado correctamente');
        return $app['twig']->render('ingresarofertalaboral.twig', array('resultado' => true));

    }
})->bind('insertar_item1');

//ingresar la oferta laboral
$app->post('/ingresarpostulacion', function() use($app) {

    $rows = $app['db']->insert('postulacion', array(
        'experiencia' => $app['request']->get('experiencia'),
        'niveleducacional' => $app['request']->get('niveleducacional'),
        'pretensionrenta' => $app['request']->get('pretensionrenta'),
        'disponibilidad' => $app['request']->get('disponibilidad'),
        'idoferta' => $app['request']->get('idoferta'),
        'username' => $app['request']->get('username')));

    if( $rows <= 0 )
    {
        $app['session']->setFlash('error', 'Se ha producido un error al insertar
       el elemento');
        return $app['twig']->render('ofertadesplegada1.twig', array(
            'nombre' => $app['request']->get('nombre'),
            'descripcion' => $app['request']->get('descripcion')));
    }
    else
    {
        // $app['session']->setFlash('ok', 'Elemento insertado correctamente');
        return $app->redirect($app['url_generator']->generate('ofertalaboral'));
    }
})->bind('ingresarpostulacion');

//Ingresardatos de cv de usuario
$app->post('/IngresarInformacionesContacto', function() use($app) {

    $rows = $app['db']->insert('informacion', array(
        // 'id' => $app['request']->get('nombre'),
        'id' => $app['request']->get('id'),
        'nombres' => $app['request']->get('nombres'),
        'apellidopaterno' => $app['request']->get('apellidopaterno'),
        'apellidomaterno' => $app['request']->get('apellidomaterno'),
        'fechanacimiento' => $app['request']->get('fechanacimiento'),
        'estadocivil' => $app['request']->get('estadocivil'),
        'sexo' => $app['request']->get('sexo'),
        'nacionalidad' => $app['request']->get('nacionalidad'),
        'curriculum' => $app['request']->get('curriculum')));

    $rows1 = $app['db']->insert('contacto', array(
        // 'id' => $app['request']->get('nombre'),
        'id' => $app['request']->get('id'),
        'calle' => $app['request']->get('calle'),
        'numero' => $app['request']->get('numero'),
        'otros' => $app['request']->get('otros'),
        'comuna' => $app['request']->get('comuna'),
        'email' => $app['request']->get('email'),
        'fono' => $app['request']->get('fono'),
        'movil' => $app['request']->get('movil')));

    if( $rows <= 0 )
    {
        $app['session']->setFlash('error', 'Se ha producido un error al insertar
        el elemento');
        return $app['twig']->render('ingresarofertalaboral.twig', array(
        'nombre' => $app['request']->get('nombre'),
        'descripcion' => $app['request']->get('descripcion')));
    }
    else
    {
        // $app['session']->setFlash('ok', 'Elemento insertado correctamente');

        return $app->redirect($app['url_generator']->generate('ingresarofertalaboral'));
    }
})->bind('insertar_item');




//ingresar el registro de usuarios a la base de datos
$app->post('/guardarusuario', function() use($app) {

        $em = $app["orm.em"];
        $urep1 = $em->getRepository('Entity\Usuario');
        $usuario =$urep1->findBy(array('email' => $app['request']->get('email') ));

        if ($usuario!=null) {
            return "esta huea esta repetida";
        }
        else
        {
          $rows = $app['db']->insert('usuario', array(
          'email' => $app['request']->get('email'),
          'rut' => $app['request']->get('rut'),
          'clave' => $app['request']->get('clave')));

          $rows = $app['db']->insert('informacion', array(
          'nombres' => $app['request']->get('nombres'),
          'apellidopaterno' => $app['request']->get('apellidopaterno'),
          'apellidomaterno' => $app['request']->get('apellidomaterno'),
          'fechanacimiento' => $app['request']->get('fechanacimiento'),
          'estadocivil' => $app['request']->get('estadocivil'),
          'sexo' => $app['request']->get('sexo'),
          'nacionalidad' => $app['request']->get('nacionalidad'),
          'curriculum' => ""));

          $rows = $app['db']->insert('contacto', array(
          'calle' => $app['request']->get('calle'),
          'numero' => $app['request']->get('numero'),
          'otros' => $app['request']->get('otros'),
          'comuna' => $app['request']->get('comuna'),
          'email' => $app['request']->get('email1'),
          'fono' => $app['request']->get('fono'),
          'movil' => $app['request']->get('movil')));

            return $app['twig']->render('bienvenida.twig', array('username' => $app['request']->get('email'),'clave' => $app['request']->get('clave')));

        }
})->bind('guardarusuario');



$app->post('/guardarinformacion', function() use($app) {

    $rows = $app['db']->insert('informacion', array(
        // 'id' => $app['request']->get('nombre'),
        'nombres' => $app['request']->get('nombres'),
        'apellidopaterno' => $app['request']->get('apellidopaterno'),
        'apellidomaterno' => $app['request']->get('apellidomaterno'),
        'fechanacimiento' => $app['request']->get('fechanacimiento'),
        'estadocivil' => $app['request']->get('estadocivil'),
        'sexo' => $app['request']->get('sexo'),
        'nacionalidad' => $app['request']->get('nacionalidad'),
        'curriculum' => ""));

    if( $rows <= 0 )
    {
        $app['session']->setFlash('error', 'Se ha producido un error al insertar
        el elemento');
        return $app['twig']->render('inicio.twig', array(
            'nombre' => $app['request']->get('nombre'),
            'descripcion' => $app['request']->get('descripcion')));
    }
    else
    {
        // $app['session']->setFlash('ok', 'Elemento insertado correctamente');
        return $app->redirect($app['url_generator']->generate('registrocontacto'));
    }
})->bind('guardarinformacion');


//Ingresardatos de cv de usuario
$app->post('/guardarcontacto', function() use($app) {

    $rows = $app['db']->insert('contacto', array(
        'calle' => $app['request']->get('calle'),
        'numero' => $app['request']->get('numero'),
        'otros' => $app['request']->get('otros'),
        'comuna' => $app['request']->get('comuna'),
        'email' => $app['request']->get('email'),
        'fono' => $app['request']->get('fono'),
        'movil' => $app['request']->get('movil')));

    if( $rows <= 0 )
    {
        $app['session']->setFlash('error', 'Se ha producido un error al insertar
        el elemento');
        return $app['twig']->render('inicio.twig', array(
            'nombre' => $app['request']->get('nombre'),
            'descripcion' => $app['request']->get('descripcion')));
    }
    else
    {
        // $app['session']->setFlash('ok', 'Elemento insertado correctamente');
        return $app['twig']->render('bienvenida.twig', array('ofertalaboral' => $ofertalaboral));

    }
})->bind('guardarcontacto');


// Despliega Ofertas del sistema
$app->get('/buscaoferta1/{id}', function ($id) use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral = $urep->findOneBy( array('id' => (int) $id ));
    return $app['twig']->render('despliegaoferta.twig', array('ofertalaboral' => $ofertalaboral));
});

// Despliega uns oferta en particular
$app->post('/ofertadesplegada', function () use ($app) {
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\OfertaLaboral');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $ofertalaboral = $urep->findBy(array('id' => $app['request']->get('id')));
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('ofertadesplegada.twig', array('ofertalaboral' => $ofertalaboral ));
})->bind('ofertadesplegada');

// Despliega uns oferta en particular
$app->post('/busqueda', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
   if( $app['request']->get('tipo')=="ID"){
    $ofertalaboral = $urep->findBy(array('id' => $app['request']->get('bus')));
   }
    if( $app['request']->get('tipo')=="Fecha"){
        $date = new DateTime($app['request']->get('bus'));
    $ofertalaboral = $urep->findBy(array('fechapublicacion' => $date ));
    }
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' => $ofertalaboral));
})->bind('busqueda');

// Despliega uns oferta en particular
$app->post('/ofertadesplegada', function () use ($app) {
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\OfertaLaboral');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $ofertalaboral = $urep->findBy(array('id' => $app['request']->get('id')));
    return $app['twig']->render('ofertadesplegada.twig', array('ofertalaboral' => $ofertalaboral ));
})->bind('ofertadesplegada');


$app->get('/ofertaspostulaciones/{id}', function ($id) use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Postulacion');
    $Postulacion =  $urep->findBy(array('username' => $id));
    return $app['twig']->render('pruebeoferta.twig', array('Postulacion' =>  $Postulacion));

})->bind('ofertaspostulaciones');


$app->get('/ordenarfecha', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $OfertaLaboral1 =  $urep->createQueryBuilder('p')
        ->orderBy('p.fechapublicacion','ASC')
        ->getQuery();

    $ofertalaboral = $OfertaLaboral1 ->getResult();
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' =>  $ofertalaboral));

})->bind('ordenarfecha');

$app->get('/ordenarfecha1', function () use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $OfertaLaboral1 =  $urep->createQueryBuilder('p')
        ->orderBy('p.fechapublicacion','DESC')
        ->getQuery();
    $ofertalaboral = $OfertaLaboral1 ->getResult();
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' =>  $ofertalaboral));
})->bind('ordenarfecha1');

$app->get('/ordenarid', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $OfertaLaboral1 =  $urep->createQueryBuilder('p')
        ->orderBy('p.id','ASC')
        ->getQuery();
    $ofertalaboral = $OfertaLaboral1 ->getResult();
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' =>  $ofertalaboral));
})->bind('ordenarid');

$app->get('/ordenarid1', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $OfertaLaboral1 =  $urep->createQueryBuilder('p')
        ->orderBy('p.id','DESC')
        ->getQuery();
    $ofertalaboral = $OfertaLaboral1 ->getResult();
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' =>  $ofertalaboral));
})->bind('ordenarid1');


$app->get('/oferta/{id}', function ($id) use ($app) {

    $em = $app["orm.em"];
    $urep1 = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral=$urep1->findBy(array('id' =>$id));
    return $app['twig']->render('pruebeoferta2.twig', array('ofertalaboral' =>  $ofertalaboral));
})->bind('oferta');



$app->post('/usuariosdeofertapostulaciones', function () use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Postulacion');
    $Postulacion =  $urep->findBy(array('idoferta' => $app['request']->get('id')));
    return $app['twig']->render('pruebeusuarios.twig', array('Postulacion' =>  $Postulacion));

})->bind('usuariosdeofertapostulaciones');


$app->get('/usuarios1/{id}', function ($id) use ($app) {

    $em = $app["orm.em"];
    $urep1 = $em->getRepository('Entity\Usuario');
    $usuario =$urep1->findBy(array('id' =>$id));
    return $app['twig']->render('pruebeusuarios2.twig', array('usuario' =>  $usuario));

})->bind('usuarios1');



$app->get('/postulacionesUsuariosEnOfertas/{id}', function ($id) use ($app) {

    $em = $app["orm.em"];
    $urep1 = $em->getRepository('Entity\Usuario');
    $urep = $em->getRepository('Entity\Postulacion');
    $Postulacion =  $urep->findBy(array('idoferta' => $id));
    $usuario= $urep1->findBy(array('id' =>$Postulacion[0]->getUsername()));
    return $app['twig']->render('pruebeusuarios.twig', array('usuario' => $usuario));

})->bind('pruebeusuarios');


//buscar oferta para eliminarla
$app->post('/buscaoferta', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral = $urep->findBy(array('id' => $app['request']->get('id')));
    return $app['twig']->render('despliegaoferta.twig', array('ofertalaboral' => $ofertalaboral ));

})->bind('despliegaoferta1');

//buscar oferta para eliminarla
$app->post('/buscaoferta', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral = $urep->findBy(array('id' => $app['request']->get('id')));
    return $app['twig']->render('modificarofertalaboral1.twig', array('ofertalaboral' => $ofertalaboral ));
})->bind('despliegaoferta1');

$app->post('/despliegaofertaeliminar', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral = $urep->findBy(array('id' => $app['request']->get('id')));
    return $app['twig']->render('eliminarofertalaboral1.twig', array('ofertalaboral' => $ofertalaboral ));

})->bind('despliegaofertaeliminar');


$app->match('/buscaperfilo/{id}', function($id) use ($app) {
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Informacion');
    $urep1 = $em->getRepository('Entity\Contacto');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $informacion = $urep->findBy(array('id' => $id));
    $contacto = $urep1->findBy(array('id' => $id));

    return $app['twig']->render('micv.twig', array('informacion' => $informacion, 'contacto' => $contacto ));
})->bind('buscaperfilo');


$app->match('/buscaperfilo2/{id}', function($id) use ($app) {
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Informacion');
    $urep1 = $em->getRepository('Entity\Contacto');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $informacion = $urep->findBy(array('id' => $id));
    $contacto = $urep1->findBy(array('id' => $id));

    return $app['twig']->render('actualizarcv.twig', array('informacion' => $informacion, 'contacto' => $contacto ));
})->bind('buscaperfilo2');



// Despliega de paginas de mensajes de usuario
$app->get('/buscaoferta/{id}', function ($id) use ($app) {
    // Entity Manager: para administrar las entidades de la base de datos
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\OfertaLaboral');
    // Obtengo un arreglo con todos los usuarios en la base de datos
   $ofertalaboral = $urep->find($id);
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('despliegaoferta.twig', array('ofertalaboral' => $ofertalaboral));
})->bind('despliegaoferta');


$app->get('/buscaInformacion/{id}', function ($id) use ($app) {
    // Entity Manager: para administrar las entidades de la base de datos
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Informacion');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $ofertalaboral = $urep->find($id);
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('despliegaoferta.twig', array('ofertalaboral' => $ofertalaboral));
})->bind('despliegaoferta');



//eliminar de la base de datos
$app->post('/eliminar', function() use ($app) {
    $rows = $app['db']->delete('ofertalaboral', array('id' => $app['request']->get('id')));
    //if( $rows <= 0 )
       // $app['session']->setFlash('error', 'Se ha producido un error al eliminar
       //la fila seleccionada');
  //  else
      //  $app['session']->setFlash('ok', 'La fila ha sido eliminada correctamente');
    return $app['twig']->render('eliminarofertalaboral.twig', array('resultado' => true));

})->bind('eliminar_item');


//eliminar de la base de datos
$app->post('/eliminar_usuarios', function() use ($app) {
    $app['db']->delete('usuario', array('id' => $app['request']->get('id')));
    $app['db']->delete('informacion', array('id' => $app['request']->get('id')));
    $app['db']->delete('contacto', array('id' => $app['request']->get('id')));
    $app['db']->delete('postulacion', array('username' => $app['request']->get('id')));

    return $app['twig']->render('eliminarusuarios.twig', array('resultado' => true));

})->bind('eliminar_usuarios');


//modificar un item
$app->post('/modificar_informacion_contacto', function() use ($app) {

    $rows1 = $app['db']->update('informacion', array(
            'id' => $app['request']->get('id'),
            'nombres' => $app['request']->get('nombres'),
            'apellidopaterno' => $app['request']->get('apellidopaterno'),
            'apellidomaterno' => $app['request']->get('apellidomaterno'),
            'fechanacimiento' => $app['request']->get('fechanacimiento'),
            'estadocivil' => $app['request']->get('estadocivil'),
            'sexo' => $app['request']->get('sexo'),
            'nacionalidad' => $app['request']->get('nacionalidad')),
        array(
            'id' => $app['request']->get('id')
        ));
    $rows = $app['db']->update('contacto', array(
             'id' => $app['request']->get('id'),
             'calle' => $app['request']->get('calle'),
             'numero' => $app['request']->get('numero'),
             'otros' => $app['request']->get('otros'),
             'comuna' => $app['request']->get('comuna'),
             'email' => $app['request']->get('email'),
             'fono' => $app['request']->get('fono'),
             'movil' => $app['request']->get('movil')),
        array(
            'id' => $app['request']->get('id')
        ));
    if( $rows <= 0 && $rows1 <= 0 )
    {
        return $app->redirect($app['url_generator']->generate('buscaperfilo2', array('id' => 1)));
    }
    else
    {

       return $app->redirect($app['url_generator']->generate('buscaperfilo2', array('id' => 1)));
    }
})->bind('modificar_informacion_contacto');


//modificar un item
$app->post('/modificarofertalaboral', function() use ($app) {
    $rows = $app['db']->update('ofertalaboral', array(
            'id' => $app['request']->get('id'),
            'fechapublicacion' => $app['request']->get('fechapublicacion'),
            'Descripcion' => $app['request']->get('Descripcion'),
            'requisitos' => $app['request']->get('requisitos'),
            'ubicacion' => $app['request']->get('ubicacion'),
            'beneficios' => $app['request']->get('beneficios'),
            'visibilidad' => $app['request']->get('visibilidad')),
        array(
            'id' => $app['request']->get('id')
        ));
    if( $rows <= 0 )
    {
        $app['session']->setFlash('error', 'Se ha producido un error al actualizar
        el elementos');
        return $app['twig']->render('insertar.twig.html', array(
            'editar' => true,
            'id' => $app['request']->get('id'),
            'nombre' => $app['request']->get('nombre'),
            'descripcion' => $app['request']->get('descripcion')));
    }
    else
    {
       // $app['session']->setFlash('ok', 'Se ha actualizado correctamente');
        return $app['twig']->render('modificarofertalaboral.twig', array('resultado' => true));

    }
})->bind('modificar_item');


// Despliega de paginas de mensajes de usuario
$app->get('/mensajes', function () use ($app) {
    // Entity Manager: para administrar las entidades de la base de datos
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Mensaje');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $mensajes = $urep->findAll();
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('mensajes.twig', array('mensajes' => $mensajes));
})->bind('mensajes');


$app->get('/verusuarios', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Informacion');
    $informacion = $urep->findall();
    return $app['twig']->render('despliegueusuarios.twig', array('informacion' => $informacion ));
})->bind('verusuarios');;

/**
 * Muestro las ofertas laborales presentes en la base de datos: Bolsa de trabajo
 */
$app->get('/ofertalaboral', function () use ($app) {
    // Entity Manager: para administrar las entidades de la base de datos
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\OfertaLaboral');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $ofertalaboral = $urep->findAll();
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' => $ofertalaboral));
})->bind('ofertalaboral');


// Despliega los usuarios en el sistema
$app->get('/add', function () use ($app) {
    $em = $app["orm.em"];
    $u = new \Entity\Usuario();
    $u->setRut('13014491');
    $u->setClave('hola123');
    $u->setEmail('durrutia@ucn.cl');
    $em->persist($u);
    $em->flush();
    return $app->json("ok", 200);
});

// Despliega los usuarios en el sistema
$app->get('/usuarios', function () use ($app) {
    // Entity Manager: para administrar las entidades de la base de datos
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Usuario');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $usuarios = $urep->findAll();
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('usuarios.twig', array('usuarios' => $usuarios));
});

// Despliega Ofertas del sistema
$app->get('/ofertas', function () use ($app) {
    // Entity Manager: para administrar las entidades de la base de datos
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\OfertaLaboral');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $ofertalaboral = $urep->findAll();
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' => $ofertalaboral));
});

// Despliega Ofertas del sistema
$app->get('/mensajes', function () use ($app) {
    // Entity Manager: para administrar las entidades de la base de datos
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Mensaje');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $mensajes = $urep->findAll();
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('mensajes.twig', array('mensajes' => $mensajes));
});

// Despliega Ofertas del sistema
$app->get('/mensajes', function () use ($app) {
    // Entity Manager: para administrar las entidades de la base de datos
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Mensaje');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $mensajes = $urep->findAll();
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('mensajes.twig', array('mensajes' => $mensajes));
});


$app->post('/enviarmail', function(Request $request) use ($app) {

    $email_to = "walterrmz1@gmail.com";
    $email_subject = "walterrmz1@gmail.com";
    $email_message = "Detalles del formulario de contacto:\n\n";
    $email_message .= "Nombre: " . "" . "\n";
    $email_message .= "Apellido: " . "" . "\n";
    $email_message .= "E-mail: " ."" . "\n";
    $email_message .= "Teléfono: " ."". "\n";
    $email_message .= "Comentarios: " . "" . "\n\n";
// Ahora se envía el e-mail usando la función mail() de PHP
    $headers = 'From: '.""."\r\n".
        'Reply-To: '.""."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);

    return new Response('Gracias por llenar la encuenta!', 201);

})->bind('enviarmail');

$app->post('/reenviarcontra', function(Request $request) use ($app) {

    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Usuario');
    $correo =$app['request']->get('correo');
    $usuario = $urep->findBy(array('email' => $correo));

    if ($usuario[0]->getEmail() == $correo ) {

        $Mensaje =$usuario[0]->getClave();
        echo $usuario[0]->getClave();
        echo $usuario[0]->getEmail();
        @mail('alexlateralus2009@gmail.com', $correo,  $Mensaje,"cabecera");
        echo "por aca si paso";
    }
    
    return new Response('Gracias por llenar la encuenta!', 201);
})->bind('reenviarcontra');

$app->match('/mandamail1', function () use ($app) {
$para      = 'walterrmz1@gmail.com';
$titulo    = 'El título';
$mensaje   = 'Hola';
$cabeceras = 'From: walterrmz1@gmail.com' . "\r\n" .
    'Reply-To: walterrmz1@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);
    return new Response('Thank you for your feedback!', 201);
})->bind('mandamail1');

$app->match('/feedback1', function (Request $request) {

    mail('walterrmz1@gmail.com', 'walterrmz1@gmail.com', "asdadaffdf");
    mail('alexlateralus2009@gmail.com', 'alexlateralus2009@gmail.com', "asdfadsf");
    return new Response('Thank you for your feedback!', 201);

})->bind('feedback1');

$app->match('/mandamail', function () use ($app) {
    $request = $app['request'];

    $message = \Swift_Message::newInstance()
        ->setSubject('walterrmz1@gmail.com')
        ->setFrom(array('walterrmz1@gmail.com'))
        ->setTo(array('walterrmz1@gmail.com'))
        ->setBody("mensaje boyd");

    $app['mailer']->send($message);

    return new Response('Thank you for your feedback!', 201);
})->bind('mandamail');




$app->match('/imail', function(Request $request) use ($app) {

    $form = $app['form.factory']->createBuilder('form')
        ->add('name', 'text')
        ->add('message', 'textarea')
        ->getForm();

    $request = $app['request'];

    if ($request->isMethod('POST'))
    {
        $form->bind($request);
        if ($form->isValid())
        {
            $data = $form->getData();

            $messagebody = $data['message'];
            $name        = $data['name'];

            $subject = "Message from ".$name;

            $app['mailer']->send(\Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom(array('silex.swiftmailer@gmail.com')) // replace with your own
                ->setTo(array('silex.swiftmailer@gmail.com'))   // replace with email recipient
                ->setBody($app['twig']->render('email.html.twig',   // email template
                    array('name'      => $name,
                        'message'   => $messagebody,
                    )),'text/html'));
        }

        return $app['twig']->render('index.html.twig', array(
            'message' => 'Message Sent',
            'form' => $form->createView()
        ));

    }
    return $app['twig']->render('index.html.twig', array(
            'message' => 'Send message to us',
            'form' => $form->createView()
        )
    );
}, "GET|POST")->bind('imail');


























$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    // 404.html, or 40x.html, or 4xx.html1, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );
    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});


