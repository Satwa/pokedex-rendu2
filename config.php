<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	function queryPokeAPI($url){
		$cache = getCache($url);

		if($cache){
			$content = $cache;
		}else{
			$content = file_get_contents('https://pokeapi.co/api/v2/'.$url);
		}

		if($content === false){
			return false;
		}else{
			return json_decode($content);
		}
	}

	function writeCache($url, $content){
		file_put_contents('caches/'.str_replace('/', '-', $url), $content);
	}

	function getCache($url){
		if(file_exists('caches/'.str_replace('/', '-', $url)) && time() - filemtime('caches/'.str_replace('/', '-', $url)) < 24*60*60){
			// cache < 24hrs
			return file_get_contents('caches/'.str_replace('/', '-', $url));
		}else{
			return false;
		}
	}