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
    'nuevo' => array('url' => '/nuevo', 'template' => 'nuevo.twig'),
    'nosotros' => array('url' => '/nosotros', 'template' => 'nosotros.twig'),
    'noticia1' => array('url' => '/noticia1', 'template' => 'noticia1.twig'),
    'noticia2' => array('url' => '/noticia2', 'template' => 'noticia2.twig'),
    'noticia3' => array('url' => '/noticia3', 'template' => 'noticia3.twig'),
    'noticia4' => array('url' => '/noticia4', 'template' => 'noticia4.twig'),
    'noticia5' => array('url' => '/noticia5', 'template' => 'noticia5.twig'),
    'micv' => array('url' => '/micv', 'template' => 'micv.twig'),
    'publicaoferta' => array('url' => '/publicaoferta', 'template' => 'publicaoferta.twig'),
    'Respuestaretornomail' => array('url' => '/Respuestaretornomail', 'template' => 'respuestaretornomail.twig'),
    'cambiarcontrasenia' => array('url' => '/cambiarcontrasenia', 'template' => 'cambiarcontrasenia.twig'),
    'actualizarcv' => array('url' => '/actualizarcv', 'template' => 'actualizarcv.twig'),
    'eventos2' => array('url' => '/eventos2', 'template' => 'eventos2.twig'),
    'bienvenida' => array('url' => '/bienvenida', 'template' => 'bienvenida.twig'),
    'pruebeoferta' => array('url' => '/pruebeoferta', 'template' => 'pruebeoferta.twig'),
    'verpostulacionoferta' => array('url' => '/verpostulacionoferta', 'template' => 'verpostulacionoferta.twig'),
    'subircurriculum' => array('url' => '/subircurriculum', 'template' => 'subircurriculum.twig'),
    'resultadoofertapubli' => array('url' => '/ resultadoofertapubli', 'template' => 'resultadoofertapubli.twig'),
    'respuestapostulacion' => array('url' => '/ respuestapostulacion', 'template' => ' respuestapostulacion.twig'),
    'respuestapostulacion2' => array('url' => '/ respuestapostulacion2', 'template' => ' respuestapostulacion2.twig'),
    'ingresarofertalaboral' => array('url' => '/ingresarofertalaboral', 'template' => 'ingresarofertalaboral.twig'),
    'modificarofertalaboral' => array('url' => '/modificarofertalaboral', 'template' => 'modificarofertalaboral.twig'),
    'eliminarofertalaboral' => array('url' => '/eliminarofertalaboral', 'template' => 'eliminarofertalaboral.twig'),
    'postulaciones' => array('url' => '/postulaciones', 'template' => 'postulaciones.twig'),
    'registrodeusuario' => array('url' => '/registrodeusuario', 'template' => 'registrodeusuario.twig'),
    'layout' => array('url' => '/layout', 'template' => 'layout.twig'),
    'revisarofertas' => array('url' => '/revisarofertas', 'template' => 'revisarofertas.twig'),
    'ofertadesplegada' => array('url' => '/ofertadesplegada', 'template' => 'ofertadesplegada.twig'),
    'eliminarusuarios' => array('url' => '/eliminarusuarios', 'template' => 'eliminarusuarios.twig'),
    'ingresarnoticia' => array('url' => '/ingresarnoticia', 'template' => 'ingresarnoticia.twig'),
    'eliminarnoticia' => array('url' => '/eliminarnoticia', 'template' => 'eliminarnoticia.twig'),
    'textarea' => array('url' => '/textarea', 'template' => 'textarea.twig'),
    'calendario' => array('url' => '/calendario', 'template' => 'calendario.twig'),

    'ingresaralbum' => array('url' => '/ingresaralbum', 'template' => 'ingresaralbum.twig'),
    'eliminaralbum' => array('url' => '/eliminaralbum', 'template' => 'eliminaralbum.twig'),
    'ingresarfoto' => array('url' => '/ingresarfoto', 'template' => 'ingresarfoto.twig'),
    'eliminarfoto' => array('url' => '/eliminarfoto', 'template' => 'eliminarfoto.twig'),

    'unacosa' => array('url' => '/unacosa', 'template' => 'unacosa.twig'),


    'unacosa1' => array('url' => '/unacosa1', 'template' => 'unacosa1.twig'),


    'sub22' => array('url' => '/sub22', 'template' => 'sub22.twig'),
    'modificarportadaalbum' => array('url' => '/modificarportadaalbum', 'template' => 'modificarportadaalbum.twig'),
    'modificarportadaalbum1' => array('url' => '/modificarportadaalbum1', 'template' => 'modificarportadaalbum1.twig'),

    'eliminarslide' => array('url' => '/eliminarslide', 'template' => 'eliminarslide.twig'),
    'ingresarslide' => array('url' => '/ingresarslide', 'template' => 'ingresarslide.twig'),
    'reenviarcontrasenia' => array('url' => '/reenviarcontrasenia', 'template' => 'reenviarcontrasenia.twig'),
    'enviarmensaje' => array('url' => '/enviarmensaje', 'template' => 'enviarmensaje.twig'),
);

/**
 * cicclo que permite el direccionamiento a las plantillas estaticas
 */
foreach ($routes as $routeName => $data) {
    $app->get($data['url'], function() use($app, $data) {
        return $app['twig']->render($data['template']);
    })->bind($routeName);
}

/**
 * login para acceder a las cuentas de usuario o administrador
 */
$app->post('/login1', function () use ($app) {
    $username = $app['request']->get('username');
    $password = $app['request']->get('password');
    $em = $app["orm.em"];
    $usuario1= $em->getRepository('Entity\Usuario')->findOneBy(array('email' => $app['request']->get('username')));
    if ( $usuario1->getEmail()== $username &&  crypt($password, $usuario1->getClave()) == $usuario1->getClave() ) {
        $app['session']->set('user', array('username' => $username));
        $app['session']->set('id', array('id' => $usuario1->getId()));
    }
    return $app->redirect($app['url_generator']->generate('inicio'));
})->bind('login1');

/**
 * Cerrar la cuenta y anula la sesion de usuario
 */
$app->match('/cerrar', function () use ($app) {
    $app['session']->set('user',null );
    return $app->redirect($app['url_generator']->generate('inicio'));
})->bind('cerrar');
/**
 * Cerrar la cuenta y anula la sesion de usuario
 */
$app->match('/calendario1', function () use ($app) {
    return $app->redirect($app['url_generator']->generate('calendario'));
})->bind('calendario1');

/**
 * Cerrar la cuenta y anula la sesion de usuario
 */
$app->match('/enviarmensaje1', function () use ($app) {
    return $app->redirect($app['url_generator']->generate('enviarmensaje'));
})->bind('enviarmensaje1');


/**
* Perfil administrador: despliega los usuarios, informacion y contacto.
* @return  object usuario
*/
$app->get('/revisarofertas', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaPublicada');
    $OfertaPublicada = $urep->findall();
    return $app['twig']->render('revisarofertas.twig', array('OfertaPublicada' => $OfertaPublicada ));
})->bind('revisarofertas');

/**
 * Perfil administrador: ingreso de mensajes a la base de datos
 * @return  bool resultado
 */
