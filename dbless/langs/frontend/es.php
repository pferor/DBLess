<?php
/**
 * @file es.php
 *
 * @brief Spanish language file
 */


/* Información de este archivo de idioma */
$LangCharset = 'utf-8';
$LangTextDir = 'ltr';


/* Navegación del sitio */
$Navigation = array(
                    'Home_text'           => 'Inicio',
                    'Home_title'          => 'Página principal',
                    'Archive_text'        => 'Archivo',
                    'Archive_title'       => 'Archivo de entradas',
                    'About_text'          => 'Acerca de...',
                    'About_title'         => 'Acerca de',
                    'Contact_text'        => 'Contacta',
                    'Contact_title'       => 'Formulario de contacto',
                    'Syndication_text'    => 'Redifusión',
                    'Syndication_title'   => 'Redifusión RSS',
                    'Join_text'           => 'Crear cuenta',
                    'Join_title'          => 'Crea una nueva cuenta',
                    'Login_text'          => 'Acceder',
                    'Login_title'         => 'Acceso al sistema',
                    'Profile_text'        => 'Preferencias',
                    'Profile_title'       => 'Preferencias de usuario',
                    'Logout_text'         => 'Salir',
                    'Logout_title'        => 'Cerrar sesión',
                    'SearchResults_text'  => 'Resultados de filtrado',
                    'TagsResults_text'    => 'Coincidencias en etiqueta',
                    'BackendLink_text'    => 'Administración',
                    'BackendLink_title'   => 'Administrar el sitio'
                    );

/* Información en formularios */
$FormsInfo = array(
                   'LostPassword_info'    => 'Todos los campos son obligatorios excepto la contraseña para solicitar una nueva.',
                   'LostPassword_warning' => 'Es necesario haber indicado una dirección de correo electrónico para restablecer la contraseña.',
                   'Logout_info'          => 'Para terminar esta sesión y desconectarse de este sitio haz clic en el botón «Cerrar sessión».',
                   'Logout_warning'       => '',
                   'Logout_OK'            => 'Se ha cerrado las sesión. Es recomendable cerrar el navegador y eliminar las <em>cookies</em> para finalizar por completo esta sesión.',
                   'Login_info'           => 'Este formulario te permite ingresar con tu usuario y contraseña. Si todavía no tienes una cuenta, antes debes crear una nueva. Este formulario distingue mayúsculas de minúsculas.',
                   'Login_warning'        => 'Es necesario tener permitido el uso de <em>cookies</em> para poder acceder.',
                   'LoginToRegister_link' => '¿No tienes cuenta? Crea una nueva.',
                   'RegisterToLogin_link' => '¿Ya tienes cuenta? Inicia sesión.',
                   'Register_info'        => 'La dirección de correo electrónico es opcional, pero es necesaria para recuperar la contraseña en caso de pérdida y olvido. Este formulario distingue mayúsculas de minúsculas.',
                   'Register_warning'     => 'Los nombres de usuario insultantes, promocionales, deliberadamente confusos o difamatorios pueden ser bloqueados de forma permanente.',
                   'Contact_info'         => 'La dirección de correo electrónico es opcional, pero es necesaria si se espera una respuesta.',
                   'Contact_warning'      => '',
                   'Profile_info'         => 'Información básica:',
                   'Profile_warning'      => 'Es necesario introducir la contraseña para confirmar la identidad y evitar abusos.',
                   'ProfilePass_info'     => 'Cambio de la contraseña de la cuenta:',
                   'ProfilePass_warning'  => '',
                   'NoCommentsYet_info'   => 'No hay comentarios para esta entrada,... aún.',
                   'Comments_info'        => '',
                   'Comments_warning'     => 'Es necesario estar registrado para poder comentar.'
                   );


/* Navegación de entradas */
$Post = array(
              'Older_text'  => 'Entradas antiguas',
              'Older_title' => 'Entradas antiguas',
              'Newer_text'  => 'Entradas recientes',
              'Newer_title' => 'Entradas recientes',
              'More_text'   => 'Más',
              'More_title'  => 'Más',
              'Tags_text'   => 'Etiquetas',
              'Tags_title'  => 'Etiquetas'
              );


/* Archivo de entradas */
$Results = array(
                 'Title_text'       => 'Título',
                 'Description_text' => 'Descripción',
                 'DateTime_text'    => 'Fecha y hora',
                 'Author_text'      => 'Autor'
                 );


