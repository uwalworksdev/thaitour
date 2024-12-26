<?php

	class propertiesM {

		function getAuthUrl($idc_name)	{
            $url = "mobile.inicis.com/smart/payReq.ini";
			switch ($idc_name) {
				case 'fc':
                    $authUrl = "https://fc".$url;
					break;
				case 'ks':
					$authUrl = "https://ks".$url;
					break;
				case 'stg':
					$authUrl = "https://stg".$url;
					break;
				default:
					break;
			}			
			return $authUrl;
		}

	}

?>