$app->post('/guardaofertapublicada', function() use($app) {
    $OferPu = new \Entity\OfertaPublicada();
    $date = new DateTime($app['request']->get('fechapublicacion'));
    $OferPu->setFechaPublicacion($date);
    $OferPu->setNombre($app['request']->get('nombre'));
    $OferPu->setCorreo($app['request']->get('correo'));
    $OferPu->setTelefono($app['request']->get('telefono'));
    $OferPu->setOtrosdatos1($app['request']->get('otros'));
    $OferPu->setDescripcion($app['request']->get('descripcion'));
    $OferPu->setRequisitos($app['request']->get('requisitos'));
    $OferPu->setUbicacion($app['request']->get('ubicacion'));
    $OferPu->setBeneficios($app['request']->get('beneficios'));
    $OferPu->setOtrosdatos2($app['request']->get('otrosd'));
    $em = $app["orm.em"];
    $em->persist($OferPu);
    $em->flush();
    return $app['twig']->render('resultadoofertapubli.twig', array('resultado' => true));
})->bind('guardaofertapublicada');




$app->get('/noticias1', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Noticia');
    $noticia = $urep->findall();
    return $app['twig']->render('noticias.twig', array('noticia' => $noticia ));
})->bind('noticias1');

$app->get('/eventos1', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $albu =  $urep->createQueryBuilder('p')
        ->orderBy('p.id','DESC')
        ->getQuery();
    $album = $albu ->getResult();
    return $app['twig']->render('albumes.twig', array('album' => $album ));
})->bind('eventos1');

$app->match('/cambiocontra12', function() use ($app) {

    return $app['twig']->render('contraadmin.twig');

})->bind('cambiocontra12');

$app->match('/cambiocontra123', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Usuario');
    $correo=  $app['request']->get('us');
    $usuario = $urep->findOneBy(array('email' => $correo));
    $resultado=false;
    if($usuario!=null){
      if(crypt($app['request']->get('vieja'), $usuario->getClave()) == $usuario->getClave() ){
          if($app['request']->get('nueva')== $app['request']->get('nueva1') ){
              $Npassword = $app['request']->get('nueva');
              $cost = 10;
              $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
              $salt = sprintf("$2y$%02d$", $cost) . $salt;
              $hash = crypt($Npassword, $salt);
              $usuario->setClave($hash);
              $em->persist($usuario);
              $em->flush();
              $resultado=true;

      }
      }
      }
  return $app['twig']->render('contraadmin.twig', array('resultado' => $resultado ));

})->bind('cambiocontra123');


$app->match('/modificaalbum12', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findall();
    return $app['twig']->render('modificaralbum.twig', array('album' => $album ));

})->bind('modificaalbum12');


$app->match('/modificaportadaalbum12', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findall();
    return $app['twig']->render('modificarportadaalbum.twig', array('album' => $album ));

})->bind('modificaportadaalbum12');


$app->match('/noticiadesplegada/{id}', function ($id) use ($app) {

    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Noticia');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $noticia = $urep->findOneBy(array('id' => $id));
    // Retorno la pagina web con los usuarios.
    $nota= str_replace("<br />","",  $noticia->getContenido());

    //$nota =nl2br( $noticia->getContenido());

    return $app['twig']->render('noticiadesplegada.twig', array('noticia' => $noticia, 'nota' => $nota ));

})->bind('noticiadesplegada');




$app->match('/albumdesplegado/{id}', function ($id) use ($app) {
    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Album');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $album = $urep->findOneBy(array('id' => $id));
    $foto =$album->getFotos();
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('albumdesplegado.twig', array('foto' => $foto, 'album' => $album ));
})->bind('albumdesplegado');


$app->match('/ingresafoto1', function () use ($app) {

    $em = $app["orm.em"];
    // Repositorio que administra la entidad Usuario
    $urep = $em->getRepository('Entity\Album');
    // Obtengo un arreglo con todos los usuarios en la base de datos
    $album = $urep->findall();
    // Retorno la pagina web con los usuarios.
    return $app['twig']->render('ingresarfoto.twig', array('album' => $album ));

})->bind('ingresafoto1');



/**
 * Perfil administrador: elimina una oferta laboral especifica
 * @return  bool resultado
 */
$app->match('/eliminarnoticia3', function() use ($app) {
    $em = $app["orm.em"];
    $id = $app['request']->get('id');
    $noticia = $em->getRepository('Entity\Noticia')->findOneBy(array('id' => $app['request']->get('id')));
    if($noticia!= null){
        $em->remove($noticia);
        $em->flush();
    }
    $resultado=true;
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Noticia');
    $noti = $urep->findall();

    return $app['twig']->render('eliminarnoticia.twig', array('resultado' => $resultado, 'noti' => $noti));
})->bind('eliminarnoticia3');


/**
 * Perfil administrador: elimina una oferta laboral especifica
 * @return  bool resultado
 */
$app->match('/eliminarfoto', function() use ($app) {

    $em = $app["orm.em"];
    $foto = $em->getRepository('Entity\Foto')->findOneBy(array('id' => $app['request']->get('id')));
    if($foto!= null){
        $em->remove($foto);
        $em->flush();
        $resultado=true;
    }else{
        $resultado=false;
    }
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findall();
    return $app['twig']->render('eliminarfoto.twig', array('resultado' => $resultado,'album' => $album ));
})->bind('eliminarfoto');

$app->match('/modificarfoto', function() use ($app) {

    $em = $app["orm.em"];
    $foto = $em->getRepository('Entity\Foto')->findOneBy(array('id' => $app['request']->get('id')));
    if($foto!= null){
        $foto->setDescripcion($app['request']->get('descripcion'));
        $em->persist($foto);
        $em->flush();

        $resultado=true;
    }else{
        $resultado=false;
    }
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findall();
    return $app['twig']->render('modificarfoto.twig', array('resultado' => $resultado,'album' => $album ));

})->bind('modificarfoto');

/**
 * Perfil administrador: elimina el album especifico
 * @return  bool resultado
 */
$app->match('/eliminaralbum1', function() use ($app) {

    $em = $app["orm.em"];
    $album = $em->getRepository('Entity\Album')->findOneBy(array('id' => $app['request']->get('id')));
    if($album!= null){
        $em->remove($album);
        $em->flush();
    }
    $resultado=true;

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album1 = $urep->findall();

    return $app['twig']->render('eliminaralbum.twig', array('resultado' => $resultado, 'album1' => $album1));
})->bind('eliminaralbum1');


/**
 * subir noticia
 * @return bool  resultado
 */
$app->match('/ingresarnoticia', function () use ($app){
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
            $path = __DIR__.'/../web/images/';
            $filename = $files['FileUpload']->getClientOriginalName();
            //Cambiamos la variable del nombre
            $entrada = new \Entity\Noticia();
            $date = new DateTime($app['request']->get('fecha'));
            $entrada->setFecha($date);
            $entrada->setTitulo($app['request']->get('titulo'));
            $entrada->setReferencia($app['request']->get('refere'));

            $conte=nl2br($app['request']->get('contenido'));

            $entrada->setContenido($conte);
            $entrada->setFoto($filename);

            $em = $app["orm.em"];
            $em->persist($entrada);
            $em->flush();
            $files['FileUpload']->move($path,$filename);
        }

        return $app['twig']->render('ingresarnoticia.twig', array(
            'message' => 'Se ha subido la foto ',
            'form' => $form->createView()
        ),array('resultado' => true));
    }
    return $app['twig']->render('ingresarnoticia.twig', array(
            'message' => 'Subir un curriculum',
            'form' => $form->createView()
        ),array('resultado' => true)
    );

}, 'GET|POST')->bind('ingresarnoticia');







/**
 * subir noticia
 * @return bool  resultado
 */