/* Formularios */
$Form = array(
              'Name_text'          => 'Nombre',
              'Name_title'         => 'Nombre de usuario',
              'Email_text'         => 'Correo electrónico',
              'Email_title'        => 'Correo electrónico',
              'Message_text'       => 'Texto',
              'Message_title'      => 'Texto a enviar',
              'Captcha_text'       => 'Código',
              'Captcha_title'      => 'Código',
              'PasswordLost_text'  => 'Enviar una nueva contraseña',
              'PasswordLost_title' => 'Contraseña olvidada. Enviar una nueva contraseña por correo electrónico',
              'Password_text'      => 'Contraseña',
              'Password_title'     => 'Contraseña',
              'Password0_text'     => 'Contraseña actual',
              'Password0_title'    => 'Contraseña actual',
              'Password1_text'     => 'Contraseña nueva',
              'Password1_title'    => 'Contraseña nueva',
              'Password2_text'     => 'Contraseña de nuevo',
              'Password2_title'    => 'Contraseña de nuevo',
              'Submit_text'        => 'Enviar',
              'Submit_title'       => 'Enviar',
              'Search_text'        => 'Filtrar',
              'Search_title'       => 'Filtro de entradas',
              'Lang_text'          => 'Idioma preferido',
              'Lang_title'         => 'Idioma en el que se mostrará el sitio siempre para este usuario',
              'Skin_text'          => 'Estilo preferido',
              'Skin_title'         => 'Estilo en el que se mostrará el sitio siempre para este usuario',
              'Comment_text'       => 'Comentario',
              'Comment_title'      => 'Comentario a enviar',
              'Anonymous_text'     => 'Anónimo',
              'Delete_text'        => 'Eliminar',
              'Delete_title'       => 'Eliminar'
              );


/* Página «Acerca de...» */
$About = array(
               'Content' => '<p>Todo acerca de About...</p>'
               );


/* Enlaces de validación */
$Validation = array(
                    'Valid_XHTML' => 'XHTML válido',
                    'Valid_CSS'   => 'CSS válida',
                    'Valid_RSS'   => 'RSS válido',
                    'Valid_WCAG'  => 'Nivel de conformidad AA'
                    );


/* Mensajes de error */
$Messages = array(
                  'Cannot_Perform_err'         => 'Error. Contacta con el administrador.',
                  'Message_Sent_err'           => 'Error al enviar el mensaje. Inténtalo de nuevo tras unos minutos.',
                  'Message_Sent_suc'           => 'El mensaje ha sido enviado correctamente.',
                  'Account_Created_suc'        => 'Cuenta creada con éxito. Inicia sesión.',
                  'Message_Sent_suc'           => 'El mensaje ha sido enviado con éxito',
                  'Int_NotFound_err'           => 'La página a la que intenta acceder no existe.',
                  'NoPosts_err'                => 'No hay entradas.',
                  'NoSearch_err'               => 'No hay resultados que cumplan los criterios de filtrado.',
                  'NoTag_err'                  => 'No hay entradas para esta etiqueta.',
                  'Bad_Captcha_err'            => 'Falta el código de confirmación o es incorrecto.',
                  'Bad_Username_err'           => 'El usuario indicado no existe. Contacta con el administrador.',
                  'No_Email_err'               => 'No hay asociada ninguna dirección de correo electrónico para este usuario.',
                  'Blank_Username_err'         => 'No se ha especificado un nombre de usuario válido.',
                  'Taken_Username_err'         => 'El nombre de usuario introducido ya existe. Por favor, elige un nombre diferente.',
                  'Bad_Password_err'           => 'La contraseña no es correcta.',
                  'Blank_Password_err'         => 'No has escrito la contraseña, inténtalo de nuevo.',
                  'Short_Password_err'         => 'Las contraseñas deben tener al menos 1 carácter.',
                  'PasswordIsName_err'         => 'La contraseña debe ser diferente del nombre de usuario.',
                  'Match_Password_err'         => 'Las contraseñas no coinciden.',
                  'Bad_Login_err'              => 'Error en uno o ambos campos. Por favor, inténtalo de nuevo.',
                  'Corrupt_File_err'           => 'Cuenta de usuario corrupta. Contacta con el administrador.',
                  'Bad_Email_err'              => 'La dirección electrónica no puede ser aceptada ya que tiene un formato incorrecto. Escribe una dirección bien formada o vacía el campo.',
                  'Blank_Text_err'             => 'No has escrito el mensaje a enviar, inténtalo de nuevo.',
                  'Blank_Comment_err'          => 'No has escrito ningún mensaje, inténtalo de nuevo.',
                  'Login_Cannot_err'           => 'La sesión ya ha sido iniciada. Para entrar en el sistema como otro usuario antes es necesario cerrar la sesión.',
                  'Profile_Cannot_err'         => 'No se ha iniciado la sesión.',
                  'Comment_Cannot_err'         => 'Has de estar registrado para poder comentar.',
                  'Comment_Closed_err'         => 'Esta entrada está cerrada a comentarios.',
                  'Comment_Sent_suc'           => 'El comentario ha sido añadido.',
                  'Comment_Sent2_suc'          => 'El comentario será añadido tras su moderación.',
                  'Comment_Deleted_suc'        => 'El comentario ha sido eliminado.',
                  'Comment_Delete_Cannot_err'  => 'No se pude borrar el comentario. Inténtalomás tarde.',
                  'Profile_Updated_suc'        => 'Preferencias guardadas satisfactoriamente.',
                  'Password_New_suc'           => 'La contraseña ha sido modificada.',
                  'NoCookies_err'              => 'Las <em>cookies</em> no están permitidas. Actívalas e inténtalo de nuevo.'
                  );

/* Algunos campos del correo electrónico para la recuperación de la
 * contraseña */
$LostPassword = array(
                      'Subject_text' => 'Recuperación de la contraseña.',
                      'Body_text'    => 'Tu nueva contraseña es: '
                      );

