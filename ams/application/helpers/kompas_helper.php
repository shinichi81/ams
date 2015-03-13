<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

function instance() {
      $ci = & get_instance();
      return $ci;
}

function get_menu($key) {
      return instance()->kompas->getMenu($key);
}

function get_submenu($arrSubmenu, $key) {
      return instance()->kompas->getSubmenu($arrSubmenu, $key);
}

function get_access($menu) {
      $data["create"] = "N";
      $data["read"] = "N";
      $data["update"] = "N";
      $data["delete"] = "N";
      $data["progress"] = "N";

      $access = instance()->session->userdata("access");
      if (isset($access[$menu])) {
            $access = $access[$menu];

            $data["create"] = (string) $access["create"];
            $data["read"] = (string) $access["read"];
            $data["update"] = (string) $access["update"];
            $data["delete"] = (string) $access["delete"];
            $data["progress"] = (string) $access["progress"];
      }

      return $data;
}

function auth($access) {
      // jika tidak diijinkan mengakses menu ini, redirect ke dashboard
      $array = array_count_values($access);
      if (!isset($array["Y"]))
            redirect("dashboard", "refresh");

      return true;
}

function error_message($errNo) {
      $message = "Terjadi error. Kode error : " . $errNo . ".<br>Hubungi Administrator Anda!";

      return $message;
}

function check_session() {
      // jika session habis, redirect ke logout
      $username = instance()->session->userdata("username");

      if (empty($username))
            redirect("login/logout", "refresh");

      return true;
}

function get_date_range($strDateFrom, $strDateTo) {
      if (empty($strDateFrom) or empty($strDateTo))
            return FALSE;

      $aryRange = array();

      $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
      $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

      if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry

            while ($iDateFrom < $iDateTo) {
                  $iDateFrom+=86400; // add 24 hours
                  array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
      }
      
      return $aryRange;
}