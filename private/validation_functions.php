<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // Function can be improved later to check for
    // more than just '@'.
    return strpos($value, '@') !== false;
  }

  //has_valid_username_characters('username')
  //can only contain A-Z, a-z, 0-9, and _
  function has_valid_username_characters($value) {
    if(preg_match('/[^A-Za-z0-9_]/', $value) === 1) {
      return false;
    }
    else {
      return true;
    }
  }

  //has_valid_phone('(111)-111-1111')
  //can only contain 0-9, -, and ()
  function has_valid_phone_characters($value) {
    if(preg_match('/[^0-9\(\)\-]/', $value) === 1) {
      return false;
    }
    else {
      return true;
    }
  }

  //has_valid_email_characters('email@gmail.com')
  //can only contain A-Z, a-z, 0-9, and @._-
  function has_valid_email_characters($value) {
    if(preg_match('/[^A-Za-z0-9@\._\-]/', $value) === 1) {
      return false;
    }
    else {
      return true;
    }
  }

  //My custom validation
  //num_only('1231')
  //for id, position, etc
  function num_only($value) {
    if(preg_match('/[^0-9]/', $value) === 1) {
      return false;
    }
    else {
      return true;
    }
  }

  //My custom validation
  //alpha_da_only('abc')
  //contains only alphabet chars plus dashes and apostrophes for country / state names
  function alpha_da_only($value) {
    if(preg_match('/[^A-Za-z\'\-]/', $value) === 1) {
      return false;
    }
    else {
      return true;
    }
  }

  //My custom validation
  //unique_username('username')
  function unique_username($value) {
    if(user_exists($value['id'], $value['username']) === true) {
      return false;
    }
    else {
      return true;
    }
  }

  //My custom validation
  //unique_code('CD')
  function unique_code($value) {
    if(code_exists($value['id'], $value['code']) === true) {
      return false;
    }
    else {
      return true;
    }
  }

  //My custom validation
  //unique_position(['state_id' => 1, 'position' => 1])
  function unique_position($value) {
    if(position_exists($value['id'], $value['state_id'], $value['position']) === true) {
      return false;
    }
    else {
      return true;
    }
  }
?>