$app->match('/ingresarnoticia', function () use ($app){
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
            $path = __DIR__.'/../web/images/';
            $filename = $files['FileUpload']->getClientOriginalName();
            //Cambiamos la variable del nombre
            $entrada = new \Entity\Noticia();
            $date = new DateTime($app['request']->get('fecha'));
            $entrada->setFecha($date);
            $entrada->setTitulo($app['request']->get('titulo'));
            $entrada->setReferencia($app['request']->get('refere'));

            $conte=nl2br($app['request']->get('contenido'));

            $entrada->setContenido($conte);
            $entrada->setFoto($filename);

            $em = $app["orm.em"];
            $em->persist($entrada);
            $em->flush();
            $files['FileUpload']->move($path,$filename);
        }

        return $app['twig']->render('ingresarnoticia.twig', array(
            'message' => 'Se ha subido la foto ',
            'form' => $form->createView()
        ),array('resultado' => true));
    }
    return $app['twig']->render('ingresarnoticia.twig', array(
            'message' => 'Subir un curriculum',
            'form' => $form->createView()
        ),array('resultado' => true)
    );

}, 'GET|POST')->bind('ingresarnoticia');



/**
 * subir noticia
 * @return bool  resultado
 */
$app->match('/ingresarslide', function () use ($app){
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
            $path = __DIR__.'/../web/images/';
            $filename = $files['FileUpload']->getClientOriginalName();
            //Cambiamos la variable del nombre
            $slide = new \Entity\Slide();
            $slide->setUrl($filename);
            $slide->setPortada("");

            $em = $app["orm.em"];
            $em->persist($slide);
            $em->flush();
            $files['FileUpload']->move($path,$filename);
        }

        return $app['twig']->render('ingresarslide.twig', array( 'message' => 'Se ha subido la foto ', 'form' => $form->createView() ));
    }
    return $app['twig']->render('ingresarslide.twig', array('message' => 'Subir un curriculum', 'form' => $form->createView() ));

}, 'GET|POST')->bind('ingresarslide');

/**
 * subir noticia
 * @return bool  resultado
 */
$app->match('/ingresaralbum', function () use ($app){
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
            $path = __DIR__.'/../web/images/';
            $filename = $files['FileUpload']->getClientOriginalName();
            //Cambiamos la variable del nombre
            $Album = new \Entity\Album();
            $Album->setTitulo($app['request']->get('titulo'));
            $Album->setDescripcion($app['request']->get('descripcion'));
            $Album->setUrl($filename);

            $em = $app["orm.em"];
            $em->persist($Album);
            $em->flush();
            $files['FileUpload']->move($path,$filename);
        }
        return $app['twig']->render('ingresaralbum.twig', array(
            'message' => 'Se ha subido la foto ',
            'form' => $form->createView()
        ),array('resultado' => true));
    }
    return $app['twig']->render('ingresaralbum.twig', array(
            'message' => 'Subir un curriculum',
            'form' => $form->createView()
        ),array('resultado' => true)
    );

}, 'GET|POST')->bind('ingresaralbum');


/**
 * subir noticia
 * @return bool  resultado
 */
$app->match('/ingresarfoto', function () use ($app){
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
            $path = __DIR__.'/../web/images/';
            $filename = $files['FileUpload']->getClientOriginalName();
            //Cambiamos la variable del nombre

             $em = $app["orm.em"];
            $Album= $em->getRepository('Entity\Album')->findOneBy(array('id' => $app['request']->get('nombreal')));
           echo $Album->getDescripcion();
            $foto = new \Entity\Foto();
            $foto->setDescripcion($app['request']->get('descripcion'));
            echo $foto->getUrl();
            $foto->setAlbum($Album);
            $foto->setUrl($filename);
            $em->persist($foto);
            $Album->addFoto($foto);
            $em->persist($foto);
            $em->persist($Album);
            $em->flush();
            $files['FileUpload']->move($path,$filename);
        }


        $em = $app["orm.em"];
        $urep = $em->getRepository('Entity\Album');
        $album = $urep->findall();
        return $app['twig']->render('ingresarfoto.twig', array('message' => 'Se ha subido la foto ','form' => $form->createView(),'album' => $album));
    }
        $em = $app["orm.em"];
        $urep = $em->getRepository('Entity\Album');
        $album = $urep->findall();
        return $app['twig']->render('ingresarfoto.twig', array('message' => 'Subir un curriculum', 'form' => $form->createView(),'album' => $album));

}, 'GET|POST')->bind('ingresarfoto');




$app->match('/verpostulacionoferta12', function() use ($app) {


    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $oferta = $urep->findall();
    return $app['twig']->render('verpostulacionoferta.twig', array('oferta' => $oferta ));

})->bind('verpostulacionoferta12');



/**
 * Perfil administrador: eliminar de la base de datos
 * @return  bool resultado
 */
$app->match('/elimarfoto12', function() use ($app) {


    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findall();
    return $app['twig']->render('eliminarfoto.twig', array('album' => $album ));

})->bind('elimarfoto12');


$app->match('/modificarfoto12', function() use ($app) {


    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findall();
    return $app['twig']->render('modificarfoto.twig', array('album' => $album ));

})->bind('modificarfoto12');


$app->match('/eliminarslide1', function() use ($app) {

    $em = $app["orm.em"];
    $id= $app['request']->get('id');
    $slide = $em->find('Entity\Slide',$id);
    $resultado=false;
    if($slide != null && $slide->getPortada()!="si"){
        $em->remove($slide);
        $em->flush();
        $resultado=true;
    }
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Slide');
    $slide = $urep->findall();

    return $app['twig']->render('eliminarslide.twig', array('slide' => $slide, 'resultado' => $resultado  ));

})->bind('eliminarslide1');



$app->match('/cambiaslide1', function() use ($app) {

    $em = $app["orm.em"];
    $id= $app['request']->get('id');
    $slide1 = $em->find('Entity\Slide',$id);
    $resultado=true;

    $em = $app["orm.em"];
    $slide= $em->getRepository('Entity\Slide')->findOneBy(array('portada' => "si"));

    $slide->setPortada("");
    $em->persist($slide);
    $em->flush();

    $slide1->setPortada("si");
    $em->persist($slide1);
    $em->flush();

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Slide');
    $slide = $urep->findall();

    return $app['twig']->render('seleccionarslide.twig', array('slide' => $slide, 'resultado' => $resultado  ));

})->bind('cambiaslide1');




/**
 * Perfil administrador: eliminar de la base de datos
 * @return  bool resultado
 */
$app->post('/elimaroferpubli', function() use ($app) {
    $em = $app["orm.em"];
    $id= $app['request']->get('id');
    $OferPubli = $em->find('Entity\OfertaPublicada',$id);
    if($OferPubli!= null){
        $em->remove($OferPubli);
        $em->flush();
    }
    $urep = $em->getRepository('Entity\OfertaPublicada');
    $OfertaPublicada = $urep->findall();
    return $app['twig']->render('revisarofertas.twig', array('OfertaPublicada' => $OfertaPublicada ));
})->bind('elimaroferpubli');

/**
 * Perfil administrador: despliega los usuarios, informacion y contacto.
 * @return  object usuario
 */
$app->get('/verusuarios', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Usuario');
    $usuario = $urep->findall();
    return $app['twig']->render('despliegueusuarios.twig', array('usuario' => $usuario ));
})->bind('verusuarios');
/**
 * Perfil administrador: Modifica oferta laboral
 * @return  bool resultado
 */
