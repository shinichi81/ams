<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class CI_Kompas {

      private $_instance;
      private $_menu = array();
      private $_menuHref = array();

      public function __construct() {
            $this->_instance = & get_instance();
      }

      private function _checkSubmenu($submenu) {
            $result = "";
            $arrSubmenu = $this->_instance->config->item("submenu");

            foreach ($arrSubmenu as $key => $value) {
                  if (array_key_exists($submenu, $value)) {
                        $result["menu_key"] = $key;
                        $result["submenu_name"] = $value[$submenu];
                  }
            }

            return $result;
      }

      public function getMenu($current) {
            $result = "";
            $arrMenu = $this->_instance->config->item("menu");
            $arrGlobalMenu = $this->_instance->config->item("global_menu");
            $arrHref = $this->_instance->config->item("href");

            $result .= "<div id='topmenu'>";
            $result .= "<ul>";
            foreach ($arrMenu as $key => $value) {
                  if (array_key_exists($key, $arrGlobalMenu) or in_array($key, $this->_menu)) {
                        if (array_key_exists($key, $arrGlobalMenu)) { // default link sesuai yang ada di config
                              $link = site_url($arrHref[$key]);
                        } else { // untuk mencari link eprtama pada menu
                              $index = array_search($key, $this->_menu);
                              $val = $this->_menuHref[$index];
                              $link = site_url($arrHref[$val]);
                        }

                        $class = ($current == $key) ? "class='current'" : "";
                        $result .= "<li " . $class . "><a href='" . $link . "'>" . $value . "</a></li> ";
                  }
            }
//            $result .= "<ol><a href='#'>Selamat datang, " . $this->_instance->session->userdata("name") . "</a></ol>";
            $result .= "</ul>";
            $result .= "</div>";

            return $result;
      }

      public function getSubmenu($arrSubmenu, $key) {
            $result = "";
            $arrHref = $this->_instance->config->item("href");

            $result .= "<div id='panel'>";
            $result .= "<ul>";
            foreach ($arrSubmenu as $submenu) {
                  $submenu = strtolower($submenu);
                  $check = $this->_checkSubmenu($submenu);
                  if (!empty($check)) {
                        if (!in_array($check["menu_key"], $this->_menu)) {
                              $this->_menu[] = $check["menu_key"];
                              $this->_menuHref[] = $submenu; // untuk menampung link pertama pada menu
                        }

                        if ($check["menu_key"] == $key)
                              $result .= "<li><a href='" . site_url($arrHref[$submenu]) . "'>" . $check["submenu_name"] . "</a></li> ";
                  }
            }
            $result .= "</ul>";
            $result .= "</div>";

            return $result;
      }

}