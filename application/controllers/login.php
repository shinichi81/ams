<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Login extends CI_Controller {
      /* Controller ini untuk menampilkan halaman login
       * Lokasi: ./application/controllers/Login.php 
       */

      public function __construct() {
            parent::__construct();
            $this->load->model("Login_Model");
      }

      public function index() {
            $data["isError"] = $this->session->flashdata("isError");

            $this->load->view("login/index", $data);
      }

      public function auth() {
            $username = $this->input->post("txtUsername");
            $password = md5($this->input->post("txtPassword"));

            $login = $this->Login_Model->auth($username, $password);

            // jika username dan password valid
            if (count($login) == 1) {
                  $arrSession = array();

                  $arrSession["username"] = $login->username;
                  $arrSession["name"] = $login->name;
                  $arrSession["menu"] = array();
                  $arrSession["access"] = array();

                  $allAccess = $this->Login_Model->getAccess($login->level_id);
                  $arrSession["access_data"] = $allAccess[0]->access_data;
                  foreach ($allAccess as $access) {
                        array_push($arrSession["menu"], $access->menu);
                        $arrSession["access"][$access->menu]["create"] = $access->create;
                        $arrSession["access"][$access->menu]["read"] = $access->read;
                        $arrSession["access"][$access->menu]["update"] = $access->update;
                        $arrSession["access"][$access->menu]["delete"] = $access->delete;
                        $arrSession["access"][$access->menu]["progress"] = $access->progress;
                  }

                  $this->session->set_userdata($arrSession);
                  redirect("dashboard", "refresh");
            } else { // jika username dan password tidak valid
                  $this->session->set_flashdata("isError", true);
                  redirect("login", "refresh");
            }
      }

      public function logout() {
            $this->session->sess_destroy();
            redirect("login", "refresh");
      }

}