$app->post('/modificarofertalaboral', function() use ($app) {
    $em = $app["orm.em"];
    $ofertalaboral = $em->find('Entity\OfertaLaboral', $app['request']->get('id'));
    $date = new DateTime($app['request']->get('fechapublicacion'));
    $ofertalaboral->setFechapublicacion($date);
    $ofertalaboral->setDescripcion($app['request']->get('Descripcion'));
    $ofertalaboral->setRequisitos($app['request']->get('requisitos'));
    $ofertalaboral->setUbicacion($app['request']->get('ubicacion'));
    $ofertalaboral->setBeneficios($app['request']->get('beneficios'));
    $ofertalaboral->setVisibilidad($app['request']->get('visibilidad'));
    $em = $app["orm.em"];
    $em->persist($ofertalaboral);
    $em->flush();


    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $oferta = $urep->findall();

    return $app['twig']->render('modificarofertalaboral.twig', array('resultado' => true, 'oferta' => $oferta));
})->bind('modificar_item');



/**
 * Perfil administrador: Modifica oferta laboral
 * @return  bool resultado
 */
$app->match('/modificarofertalaboral12', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $oferta = $urep->findall();

    return $app['twig']->render('modificarofertalaboral.twig', array('oferta' => $oferta));

})->bind('modificarofertalaboral12');


/**
 * Perfil administrador: Modifica oferta laboral
 * @return  bool resultado
 */
$app->match('/eliminarnoticia12', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Noticia');
    $noti = $urep->findall();

    return $app['twig']->render('eliminarnoticia.twig', array('noti' => $noti));

})->bind('eliminarnoticia12');

/**
 * Perfil administrador: ingresar la oferta laboral
 * @return  bool resultado
 */
$app->post('/ingresar_item1', function() use($app) {
    $ofertalaboral = new \Entity\OfertaLaboral();
    $date = new DateTime( $app['request']->get('fechapublicacion'));
   $ofertalaboral->setFechapublicacion($date);
    $ofertalaboral->setDescripcion($app['request']->get('Descripcion'));
    $ofertalaboral->setRequisitos($app['request']->get('requisitos'));
    $ofertalaboral->setUbicacion($app['request']->get('ubicacion'));
    $ofertalaboral->setBeneficios($app['request']->get('beneficios'));
    $ofertalaboral->setVisibilidad($app['request']->get('visibilidad'));
    $em = $app["orm.em"];
    $em->persist($ofertalaboral);
    $em->flush();
   return $app['twig']->render('ingresarofertalaboral.twig', array('resultado' => true));
})->bind('insertar_item1');

/**
 * Perfil administrador: ingreso de mensajes a la base de datos
 * @return  bool resultado
 */
$app->post('/ingresarmensajes', function() use($app) {
    $mensaje = new \Entity\Mensaje();
    $date = new DateTime($app['request']->get('fecha'));
    $mensaje->setFecha($date);
    $mensaje->setTitulo($app['request']->get('titulo'));
    $mensaje->setDescripcion($app['request']->get('descripcion'));
    $em = $app["orm.em"];
    $em->persist($mensaje);
    $em->flush();
    return $app['twig']->render('enviarmensaje.twig', array('resultado' => true));
})->bind('ingresarmensajes');

/**
 * Perfil administrador: despliega la oferta a eliminar
 * @return  object ofertalaboral
 */
$app->post('/despliegaofertaeliminar', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral = $urep->findBy(array('id' => $app['request']->get('id')));

    $urep = $em->getRepository('Entity\OfertaLaboral');
    $oferta = $urep->findall();

    return $app['twig']->render('eliminarofertalaboral1.twig', array('ofertalaboral' => $ofertalaboral, 'oferta' => $oferta ));

})->bind('despliegaofertaeliminar');


$app->match('/eliminarofertalaboral12', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $oferta = $urep->findall();
    return $app['twig']->render('eliminarofertalaboral.twig', array('oferta' => $oferta ));

})->bind('eliminarofertalaboral12');
/**
 * Perfil administrador: despliega la noticia a eliminar
 * @return  object ofertalaboral
 */
$app->post('/desplieganoticiaeliminar', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Noticia');
    $noticia = $urep->findBy(array('id' => $app['request']->get('id')));

    $urep = $em->getRepository('Entity\Noticia');
    $noti = $urep->findall();
    return $app['twig']->render('eliminarnoticia1.twig', array('noticia' => $noticia, 'noti' => $noti ));
})->bind('desplieganoticiaeliminar');

/**
 * Perfil administrador: despliega la noticia a eliminar
 * @return  object ofertalaboral
 */
$app->match('/despliegafotoeliminar1', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findOneBy(array('id' => $app['request']->get('id')));
    $foto =$album->getFotos();
    return $app['twig']->render('eliminarfoto0.twig', array('album' => $album, 'foto' => $foto ));

})->bind('despliegafotoeliminar1');

$app->match('/despliegaalbummodificar1', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album1 = $urep->findall();
    $album = $urep->findOneBy(array('id' => $app['request']->get('id')));
    return $app['twig']->render('modificaralbum1.twig', array('album' => $album,'album1' => $album1));

})->bind('despliegaalbummodificar1');




$app->match('/otraprueba', function () use ($app){
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
            $path = __DIR__.'/../web/images/';
            $filename = $files['FileUpload']->getClientOriginalName();
            //Cambiamos la variable del nombre

            $em = $app["orm.em"];
            $Album= $em->getRepository('Entity\Album')->findOneBy(array('id' => $app['request']->get('nombreal')));
            echo $Album->getDescripcion();
            $foto = new \Entity\Foto();
            $foto->setDescripcion($app['request']->get('descripcion'));
            echo $foto->getUrl();
            $foto->setAlbum($Album);
            $foto->setUrl($filename);
            $em->persist($foto);
            $Album->addFoto($foto);
            $em->persist($foto);
            $em->persist($Album);
            $em->flush();
            $files['FileUpload']->move($path,$filename);
        }


        $em = $app["orm.em"];
        $urep = $em->getRepository('Entity\Album');
        $album = $urep->findall();
        return $app['twig']->render('sub22.twig', array('message' => 'Se ha subido la foto ','form' => $form->createView(),'album' => $album));
    }
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findall();
    return $app['twig']->render('sub22.twig', array('message' => 'Subir un curriculum', 'form' => $form->createView(),'album' => $album));

}, 'GET|POST')->bind('otraprueba');






$app->match('/despliegaaportadaalbummodificar1', function () use ($app){
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
            $path = __DIR__.'/../web/images/';
            $filename = $files['FileUpload']->getClientOriginalName();
            //Cambiamos la variable del nombre
            $entrada = new \Entity\Noticia();
            $em = $app["orm.em"];
            $urep = $em->getRepository('Entity\Album');
            $album = $urep->findOneBy(array('id' => $app['request']->get('id')));

            $album ->setUrl($filename);
            $em = $app["orm.em"];
            $em->persist($album);
            $em->flush();
            $files['FileUpload']->move($path,$filename);
        }

        $em = $app["orm.em"];
        $urep = $em->getRepository('Entity\Album');
        $album1 = $urep->findall();
        $album = $urep->findOneBy(array('id' => $app['request']->get('id')));


        return $app['twig']->render('modificarportadaalbum1.twig', array(
            'message' => 'Se ha cambiado la foto de portada del album ',
            'form' => $form->createView(),'album' => $album,'album1' => $album1, 'resultado' => true
        ));
    }

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album1 = $urep->findall();
    $album = $urep->findOneBy(array('id' => $app['request']->get('id')));

    return $app['twig']->render('modificarportadaalbum1.twig', array(
            'message' => 'Subir una nueva foto de portada',
            'form' => $form->createView(),'album' => $album,'album1' => $album1
        ),array('resultado' => true)
    );

}, 'GET|POST')->bind('despliegaaportadaalbummodificar1');


