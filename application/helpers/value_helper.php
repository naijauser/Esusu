<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getStateCode'))
{
    function getStateCode($stateName)
    {
        switch ($stateName) {
			case 'Abia':
				return 'ABI';
			case 'Abuja':
				return 'ABJ';
			case 'Adamawa':
				return 'ADA';
			case 'Akwa Ibom':
				return 'AKW';
			case 'Anambra':
				return 'ANA';
			case 'Bauchi':
				return 'BAU';
			case 'Bayelsa':
				return 'BAY';
			case 'Benue':
				return 'BEN';
			case 'Borno':
				return 'BOR';
			case 'Cross River':
				return 'CRO';
			case 'Delta':
				return 'DEL';
			case 'Ebonyi':
				return 'EBO';
			case 'Enugu':
				return 'ENU';
			case 'Edo':
				return 'EDO';
			case 'Ekiti':
				return 'BAY';
			case 'Gombe':
				return 'GOM';
			case 'Imo':
				return 'IMO';
			case 'Jigawa':
				return 'JIG';
			case 'Kaduna':
				return 'KAD';
			case 'Kano':
				return 'KAN';
			case 'Katsina':
				return 'KAT';
			case 'Kebbi':
				return 'KEB';
			case 'Kogi':
				return 'KOG';
			case 'Kwara':
				return 'KWA';
			case 'Lagos':
				return 'LAG';
			case 'Nasarawa':
				return 'NAS';
			case 'Niger':
				return 'NIG';
			case 'Ogun':
				return 'OGU';
			case 'Ondo':
				return 'OND';
			case 'Osun':
				return 'OSU';
			case 'Oyo':
				return 'OYO';
			case 'Plateau':
				return 'PLA';
			case 'Rivers':
				return 'RIV';
			case 'Sokoto':
				return 'SOK';
			case 'Taraba':
				return 'TAR';
			case 'Yobe':
				return 'YOB';
			case 'Zamfara':
				return 'ZAM';
			default:
				# code...
				break;
		}

    }   
}

if (! function_exists('getPackageCode')) {
	function getPackageCode ($package) {
		switch ($package) {
			case 1:
				return 'STA';
			case 2:
				return 'MIN';
			case 3:
				return 'BOL';
			case 4:
				return 'GOA';
			case 5:
				return 'BRO';
			case 6:
				return 'SIL';
			case 7:
				return 'GOL';
			default:
				# code...
				break;
		}
	}
}
