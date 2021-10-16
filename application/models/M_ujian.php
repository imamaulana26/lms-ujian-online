<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ujian extends CI_Model
{
	private $url_api = 'http://localhost/lms-rest-server/api/ujian';

	private function http_request($url, $param = null)
	{
		// persiapan curl
		$ch = curl_init();
		// set url
		curl_setopt($ch, CURLOPT_URL, $url . $param);
		// return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec($ch);

		curl_close($ch);

		return json_decode($output, true);
	}

	public function list_ujian($kelas)
	{
		$request = $this->http_request($this->url_api, $kelas);
		
		return $request;
	}
}
