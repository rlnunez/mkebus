<?php
	class MKEBus {
		private static $_apikey = "Your Key Here";
		private static $_apiver = "v2/";
		private static $_apiformat = "format=json";
		private static $_baseurl = "http://realtime.ridemcts.com/bustime/api/";

		public function gettime(){
			return $this->_gettime();
		}

		public function getroutes(){
			return $this->_getroutes();
		}

		public function getvehicles($vid){
			$vehicle = $this->_getvehicles($vid);
			return $vehicle['bustime-response']['vehicle'][0];
		}

		public function getpatterns($pid){
			$pattern = $this->_getpatterns($pid);
			return $pattern["bustime-response"]['ptr'][0];
		}

		public function getdir($rt){
			$dir = $this->_getdir($rt);
			return $dir["bustime-response"]['directions'];
		}

		public function getpredictions ($stpid, $rt) {
			$rtpredict = $this->_getpredictions($stpid, $rt);
			$curtime = $this->_gettime();
			$result = array_merge($rtpredict['bustime-response'],$curtime['bustime-response']);
			$rtservice = $this->_getservicebulletins($stpid, $rt);
			if(!isset($rtservice['bustime-response']['error'])){
				$result = array_merge($result, $rtservice['bustime-response']);
			}
			
			return $result;
		}

		public function getstops($rt, $dir){
			$stops = $this->_getstops($rt, $dir);
			$stops = $stops['bustime-response']['stops'];
			return $stops;
		}

		private function _getstops($rt, $dir){
			$params = array('rt' => "$rt", 'dir' => "$dir");
			return $this->_buildurl('getstops', $params);
		}

		private function _getvehicles($vid){
			$params = array('vid' => "$vid");
			return $this->_buildurl('getvehicles', $params);
		}

		private function _getpatterns($pid){
			$params = array('pid' => "$pid");
			return $this->_buildurl('getpatterns', $params);
		}

		private function _getdir($rt){
			$params = array('rt' => "$rt");
			return $this->_buildurl('getdirections', $params);
		}

		private function _getservicebulletins($stpid = '', $rt =''){
			$params = array('stpid' => "$stpid", 'rt' => "$rt");
			return $this->_buildurl('getservicebulletins',$params);
		}

		private function _getpredictions($stpid, $rt){
			$params = array('stpid' => "$stpid", 'rt' => "$rt");
			return $this->_buildurl('getpredictions',$params);
		}

		private function _gettime(){
			return $this->_buildurl('gettime');
		}

		private function _getroutes(){
			return $this->_buildurl('getroutes');
		}

		private function _buildurl($callfunct, $params = array()){
			$apikey = self::$_apikey;
			$baseurl = self::$_baseurl;
			$apiver = self::$_apiver;
			$apiformat = self::$_apiformat;

			$callurl = $baseurl . $apiver . $callfunct . '?key=' . $apikey . '&' . $apiformat;

			if(is_array($params)){
				foreach ($params as $k => $v) {
					if ($v != ""){
						$callurl = $callurl . '&' . $k . '=' . $v;
					}
				}
			}
			$response = file_get_contents($callurl);
			$response = json_decode($response, TRUE);

			return $response;
		}

	}

?>