$app->match('/ingresarslide', function () use ($app){

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
            $path = __DIR__.'/../web/images/';
            $filename = $files['FileUpload']->getClientOriginalName();
            //Cambiamos la variable del nombre
            $slide = new \Entity\Slide();
            $slide->setUrl($filename);
            $slide->setPortada("");

            $em = $app["orm.em"];
            $em->persist($slide);
            $em->flush();
            $files['FileUpload']->move($path,$filename);
        }

        return $app['twig']->render('ingresarslide.twig', array( 'message' => 'Se ha subido la foto ', 'form' => $form->createView() ));
    }
    return $app['twig']->render('ingresarslide.twig', array('message' => 'Subir un curriculum', 'form' => $form->createView() ));

}, 'GET|POST')->bind('ingresarslide');




$app->match('/modificaal', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');

    $album = $urep->findall();

    $album1 = $urep->findOneBy(array('id' => $app['request']->get('id')));

    $album1->setDescripcion( $app['request']->get('descripcion'));
    $em->persist($album1);
    $em->flush();

    return $app['twig']->render('modificaralbum.twig', array('album' => $album, 'resultado' => true ));

})->bind('modificaal');


$app->match('/despliegafotomodificar1', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findOneBy(array('id' => $app['request']->get('id')));
    $foto =$album->getFotos();
    return $app['twig']->render('modificarfoto0.twig', array('album' => $album, 'foto' => $foto ));

})->bind('despliegafotomodificar1');

$app->match('/despliegafotoeliminar2', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Foto');
    $foto = $urep->findOneBy(array('id' => $app['request']->get('id')));
    $urep = $em->getRepository('Entity\Album');

    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findall();
    return $app['twig']->render('eliminarfoto1.twig', array('album' => $album, 'foto' => $foto   ));

})->bind('despliegafotoeliminar2');



$app->match('/despliegafotomodificar2', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Foto');
    $foto = $urep->findOneBy(array('id' => $app['request']->get('id')));
    $urep = $em->getRepository('Entity\Album');

    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findall();
    return $app['twig']->render('modificarfoto1.twig', array('album' => $album, 'foto' => $foto   ));

})->bind('despliegafotomodificar2');


$app->match('/despliegaslideeliminar1', function() use ($app) {
    $em = $app["orm.em"];
    $slide = $em->getRepository('Entity\Slide')->findOneBy(array('id' => $app['request']->get('id')));
    $valor=$slide->getUrl();
    $slide1=$slide;

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Slide');
    $slide3 = $urep->findall();

    return $app['twig']->render('eliminarslide1.twig', array('valor' => $valor, 'slide1' => $slide1, 'slide3' => $slide3 ));
})->bind('despliegaslideeliminar1');



$app->match('/despliegaseleccionarslide1', function() use ($app) {
    $em = $app["orm.em"];
    $slide = $em->getRepository('Entity\Slide')->findOneBy(array('id' => $app['request']->get('id')));
    $valor=$slide->getUrl();
    $slide1=$slide;

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Slide');
    $slide3 = $urep->findall();

    return $app['twig']->render('seleccionarslide1.twig', array('valor' => $valor, 'slide1' => $slide1, 'slide3' => $slide3 ));
})->bind('despliegaseleccionarslide1');

/**
 * Perfil administrador: despliega la noticia a eliminar
 * @return  object ofertalaboral
 */
$app->match('/despliegaeliminaslide', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Slide');
    $slide = $urep->findall();

    return $app['twig']->render('eliminarslide.twig', array('slide' => $slide ));
})->bind('despliegaeliminaslide');


$app->match('/unacosa1', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Slide');
    $slide = $urep->findall();

    return $app['twig']->render('eliminarslide.twig', array('slide' => $slide ));
})->bind('unacosa1');

$app->match('/seleccion1', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Slide');
    $slide = $urep->findall();

    return $app['twig']->render('seleccionarslide.twig', array('slide' => $slide ));


})->bind('seleccion1');

/**
 * Perfil administrador: despliega la noticia a eliminar
 * @return  object ofertalaboral
 */
$app->post('/despliegaalbumeliminar', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album = $urep->findBy(array('id' => $app['request']->get('id')));

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album1 = $urep->findall();

    return $app['twig']->render('eliminaralbum1.twig', array('album' => $album, 'album1' => $album1 ));

})->bind('despliegaalbumeliminar');

$app->match('/eliminaralbum12', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Album');
    $album1 = $urep->findall();

    return $app['twig']->render('eliminaralbum.twig', array('album1' => $album1));
})->bind('eliminaralbum12');


$app->match('/eliminarusuarios12', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Usuario');
    $usuario = $urep->findall();

    return $app['twig']->render('eliminarusuarios.twig', array('usuario' => $usuario ));
})->bind('eliminarusuarios12');


/**
 * Perfil administrador: eliminar de la base de datos
 * @return  bool resultado
 */
$app->post('/eliminar_usuarios', function() use ($app) {
    $em = $app["orm.em"];
    $id= $app['request']->get('id');
    $usuario = $em->find('Entity\Usuario',$id);
    if($usuario!= null){
    $nombre= $usuario->getEmail();
    $resultado=true;
    }
    if($usuario!= null && $nombre!="admin"){
    $informacion=$usuario->getInformacion();
    $contacto=$usuario->getContacto();
    $em->remove($informacion);
    $em->remove($contacto);
    $em->remove($usuario);
    $em->flush();
    }else{
    $resultado=false;
    }

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Usuario');
    $usuario = $urep->findall();

    return $app['twig']->render('eliminarusuarios.twig', array('resultado' => $resultado,'usuario' => $usuario ));
})->bind('eliminar_usuarios');

/**
 * Perfil administrador: buscar oferta para su modificacion
 * @return  object ofertalaboral
 */
$app->post('/buscaoferta', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral = $urep->findBy(array('id' => $app['request']->get('id')));

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $oferta = $urep->findall();

    return $app['twig']->render('modificarofertalaboral1.twig', array('ofertalaboral' => $ofertalaboral, 'oferta' => $oferta ));
})->bind('despliegaoferta1');

/**
 * login para acceder a las cuentas de usuario o administrador
 */
$app->post('/login3', function () use ($app) {
    $username = $app['request']->get('username');
    $password = $app['request']->get('password');
    $idofer=$app['request']->get('idofer');
    $em = $app["orm.em"];
    $usuario1= $em->getRepository('Entity\Usuario')->findOneBy(array('email' => $app['request']->get('username')));
    if ( $usuario1->getEmail()== $username &&  crypt($password, $usuario1->getClave()) == $usuario1->getClave() ) {
        $app['session']->set('user', array('username' => $username));
        $app['session']->set('id', array('id' => $usuario1->getId()));
    }

    return $app->redirect($app['url_generator']->generate('ofertadesplegada', array('id' => $idofer)));
})->bind('login3');

/**
 * Perfil administrador: elimina una oferta laboral especifica
 * @return  bool resultado
 */
$app->post('/eliminar', function() use ($app) {
    $em = $app["orm.em"];
    $id= $app['request']->get('id');
    $oferta = $em->find('Entity\OfertaLaboral',$id);

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Postulacion');
    $postulaciones = $urep->findAll();

    if($postulaciones!=null){
        $arrlength=count($postulaciones);
        for($x=0;$x<$arrlength;$x++) {
            if($postulaciones[$x]->getOfertaLaboral()->getId()==$id){
                $em->remove($postulaciones[$x]);
            }
        }
        $em->flush();
    }
       $em->remove($oferta);
       $em->flush();
       $resultado=true;

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $oferta = $urep->findall();

    return $app['twig']->render('eliminarofertalaboral.twig', array('resultado' => $resultado, 'oferta' => $oferta));

})->bind('eliminar_item');

