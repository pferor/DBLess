<?php
/**
 * @file site_admin.php
 *
 * @brief Site administartors
 */

/* Array of administrators usernames. Case sensitive.
 *
 * All of the following users have the *same privileges*.
 *
 * IMPORTANT!
 *
 * Users must exist before being added to this array.
 *
 * Users here *must* exist. These names are prohibited for new users
 * to take. If there is the entry 'admin' in this array but there is
 * no user called 'admin' in the users folder, nobody can take that
 * name.
 */
$SITE_ADMINS_ARR =
  array(
        'admin',
        //'webmaster',
        );


/* Administrator E-amil. This is the E-mail where the contact form
 * delivers the messages.
 */
$SITE_CONTACT_EMAIL = 'webmaster@dbless.org';

