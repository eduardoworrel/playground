<?php

//define('SECONDS_IN_A_MINUTE', 60);
//define('SECONDS_IN_A_HOUR', 3600);
//define('SECONDS_IN_A_DAY', 86400);
//define('SECONDS_IN_A_WEEK', 604800);
//define('SECONDS_IN_A_MONTH', 2592000);
//define('SECONDS_IN_A_YEAR', 31536000);

/**
 * Get GET input
 *
 * @param String $key
 * @param mixed  $filter
 * @param bool   $fillWithEmptyString
 *
 * @return mixed
 */
function get($key = null, $filter = null, $fillWithEmptyString = false)
{
  if (!$key) {
    if (function_exists('filter_input_array')) {
      return $filter ? filter_input_array(INPUT_GET, $filter) : $_GET;
    } else {
      return $_GET;
    }
  }

  if (isset($_GET[$key])) {
    if (function_exists('filter_input')) {
      return $filter ? filter_input(INPUT_GET, $key, $filter) : $_GET[$key];
    } else {
      return $_GET[$key];
    }
  } else if ($fillWithEmptyString === true) {
    return '';
  }

  return null;
}

/**
 * Get POST input
 *
 * @param String $key
 * @param mixed  $filter
 * @param bool   $fillWithEmptyString
 *
 * @return mixed
 */
function post($key = null, $filter = null, $fillWithEmptyString = false)
{
  if (!$key) {
    if (function_exists('filter_input_array')) {
      return $filter ? filter_input_array(INPUT_POST, $filter) : $_POST;
    } else {
      return $_POST;
    }
  }

  if (isset($_POST[$key])) {
    if (function_exists('filter_input')) {
      return $filter ? filter_input(INPUT_POST, $key, $filter) : $_POST[$key];
    } else {
      return $_POST[$key];
    }
  } else if ($fillWithEmptyString === true) {
    return '';
  }

  return null;
}

/**
 * Get GET_POST input
 *
 * @param String $key
 * @param mixed  $filter
 * @param bool   $fillWithEmptyString
 *
 * @return mixed
 */
function get_post($key = null, $filter = null, $fillWithEmptyString = false)
{
  if (!isset($GLOBALS['_GET_POST'])) {
    $GLOBALS['_GET_POST'] = array_merge($_GET, $_POST);
  }

  if (!$key) {
    if (function_exists('filter_var_array')) {
      return $filter ? filter_var_array($GLOBALS['_GET_POST'], $filter) : $GLOBALS['_GET_POST'];
    } else {
      return $GLOBALS['_GET_POST'];
    }
  }

  if (isset($GLOBALS['_GET_POST'][$key])) {
    if (function_exists('filter_var')) {
      return $filter ? filter_var($GLOBALS['_GET_POST'][$key], $filter) : $GLOBALS['_GET_POST'][$key];
    } else {
      return $GLOBALS['_GET_POST'][$key];
    }
  } else if ($fillWithEmptyString === true) {
    return '';
  }

  return null;
}

/**
 * Get COOKIE input
 *
 * @param String $key
 * @param mixed  $filter
 * @param bool   $fillWithEmptyString
 *
 * @return mixed
 */
function cookie($key = null, $filter = null, $fillWithEmptyString = false)
{
  if (!$key) {
    if (function_exists('filter_input_array')) {
      return $filter ? filter_input_array(INPUT_COOKIE, $filter) : $_COOKIE;
    } else {
      return $_COOKIE;
    }
  }

  if (isset($_COOKIE[$key])) {
    if (function_exists('filter_input')) {
      return $filter ? filter_input(INPUT_COOKIE, $key, $filter) : $_COOKIE[$key];
    } else {
      return $_COOKIE[$key];
    }
  } else if ($fillWithEmptyString === true) {
    return '';
  }

  return null;
}

/**
 * Set COOKIE input
 *
 * time can be set in seconds
 *
 * @param String $key
 * @param Mixed  $value
 * @param Int    $time
 */
function set_cookie($key, $value, $time = SECONDS_IN_A_HOUR)
{
  setcookie($key, $value, time() + $time, "/");
}

/**
 * Delete COOKIE input
 *
 * @param String $key
 */
function delete_cookie($key)
{
  setcookie($key, null, time() - SECONDS_IN_A_HOUR, "/");
  unset($_COOKIE[$key]);
}

/**
 * Get a session variable.
 *
 * @param String $key
 * @param mixed  $filter
 * @param bool   $fillWithEmptyString
 *
 * @return mixed
 */
function session($key = null, $filter = null, $fillWithEmptyString = false)
{
  if (!$key) {
    if (function_exists('filter_var_array')) {
      return $filter ? filter_var_array($_SESSION, $filter) : $_SESSION;
    } else {
      return $_SESSION;
    }
  }

  if (isset($_SESSION[$key])) {
    if (function_exists('filter_var')) {
      return $filter ? filter_var($_SESSION[$key], $filter) : $_SESSION[$key];
    } else {
      return $_SESSION[$key];
    }
  } else if ($fillWithEmptyString === true) {
    return '';
  }

  return null;
}

/**
 * Set a session variable.
 *
 * @param String $key
 * @param mixed  $value
 */
function set_session($key, $value = '')
{
  if (isset($key)) {
    $_SESSION[$key] = $value;
  }
}