/**
 * Perfil administrador: Busca la lista de postulaciones de una oferta laboral, para luego mostrar los usuarios
 * @return  object postulacion
 */
$app->post('/usuariosdeofertapostulaciones', function () use ($app) {
    $em = $app["orm.em"];
    $ofertalaboral= $em->find('Entity\OfertaLaboral', $app['request']->get('id') );
  if($ofertalaboral!=null){
    $Postulacion=$ofertalaboral->getPostulaciones();
  }else{
    $Postulacion=null;
  }
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $oferta = $urep->findall();
    return $app['twig']->render('usuariosdeoferta.twig', array('Postulacion' =>  $Postulacion, 'oferta' => $oferta));
})->bind('usuariosdeofertapostulaciones');

/**
 *Nuevo registro donde se crea el usuario, guarda su datos de informacion y contacto
 */
$app->post('/guardarusuario', function() use($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Usuario');
    $usuario1 = $urep->findBy(array('email' => $app['request']->get('email')));
    $usuario2 = $urep->findBy(array('rut' => $app['request']->get('rut')));

    if($usuario2!=null){
        return $app['twig']->render('registrodeusuario.twig', array('mensaje2' => "El rut ya se encuentra registrado en el sistema"));
    }
    if($app['request']->get('clave')!=$app['request']->get('repclave')){
        return $app['twig']->render('registrodeusuario.twig', array('mensaje1' => "Las dos contraseñas ingresadas no coinciden"));
    }
    if($usuario1!=null){
    return $app['twig']->render('registrodeusuario.twig', array('mensaje' => "El correo electronico ya se encuentra registrado en el sistema"));
    }else{
    /* Crea la entidad Usuario*/
     $usuario = new \Entity\Usuario();
    /*Agrega los atributos de la entidad*/
     $usuario->setEmail($app['request']->get('email'));
     $usuario->setRut($app['request']->get('rut'));
     $password = $app['request']->get('clave');
     $cost = 10;
     $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
     $salt = sprintf("$2y$%02d$", $cost) . $salt;
     $hash = crypt($password, $salt);
     /*Guardo el hash del usuario*/
     $usuario->setClave($hash);
     /*Construccion de la informacion del usuario*/
     $em = $app["orm.em"];
     $informacion = new \Entity\Informacion();
     $informacion->setNombres($app['request']->get('nombres'));
     $informacion->setApellidopaterno( $app['request']->get('apellidopaterno'));
     $informacion->setApellidomaterno($app['request']->get('apellidomaterno'));
     $date = new DateTime($app['request']->get('fechanacimiento'));
     $informacion->setFechanacimiento($date);
     $informacion->setEstadocivil( $app['request']->get('estadocivil'));
     $informacion->setSexo($app['request']->get('sexo'));
     $informacion->setNacionalidad($app['request']->get('nacionalidad'));
     $informacion->setCurriculum("");
     /*Agrego la informacion del usuario*/
     $usuario->setInformacion($informacion);
     /*construccion del contacto del usuario*/
     $contacto = new \Entity\Contacto();
     $contacto->setCalle($app['request']->get('calle'));
     $contacto->setNumero( $app['request']->get('numero'));
     $contacto->setOtros($app['request']->get('otros'));
     $contacto->setComuna($app['request']->get('comuna'));
     $contacto->setEmail( $app['request']->get('email'));
     $contacto->setFono($app['request']->get('fono'));
     $contacto->setMovil($app['request']->get('movil'));
     /*Agrego el contacto al usuario*/
     $usuario->setContacto($contacto);
     $em->persist($contacto);
     /*Fuerzo el COMMIT a la BD.*/
     $em->persist($informacion);
     /*Hago persistir en usuario en el backend (o sea, la base de datos)*/
     $em->persist($usuario);
     /*Fuerzo el COMMIT a la BD.*/
     $em->flush();
     return $app->redirect($app['url_generator']->generate('bienvenida'));
    }

 })->bind('guardarusuario');

 /**
  * Perfil de usuario: modificar informacion y contacto según su id identificativo
  * @return  int id
  */
$app->post('/modificar_informacion_contacto', function() use ($app) {
    $em = $app["orm.em"];
    $id= $app['request']->get('id');
    $informacion = $em->find('Entity\Informacion',$id);
    $informacion->setNombres($app['request']->get('nombres'));
    $informacion->setApellidopaterno( $app['request']->get('apellidopaterno'));
    $informacion->setApellidomaterno($app['request']->get('apellidomaterno'));
    $date = new DateTime($app['request']->get('fechanacimiento'));
    $informacion->setFechanacimiento($date);
    $informacion->setEstadocivil( $app['request']->get('estadocivil'));
    $informacion->setSexo($app['request']->get('sexo'));
    $informacion->setNacionalidad($app['request']->get('nacionalidad'));
    $contacto = $em->find('Entity\Contacto', $app['request']->get('id'));
    $contacto->setCalle($app['request']->get('calle'));
    $contacto->setNumero( $app['request']->get('numero'));
    $contacto->setOtros($app['request']->get('otros'));
    $contacto->setComuna($app['request']->get('comuna'));
    $contacto->setEmail( $app['request']->get('email'));
    $contacto->setFono($app['request']->get('fono'));
    $contacto->setMovil($app['request']->get('movil'));
    $em->persist($informacion);
    $em->persist($contacto);
    $em->flush();
    return $app->redirect($app['url_generator']->generate('buscaperfilo2', array('id' => $id), array('resultado' => true)));
})->bind('modificar_informacion_contacto');

/**
 * Perfil usuario: subir documento a la plataforma
 * @return bool resultado
 */
$app->match('/sub', function () use ($app){
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
            /* configura el directorio sobre el cual escribir */
            $path = __DIR__.'/../web/upload/';
            $filename = $files['FileUpload']->getClientOriginalName();
            /*Cambiamos la variable del nombre */
           $em = $app["orm.em"];
           $id= $app['request']->get('id');
           $informacion = $em->find('Entity\Informacion',$id);
           $informacion->setCurriculum($filename);
           $em->persist($informacion);
           $em->flush();
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

/**
* Perfil usuario: Busca la lista de postulaciones de un usuario, para luego mostrar las ofertas
* @return  object postulacion
*/
$app->match('/postulacionesusuario/{id}/', function($id) use ($app){
    $em = $app["orm.em"];
    $usuario = $em->find('Entity\Usuario',$id );
    $Postulacion=$usuario->getPostulaciones();
    return $app['twig']->render('postulacionesUsuario.twig', array('Postulacion' => $Postulacion));
})->bind('postulacionesusuario');

/**
 * Perfil usuario: espliega la lista de mensajes en el perfil del usuario
 * @return  object mensajes
 */
$app->get('/mensajes', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Mensaje');
    $mensajes = $urep->findAll();
    return $app['twig']->render('mensajes.twig', array('mensajes' => $mensajes));
})->bind('mensajes');

/**
 * Bolsa de trabajo: Despliega uns oferta en particular seleccionada en la bolsa de trabajo
 *
 * @param int $id numero identificativo de la oferta laboral
 * @return  object OfertaLaboral
 */
$app->match('/ofertadesplegada/{id}', function ($id) use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral = $urep->findBy(array('id' => $id));
    return $app['twig']->render('ofertadesplegada.twig', array('ofertalaboral' => $ofertalaboral ));
})->bind('ofertadesplegada');

