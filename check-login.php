add_filter('authenticate', 'check_mcmaster_login', 10, 1);


function check_mcmaster_login($user)
{

  $email = '';
  if (is_object($user)) :
    $email = $user->user_email;
    if ($user->roles[0] !== 'offcampus_user') :
      if (strpos($email, $mac) !== false) :

        wp_update_user(array('ID' => $user->ID, 'role' => 'offcampus_user'));

      endif;

    endif;

  else :
    $data = get_userdata($user);
    $email = $data->user_email;

    if ($data->roles[0] !== 'offcampus_user') :
      if (strpos($email, $mac) !== false) :

        wp_update_user(array('ID' => $user, 'role' => 'offcampus_user'));

      endif;

    endif;

  endif;

  $mac = "@mcmaster.ca";

  // check to see if @mcmaster.ca is in the email
  if ($user->roles[0] !== 'offcampus_user') :
    if (strpos($email, $mac) !== false) :

      wp_update_user(array('ID' => $user->ID, 'role' => 'offcampus_user'));

    endif;

  endif;

  return $user;
}
