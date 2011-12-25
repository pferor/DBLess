<?php
/**
 * @file es.php
 *
 * @brief Spanish language file
 */


/* Información de este archivo de idioma */
$LangCharset = 'utf-8';
$LangTextDir = 'ltr';


/* Acciones */
$Actions = array(
                 'Admit_text'        => 'Admitir',
                 'Admit_title'       => 'Admitir',
                 'Cancel_text'       => 'Cancelar',
                 'Cancel_title'      => 'Cancelar',
                 'Delete_text'       => 'Eliminar',
                 'Delete_title'      => 'Eliminar',
                 'KillComment_text'  => '¿Eliminar definitivamente este comentario sin moderar?',
                 'KillComment_title' => '¿Eliminar definitivamente este comentario sin moderar?',
                 'KillPost_text'     => '¿Eliminar esta entrada definitivamente junto con sus comentarios?',
                 'KillPost_title'    => '¿Eliminar esta entrada definitivamente junto con sus comentarios, de forma permanete e irreversible sin que de ningún modo puedan ser recuperados?',
                 'KillUser_text'     => '¿Eliminar este usuario definitivamente?',
                 'KillUser_title'    => '¿Eliminar este usuario definitivamente?',
                 'NewPost_text'      => 'Añadir nueva entrada',
                 'NewPost_title'     => 'Crea una nueva entrada',
                 'Reject_text'       => 'Descartar',
                 'Reject_title'      => 'Descartar',
                 'Save_text'         => 'Guardar',
                 'Save_title'        => 'Guardar',
                 'Search_text'       => 'Filtrar',
                 'Search_title'      => 'Filtro de entradas',
                 'Submit_text'       => 'Enviar',
                 'Submit_title'      => 'Enviar'
                 );

/* Formularios */
$Form = array(
              'Author_text'             => 'Autor',
              'ClosedPost_text'         => 'Comentarios permitidos',
              'Email_text'              => 'Correo electrónico',
              'Email_title'             => 'Correo electrónico',
              'LicenseInfo_field'       => 'Licencia',
              'LicenseName_text'        => 'Nombre',
              'LicenseDescription_text' => 'Descripción',
              'LicenseURI_text'         => 'Enlace',
              'LockComments_text'       => 'Comentarios',
              'Post_text'               => 'Contenido',
              'SiteInfo_field'          => 'Nombre del sitio',
              'SiteName_text'           => 'Nombre',
              'SiteDescription_text'    => 'Descripción',
              'SiteTip_text'            => 'Texto informativo',
              'Summary_text'            => 'Descripción',
              'Tags_text'               => 'Etiquetas',
              'Timestamp_text'          => 'Hora y fecha',
              'Title_text'              => 'Título'
              );


/* Información en formularios */
$FormsInfo = array(
                   'Content_info'         => 'Recuerda utilizar el delimitador',
                   'KillComment_info'     => '',
                   'KillComment_warning'  => 'La eliminación de comentarios sin modearar es irreversible.',
                   'KillPost_info'        => '',
                   'KillPost_warning'     => 'La eliminación de entradas es irreversible y afecta también a sus comentarios.',
                   'KillUser_info'        => '',
                   'KillUser_warning'     => 'La eliminación de usuarios es irreversible aunque no afecta a los comentarios efectuados.',
                   'Logout_info'          => 'Para terminar esta sesión y desconectarse de este sitio haz clic en el botón «Cerrar sesión».',
                   'Logout_warning'       => '',
                   'Tags_info'            => 'Introduce las etiquetas separadas por comas',
                   'TimestampFormat_info' => 'yyyy-mm-dd HH:MM:SS'
                   );


/* Mesajes */
$Messages = array(
                  'BlankSitename_err'                 => 'El sitio debe tener un nombre.',
                  'CommentAdmitted_suc'               => 'El comentario ha sido admitido.',
                  'CommentRejected_suc'               => 'El comentario ha sido eliminado.',
                  'CommentsModerationOff_err'         => 'La moderación de comentarios está desactivada.',
                  'KillCommentsCannot_err'            => 'La entrada ha sido eliminada, pero los comentarios no se han podido borrar. Es necesario borrarlos manualmente.',
                  'KillPostCannot_err'                => 'No se ha podido eliminar la entrada.',
                  'KillUnmoderatedCommentCannot_err'  => 'No se ha podido eliminar el comentario.',
                  'KillUserCannot_err'                => 'No se ha podido eliminar el usuario.',
                  'NoCommentsModeration_err'          => 'No hay comentarios que moderar.',
                  'NoUsers_err'                       => 'No hay usuarios regulares.',
                  'PostDoesntExist_err'               => 'La entrada especificada no existe.',
                  'PostKilled_suc'                    => 'La entrada se ha eliminado con éxito.',
                  'PostSaved_suc'                     => 'La entrada se ha guardado con éxito.',
                  'PostCannotSave_err'                => 'No se ha podido guardar la entrada.',
                  'PostBadlySaved_suc'                => 'La entrada ha sido guardada pero ha habido problemas renombrando el directorio de comentarios.',
                  'SaveSiteInfo_suc'                  => 'Los cambios se han cambido con éxito.',
                  'SaveSiteInfoCannot_err'            => 'Los cambios no se han guardado.',
                  'UnmoderatedCommentDoesntExist_err' => 'El comentario no existe.',
                  'UserDoesntExist_err'               => 'El usuario especificado no existe.',
                  'UserKilled_suc'                    => 'El usuario se ha eliminado con éxito.'
                  );


/* Menús y títulos principales */
$Navigation = array(
                    'Admin_text'         => 'Administración',
                    'Admin_title'        => 'Administración',
                    'Comments_text'      => 'Comentarios',
                    'Comments_title'     => 'Moderación de comentarios',
                    'FrontendLink_text'  => 'Vista del sitio',
                    'FrontendLink_title' => 'Vista del sitio',
                    'Home_text'          => 'Inicio',
                    'Home_title'         => 'Página principal',
                    'KillPost_title'     => 'Eliminación permanente de entradas',
                    'KillUser_title'     => 'Eliminación permanente de usuarios',
                    'Logout_text'        => 'Salir',
                    'Logout_title'       => 'Cerrar sesión',
                    'Posts_text'         => 'Entradas',
                    'Posts_title'        => 'Gestión de entradas',
                    'SiteInfo_text'      => 'Sitio',
                    'SiteInfo_title'     => 'Información del sitio',
                    'Users_text'         => 'Usuarios',
                    'Users_title'        => 'Gestión de usuarios'
                    );


/* Archivo de entradas */
$Results = array(
                 'Action_text'      => 'Acción',
                 'Author_text'      => 'Autor',
                 'Comment_text'     => 'Comentario',
                 'DateTime_text'    => 'Fecha y hora',
                 'Description_text' => 'Descripción',
                 'Email_text'       => 'Correo electrónico',
                 'Post_text'        => 'Entrada',
                 'SignUpDate_text'  => 'Fecha de inscripción',
                 'Title_text'       => 'Título',
                 'Username_text'    => 'Nombre de usuario'
                 );