/**
 * Bolsa de trabajo: Busqueda particular por id o por fecha de ofertas laborales
 * @return  object ofertalaboral
 */


$app->post('/busqueda', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral=null;
    // id
    if( $app['request']->get('bus')=="" && $app['request']->get('fechapubli')=="" &&  $app['request']->get('id1')!=""){
        $ofertalaboral = $urep->findBy(array('id' => $app['request']->get('id1')));
    }
    // fecha
    if( $app['request']->get('bus')=="" && $app['request']->get('fechapubli')!="" &&  $app['request']->get('id1')==""){
        $date = new DateTime($app['request']->get('fechapubli'));
        date_format($date, 'Y-m-d ');

        $ofertalaboral = $urep->findBy(array('fecha_publicacion' => $date ));
        $date = new DateTime($app['request']->get('fechapubli'));
        $numero=date_format($date, 'Y-m-d ');
        $numero1=$numero."00:00";
        $numero2=$numero."99:99";
        $OfertaLaboral1 =  $urep->createQueryBuilder('p')
            ->where('p.fecha_publicacion BETWEEN :valor1 AND :valor2')
            ->setParameter('valor1', $numero1)
            ->setParameter('valor2', $numero2)
            ->getQuery();
        $ofertalaboral = $OfertaLaboral1 ->getResult();
    }
    // palabra
    if( $app['request']->get('bus')!="" && $app['request']->get('fechapubli')=="" &&  $app['request']->get('id1')==""){
        $dato = $app['request']->get('bus');
        $OfertaLaboral1 =  $urep->createQueryBuilder('p')
            ->where('p.descripcion LIKE :descripcion')
            ->setParameter('descripcion', '%'.$dato.'%')
            ->getQuery();
        $ofertalaboral = $OfertaLaboral1 ->getResult();
    }
    // palabra, fecha
    if( $app['request']->get('bus')!="" && $app['request']->get('fechapubli')!="" &&  $app['request']->get('id1')==""){
        $dato = $app['request']->get('bus');
        $date = new DateTime($app['request']->get('fechapubli'));
        $numero=date_format($date, 'Y-m-d ');
        $numero1=$numero."00:00";
        $numero2=$numero."99:99";
        $OfertaLaboral1 =  $urep->createQueryBuilder('p')
            ->where('p.descripcion LIKE :descripcion AND p.fecha_publicacion BETWEEN :valor1 AND :valor2')
            ->setParameter('descripcion', '%'.$dato.'%')
            ->setParameter('valor1', $numero1)
            ->setParameter('valor2', $numero2)
            ->getQuery();
        $ofertalaboral = $OfertaLaboral1 ->getResult();
    }
    //palabra, id
    if( $app['request']->get('bus')!="" && $app['request']->get('fechapubli')=="" &&  $app['request']->get('id1')!=""){
        $dato = $app['request']->get('bus');
        $id=$app['request']->get('id1');
        $OfertaLaboral1 =  $urep->createQueryBuilder('p')
            ->where('p.descripcion LIKE :descripcion AND p.id =:id1')
            ->setParameter('descripcion', '%'.$dato.'%')
            ->setParameter('id1', $id)
            ->getQuery();
        $ofertalaboral = $OfertaLaboral1 ->getResult();
    }
    //id, fecha
    if( $app['request']->get('bus')=="" && $app['request']->get('fechapubli')!="" &&  $app['request']->get('id1')!=""){
        $id1=$app['request']->get('id1');
        $date = new DateTime($app['request']->get('fechapubli'));
        $numero=date_format($date, 'Y-m-d ');
        $numero1=$numero."00:00";
        $numero2=$numero."99:99";

        $OfertaLaboral1 =  $urep->createQueryBuilder('p')
            ->where('p.id =:id1 AND p.fecha_publicacion BETWEEN :valor1 AND :valor2')
            ->setParameter('valor1', $numero1)
            ->setParameter('valor2', $numero2)
            ->setParameter('id1', $id1)
            ->getQuery();
        $ofertalaboral = $OfertaLaboral1 ->getResult();
    }
    //palabra, id, fecha
    if( $app['request']->get('bus')!="" && $app['request']->get('fechapubli')!="" &&  $app['request']->get('id1')!=""){
        $dato = $app['request']->get('bus');
        $id1=$app['request']->get('id1');
        $date = new DateTime($app['request']->get('fechapubli'));
        $numero=date_format($date, 'Y-m-d ');
        $numero1=$numero."00:00";
        $numero2=$numero."99:99";
        $OfertaLaboral1 =  $urep->createQueryBuilder('p')
            ->where('p.descripcion LIKE :descripcion AND p.id =:id1 AND p.fecha_publicacion BETWEEN :valor1 AND :valor2' )
            ->setParameter('descripcion', '%'.$dato.'%')
            ->setParameter('valor1', $numero1)
            ->setParameter('valor2', $numero2)
            ->setParameter('id1', $id1)
            ->getQuery();
             $ofertalaboral = $OfertaLaboral1 ->getResult();
    }
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' => $ofertalaboral));
})->bind('busqueda');

/**
 * Busca las ofertas laborales y las ordena de forma ascendente segun la fecha de publicacion.
 * @return  object ofertalaboral
 */
$app->get('/ordenarfecha', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $OfertaLaboral1 =  $urep->createQueryBuilder('p')
        ->orderBy('p.fecha_publicacion','ASC')
        ->getQuery();
    $ofertalaboral = $OfertaLaboral1 ->getResult();
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' =>  $ofertalaboral));
})->bind('ordenarfecha');

/**
 * Busca las ofertas laborales y las ordena de forma descendente según la fecha de publicación.
 * @return  object ofertalaboral
 */
$app->get('/ordenarfecha1', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $OfertaLaboral1 =  $urep->createQueryBuilder('p')
        ->orderBy('p.fecha_publicacion','DESC')
        ->getQuery();
    $ofertalaboral = $OfertaLaboral1 ->getResult();
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' =>  $ofertalaboral));
})->bind('ordenarfecha1');

/**
 * Busca las ofertas laborales y las ordena de forma ascendente según el id
 * @return  object ofertalaboral
 */
$app->get('/ordenarid', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $OfertaLaboral1 =  $urep->createQueryBuilder('p')
        ->orderBy('p.id','ASC')
        ->getQuery();
    $ofertalaboral = $OfertaLaboral1 ->getResult();
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' =>  $ofertalaboral));
})->bind('ordenarid');

/**
 * Busca las ofertas laborales y las ordena de forma ascendente según el id
 * @return  object ofertalaboral
 */
$app->get('/ordenarid1', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $OfertaLaboral1 =  $urep->createQueryBuilder('p')
        ->orderBy('p.id','DESC')
        ->getQuery();
    $ofertalaboral = $OfertaLaboral1 ->getResult();
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' =>  $ofertalaboral));
})->bind('ordenarid1');

/**
 *  despliega datos de curriculum del usuario. Informacion y contacto
 *  @return  object usuario
 */
$app->match('/buscaperfilo/{id}', function($id) use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Usuario');
    $usuario = $urep->findBy(array('id' => $id));
    return $app['twig']->render('micv.twig', array('usuario' => $usuario));
})->bind('buscaperfilo');

/**
 * despliega datos de usuaario para su modificacion
 * @return  object usuario
 */
$app->match('/buscaperfilo2/{id}', function($id) use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Usuario');
    $usuario = $urep->findBy(array('id' => $id));
    return $app['twig']->render('actualizarcv.twig', array('usuario' => $usuario));
})->bind('buscaperfilo2');


