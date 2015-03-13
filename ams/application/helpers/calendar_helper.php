<?php

function ina_day($string_date) {
      if (empty($string_date) or $string_date == '0000-00-00')
            return '-';

      $day = array(
          "0" => "Minggu",
          "1" => "Senin",
          "2" => "Selasa",
          "3" => "Rabu",
          "4" => "Kamis",
          "5" => "Jumat",
          "6" => "Sabtu"
      );

      $split = explode("-", $string_date, 3);
      $result = $day[date("w", mktime(0, 0, 0, $split[1], $split[2], $split[0]))];

      return $result;
}

function ina_date($string_date) {
      if (empty($string_date) or $string_date == '0000-00-00')
            return '-';

      $month = array(
          "01" => "Januari",
          "02" => "Februari",
          "03" => "Maret",
          "04" => "April",
          "05" => "Mei",
          "06" => "Juni",
          "07" => "Juli",
          "08" => "Agustus",
          "09" => "September",
          "10" => "Oktober",
          "11" => "November",
          "12" => "Desember"
      );

      $split = explode("-", $string_date, 3);
      $res = $split[2] . " " . $month[$split[1]] . " " . $split[0];

      return $res;
}

function eng_date($string_date) {
      if (empty($string_date) or $string_date == '0000-00-00')
            return '-';

      $month = array(
          "01" => "January",
          "02" => "February",
          "03" => "March",
          "04" => "April",
          "05" => "May",
          "06" => "June",
          "07" => "July",
          "08" => "August",
          "09" => "September",
          "10" => "October",
          "11" => "November",
          "12" => "December"
      );

      $split = explode("-", $string_date, 3);
      $res = $month[$split[1]] . " " . $split[2] . ", " . $split[0];

      return $res;
}

function ina_dateSlash($string_date) {
      if (empty($string_date) or $string_date == '0000-00-00')
            return '-';

      $split = explode("-", $string_date, 3);
      $res = $split[2] . "/" . $split[1] . "/" . $split[0];

      return $res;
}

function inaDateNoTanggal($string_date) {
      if (empty($string_date) or $string_date == '0000-00-00')
            return '-';

      $month = array(
          "01" => "Januari",
          "02" => "Februari",
          "03" => "Maret",
          "04" => "April",
          "05" => "Mei",
          "06" => "Juni",
          "07" => "Juli",
          "08" => "Agustus",
          "09" => "September",
          "10" => "Oktober",
          "11" => "November",
          "12" => "Desember"
      );

      $split = explode("-", $string_date, 3);
      $res = $month[$split[1]] . " " . $split[0];

      return $res;
}

function ina_month($month) {
      $arrMonth = array(
          "01" => "Januari",
          "02" => "Februari",
          "03" => "Maret",
          "04" => "April",
          "05" => "Mei",
          "06" => "Juni",
          "07" => "Juli",
          "08" => "Agustus",
          "09" => "September",
          "10" => "Oktober",
          "11" => "November",
          "12" => "Desember"
      );

      $result = $arrMonth[$month];
      return $result;
}

function format_date($date, $noTime = FALSE) {
      $arrDate = explode(' ', $date);

      if ($noTime)
            $result = (!empty($date)) ? ina_date($arrDate[0]) : "-";
      else
            $result = (!empty($date)) ? ina_date($arrDate[0]) . '<br>' . substr($arrDate[1], 0, -3) . ' WIB' : "-";

      return $result;
}

function format_date_timeline($strdate) {
      return date('M j Y H:i:s', strtotime($strdate)) . ' GMT';
}