/**
 * despliega datos de usuaario para su modificacion
 * @return  object usuario
 */
$app->match('/registronoticias/', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Noticia');
    $noti =  $urep->createQueryBuilder('p')
        ->orderBy('p.id','DESC')
        ->getQuery();
    $noticia = $noti ->getResult();
    
    return $app['twig']->render('registronoticias.twig', array('noticia' => $noticia));
})->bind('registronoticias');


/**
 * despliega datos de usuaario para su modificacion
 * @return  object usuario
 */
$app->match('/inicio', function() use ($app) {

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Noticia');
    $noti =  $urep->createQueryBuilder('p')
        ->orderBy('p.id','DESC')
        ->getQuery();
    $noticia = $noti ->getResult();

    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Slide');
    $slide = $urep->findall();
    $valor=0;

    $em = $app["orm.em"];
    $slide1= $em->getRepository('Entity\Slide')->findOneBy(array('portada' => "si"));
    $direccion = $slide1->getUrl();

    //antes de borrar el slide se debe preguntar. si es el principal.

    return $app['twig']->render('inicio.twig', array('noticia' => $noticia, 'slide' => $slide, 'valor' => $valor, 'direccion' => $direccion ));

})->bind('inicio');


/**
 * ingresa la postulacion y sus correspondientes conexiones con las ofertas laborales y usuario
 * @return  int url ofertalaboral
 */
$app->post('/ingresarpostulacion', function() use($app) {

    $iduser=$app['request']->get('idusuario');
    $idofer=$app['request']->get('idoferta');
    $em = $app["orm.em"];
    $usuario = $em->find('Entity\Usuario',$iduser );
    $ofertalaboral = $em->find('Entity\OfertaLaboral',$idofer );
    $em = $app["orm.em"];
    $postu=$usuario->getPostulaciones();
    $i=0;
    $resultado=false;
    while($postu[$i]!=null){
    $id1= $postu[$i]->getOfertaLaboral()->getId();
        if($id1==$idofer){
            $resultado=true;
        }
    $i++;
    }

    if($resultado==false){
    $postulacion = new \Entity\Postulacion();
    $postulacion->setExperiencia($app['request']->get('experiencia'));
    $postulacion->setNiveleducacional($app['request']->get('niveleducacional'));
    $postulacion->setPretensionrenta($app['request']->get('pretensionrenta'));
    $postulacion->setDisponibilidad($app['request']->get('disponibilidad'));

    $postulacion->setOfertaLaboral($ofertalaboral);
    $usuario->addPostulacione($postulacion);
    $em->persist($postulacion);
    $em->persist($ofertalaboral);
    $em->persist($usuario);
    $em->flush();

    $usuario = $em->find('Entity\Usuario',$iduser );
    $postulacion->setUsuario($usuario);
    $em->persist($postulacion);
    $em->flush();

    $ofertalaboral = $em->find('Entity\OfertaLaboral',$idofer );
    $ofertalaboral->addPostulacione($postulacion);
    $em->persist($ofertalaboral);
    $em->flush();
        return $app->redirect($app['url_generator']->generate('respuestapostulacion'));
    }else{
        return $app->redirect($app['url_generator']->generate('respuestapostulacion2'));
    }
})->bind('ingresarpostulacion');



/**
 * Bolsa de empleo: despliegue de todas las ofertas laborales en la bolsa
 * @return  object ofertalaboral
 */
$app->get('/ofertalaboral', function () use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\OfertaLaboral');
    $ofertalaboral = $urep->findAll();
    return $app['twig']->render('ofertalaboral.twig', array('ofertalaboral' => $ofertalaboral));
})->bind('ofertalaboral');


/**
 * envio de mail
 * @return  object response
 */
$app->post('/enviarmail', function() use ($app) {

    $nombre=$app['request']->get('nombre');
    $email=$app['request']->get('email');
    $telefono=$app['request']->get('telefono');
    $mensaje=$app['request']->get('Mensaje');

    $email_to = "fdc@damascolombianas.cl";
    $email_subject = "fdc@damascolombianas.cl";
    $email_message = "Detalles del formulario de contacto:\n\n";
    $email_message .= "Nombre: "."".$nombre."\n";
    $email_message .= "E-mail: "."".$email."\n";
    $email_message .= "Teléfono: "."".$telefono."\n";
    $email_message .= "Comentarios: " ."".$mensaje."\n\n";
    //Ahora se envía el e-mail usando la función mail() de PHP
    $headers = 'From: '.""."\r\n".
        'Reply-To: '.""."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    return $app->redirect($app['url_generator']->generate('informaciones'));

})->bind('enviarmail');

/**
 * Mnanda un correo alectronico a la direccion del usuario, enviando un link  con una url para la posterior modificacion
 * @return  int url resultado
 */
$app->post('/reenviarcontra', function() use ($app) {
    $em = $app["orm.em"];
    $urep = $em->getRepository('Entity\Usuario');
    $correo =$app['request']->get('correo');
    $usuario = $urep->findOneBy(array('email' => $correo));
    if ($usuario->getEmail() == $correo ) {
    /*$Dire="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];*/
    $Dire="/empleos/web/index_dev.php/cambiacontra/".$usuario->getId();
    $link="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$Dire;
    /*enviar mensaje con el $link*/
    @mail( "fdc@damascolombianas.cl", $correo, $link,"El siguiente link permite realizar el cambio a una nueva contraseña");
    }
    return $app['twig']->render('respuestaretornomail.twig');
})->bind('reenviarcontra');

/**
 * busca un usuario especifico y lo redireccion para su modificacion en la siguiente accion
 * @param int $id  codigo indentificativo de usuario
 * @return  object usuario
 */
$app->match('/cambiacontra/{id}/', function($id) use ($app){
    $em = $app["orm.em"];
    $usuario= $em->getRepository('Entity\Usuario')->findOneBy(array('id' => $id));
    // Mandar correo de usuario al mail
    return $app['twig']->render('cambiarcontrasenia.twig', array('usuario' => $usuario));
})->bind('cambiacontra');



$app->match('/cambiacontraadmin', function() use($app) {
    return $app['twig']->render('respuestapostulacion2.twig');
})->bind('cambiacontraadmin');

/**
 * busca un usuario especifico, crea una nueva clave codificadad con su hash respectivo y la cambia con la anterior en la base de datos
 */
$app->match('/setcontra/', function() use ($app){
    $em = $app["orm.em"];
    $usuario= $em->getRepository('Entity\Usuario')->findOneBy(array('id' => $app['request']->get('id')));
    $Npassword = $app['request']->get('Npassword');
    $cost = 10;
    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
    $salt = sprintf("$2y$%02d$", $cost) . $salt;
    $hash = crypt($Npassword, $salt);
    $usuario->setClave($hash);
    $em->persist($usuario);
    $em->flush();
    return $app['twig']->render('respuestamail.twig');

})->bind('setcontra');

/**
 * redireccion inicial a la pagina de ingreso de oferta laboral del administrador
 */
$app->match('/ingresarofertalaboral', function() use($app) {
    return $app['twig']->render('ingresarofertalaboral.twig');
})->bind('ingresarofertalaboral');

$app->match('/respuestapostulacion', function() use($app) {
    return $app['twig']->render('respuestapostulacion.twig');
})->bind('respuestapostulacion');

$app->match('/respuestapostulacion2', function() use($app) {
    return $app['twig']->render('respuestapostulacion2.twig');
})->bind('respuestapostulacion2');

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





