<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/* Custom Constants */
define('SITE_DISPNAME', 'PopIn');
define('WELCOME_MESSAGE', 'Welcome To ' . SITE_DISPNAME);
define('ADMIN_DIR', 'admin');
define('FRONT_DIR', 'frontend');
define('SITE_URL', 'http://www.neurons-it.in/Popin/');
define('ADMIN_URL', SITE_URL . ADMIN_DIR . '/');
define('URL_EXTENSION', '.html');

define('ADD', 'add');
define('EDIT', 'edit');
define('DEL', 'delete');
define('VIEW', 'view');
define('INC', 'include');

/* Other Constant Message Section Start */
define('DATE_FORMAT', 'd M Y h:i:s a');
define('SID', 'AC0817b7d4c25d802daa93564ee4d2ce3d');
define('TOKEN', '0f8c82ba197a1c247a413966a77c1e6a');

/* Admin Section Page Title, Descrption, Author, Keywords Section Start */
define('ADMIN_PAGE_TITLE', SITE_DISPNAME . ' Admin');
define('ADMIN_META_KEYWORDS', SITE_DISPNAME);
define('ADMIN_META_DESCRIPTION', SITE_DISPNAME);
define('ADMIN_META_AUTHOR', SITE_DISPNAME);

/* Validation Success, Error, Warning Message */
define('A_SUC', 'success');
define('A_FAIL', 'danger');
define('A_WAR', 'warning');
define('A_JQUERY_VALIDATION_SUCCESS', 'has-success');
define('A_JQUERY_VALIDATION_ERROR_CLASS_FULL', 'has-error');

/* Admin Modules */
define('PROFILE', 'profile');
define('HOME_BANNER', 'home_banner');
define('CMS_PAGE', 'page');
define('DASHBOARD', 'dashboard');
define('CON_REQ', 'contact_request');
define('FAQ_CAT', 'faq_category');
define('FAQ', 'faq');
define('SETTINGS', 'settings');
define('EMAIL_TEMPLATE', 'email_template');
define('SUBSCRIBER', 'subscriber');
define('NEWS_SUBSCRIBER', 'newsletter_subscriber');
define('HOST', 'hosts');
define('GUEST', 'guests');

define('PAYPALUSERID', 'casual_seduction_merchant_api1.gmail.com');
define('PAYPALSIGN', 'AFcWxV21C7fd0v3bYYYRCpSSRl31ACfcQDCYj.DtXfE7pooYeCR0xJmr');
define('PAYPALAPPID', 'APP-80W284485P519543T');
define('SENDBOXEMAIL', 'testmail0987654@gmail.com');
define('PAYPALPASS', 'XJEW9BM4YQBHJGQG');

define('EOL', '<br />');

/* Front End Modules */
define('HOME', 'home');
define('MONTH_DIG', serialize(array(
    '' => 'Select Month',
    '01' => 'January',
    '02' => 'February',
    '03' => 'March',
    '04' => 'April',
    '05' => 'May',
    '06' => 'June',
    '07' => 'July',
    '08' => 'August',
    '09' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December'
)));
define('MONTHS', serialize(array(
    '' => 'Month',
    'January' => 'January',
    'February' => 'February',
    'March' => 'March',
    'April' => 'April',
    'May' => 'May',
    'June' => 'June',
    'July' => 'July',
    'August' => 'August',
    'September' => 'September',
    'October' => 'October',
    'November' => 'November',
    'December' => 'December'
)));
define('LANGUAGES', serialize(array(
    '' => 'Select Language',
    'id' => 'Bahasa Indonesia',
    'ms' => 'Bahasa Melayu',
    'ca' => 'Català',
    'da' => 'Dansk',
    'de' => 'Deutsch',
    'en' => 'English',
    'es' => 'Español',
    'el' => 'Eλληνικά',
    'fr' => 'Français',
    'it' => 'Italiano',
    'hu' => 'Magyar',
    'nl' => 'Nederlands',
    'no' => 'Norsk',
    'pl' => 'Polski',
    'pt' => 'Português',
    'fi' => 'Suomi',
    'sv' => 'Svenska',
    'tr' => 'Türkçe',
    'is' => 'Íslenska',
    'cs' => 'Čeština',
    'ru' => 'Русский',
    'th' => 'ภาษาไทย',
    'zh' => '中文 (简体)',
    'zh-TW' => '中文 (繁體)',
    'ja' => '日本語',
    'ko' => '한국어'
)));

define('CURRENCIES', serialize(array(
    '' => 'Select Currency',
    'AED' => 'AED',
    'ARS' => 'ARS',
    'AUD' => 'AUD',
    'BGN' => 'BGN',
    'BRL' => 'BRL',
    'CAD' => 'CAD',
    'CHF' => 'CHF',
    'CLP' => 'CLP',
    'CNY' => 'CNY',
    'COP' => 'COP',
    'CRC' => 'CRC',
    'CZK' => 'CZK',
    'DKK' => 'DKK',
    'EUR' => 'EUR',
    'GBP' => 'GBP',
    'HKD' => 'HKD',
    'HRK' => 'HRK',
    'HUF' => 'HUF',
    'IDR' => 'IDR',
    'ILS' => 'ILS',
    'INR' => 'INR',
    'JPY' => 'JPY',
    'KRW' => 'KRW',
    'MAD' => 'MAD',
    'MXN' => 'MXN',
    'MYR' => 'MYR',
    'NOK' => 'NOK',
    'NZD' => 'NZD',
    'PEN' => 'PEN',
    'PHP' => 'PHP',
    'PLN' => 'PLN',
    'RON' => 'RON',
    'RUB' => 'RUB',
    'SAR' => 'SAR',
    'SEK' => 'SEK',
    'SGD' => 'SGD',
    'THB' => 'THB',
    'TRY' => 'TRY',
    'TWD' => 'TWD',
    'UAH' => 'UAH',
    'USD' => 'USD',
    'UYU' => 'UYU',
    'VND' => 'VND',
    'ZAR' => 'ZAR'
)));

define('TIMEZONE', serialize(array(
    '' => 'Select Timezone',
    'International Date Line West' => '(GMT-11:00) International Date Line West',
    'Midway Island' => '(GMT-11:00) Midway Island',
    'Samoa' => '(GMT-11:00) Samoa',
    'Hawaii' => '(GMT-10:00) Hawaii',
    'Alaska' => '(GMT-09:00) Alaska',
    'Pacific Time (US &amp; Canada)' => '(GMT-08:00) Pacific Time (US &amp; Canada)',
    'Tijuana' => '(GMT-08:00) Tijuana',
    'Arizona' => '(GMT-07:00) Arizona',
    'Chihuahua' => '(GMT-07:00) Chihuahua',
    'Mazatlan' => '(GMT-07:00) Mazatlan',
    'Mountain Time (US &amp; Canada)' => '(GMT-07:00) Mountain Time (US &amp; Canada)',
    'Central America' => '(GMT-06:00) Central America',
    'Central Time (US &amp; Canada)' => '(GMT-06:00) Central Time (US &amp; Canada)',
    'Guadalajara' => '(GMT-06:00) Guadalajara',
    'Mexico City' => '(GMT-06:00) Mexico City',
    'Monterrey' => '(GMT-06:00) Monterrey',
    'Saskatchewan' => '(GMT-06:00) Saskatchewan',
    'Bogota' => '(GMT-05:00) Bogota',
    'Eastern Time (US &amp; Canada)' => '(GMT-05:00) Eastern Time (US &amp; Canada)',
    'Indiana (East)' => '(GMT-05:00) Indiana (East)',
    'Lima' => '(GMT-05:00) Lima',
    'Quito' => '(GMT-05:00) Quito',
    'Atlantic Time (Canada)' => '(GMT-04:00) Atlantic Time (Canada)',
    'Caracas' => '(GMT-04:00) Caracas',
    'Georgetown' => '(GMT-04:00) Georgetown',
    'La Paz' => '(GMT-04:00) La Paz',
    'Santiago' => '(GMT-04:00) Santiago',
    'Newfoundland' => '(GMT-03:30) Newfoundland',
    'Brasilia' => '(GMT-03:00) Brasilia',
    'Buenos Aires' => '(GMT-03:00) Buenos Aires',
    'Greenland' => '(GMT-03:00) Greenland',
    'Mid-Atlantic' => '(GMT-02:00) Mid-Atlantic',
    'Azores' => '(GMT-01:00) Azores',
    'Cape Verde Is.' => '(GMT-01:00) Cape Verde Is.',
    'Casablanca' => '(GMT+00:00) Casablanca',
    'Dublin' => '(GMT+00:00) Dublin',
    'Edinburgh' => '(GMT+00:00) Edinburgh',
    'Lisbon' => '(GMT+00:00) Lisbon',
    'London' => '(GMT+00:00) London',
    'Monrovia' => '(GMT+00:00) Monrovia',
    'UTC' => '(GMT+00:00) UTC',
    'Amsterdam' => '(GMT+01:00) Amsterdam',
    'Belgrade' => '(GMT+01:00) Belgrade',
    'Berlin' => '(GMT+01:00) Berlin',
    'Bern' => '(GMT+01:00) Bern',
    'Bratislava' => '(GMT+01:00) Bratislava',
    'Brussels' => '(GMT+01:00) Brussels',
    'Budapest' => '(GMT+01:00) Budapest',
    'Copenhagen' => '(GMT+01:00) Copenhagen',
    'Ljubljana' => '(GMT+01:00) Ljubljana',
    'Madrid' => '(GMT+01:00) Madrid',
    'Paris' => '(GMT+01:00) Paris',
    'Prague' => '(GMT+01:00) Prague',
    'Rome' => '(GMT+01:00) Rome',
    'Sarajevo' => '(GMT+01:00) Sarajevo',
    'Skopje' => '(GMT+01:00) Skopje',
    'Stockholm' => '(GMT+01:00) Stockholm',
    'Vienna' => '(GMT+01:00) Vienna',
    'Warsaw' => '(GMT+01:00) Warsaw',
    'West Central Africa' => '(GMT+01:00) West Central Africa',
    'Zagreb' => '(GMT+01:00) Zagreb',
    'Athens' => '(GMT+02:00) Athens',
    'Bucharest' => '(GMT+02:00) Bucharest',
    'Cairo' => '(GMT+02:00) Cairo',
    'Harare' => '(GMT+02:00) Harare',
    'Helsinki' => '(GMT+02:00) Helsinki',
    'Jerusalem' => '(GMT+02:00) Jerusalem',
    'Kyiv' => '(GMT+02:00) Kyiv',
    'Pretoria' => '(GMT+02:00) Pretoria',
    'Riga' => '(GMT+02:00) Riga',
    'Sofia' => '(GMT+02:00) Sofia',
    'Tallinn' => '(GMT+02:00) Tallinn',
    'Vilnius' => '(GMT+02:00) Vilnius',
    'Baghdad' => '(GMT+03:00) Baghdad',
    'Istanbul' => '(GMT+03:00) Istanbul',
    'Kuwait' => '(GMT+03:00) Kuwait',
    'Minsk' => '(GMT+03:00) Minsk',
    'Moscow' => '(GMT+03:00) Moscow',
    'Nairobi' => '(GMT+03:00) Nairobi',
    'Riyadh' => '(GMT+03:00) Riyadh',
    'St. Petersburg' => '(GMT+03:00) St. Petersburg',
    'Volgograd' => '(GMT+03:00) Volgograd',
    'Tehran' => '(GMT+03:30) Tehran',
    'Abu Dhabi' => '(GMT+04:00) Abu Dhabi',
    'Baku' => '(GMT+04:00) Baku',
    'Muscat' => '(GMT+04:00) Muscat',
    'Tbilisi' => '(GMT+04:00) Tbilisi',
    'Yerevan' => '(GMT+04:00) Yerevan',
    'Kabul' => '(GMT+04:30) Kabul',
    'Ekaterinburg' => '(GMT+05:00) Ekaterinburg',
    'Islamabad' => '(GMT+05:00) Islamabad',
    'Karachi' => '(GMT+05:00) Karachi',
    'Tashkent' => '(GMT+05:00) Tashkent',
    'Chennai' => '(GMT+05:30) Chennai',
    'Kolkata' => '(GMT+05:30) Kolkata',
    'Mumbai' => '(GMT+05:30) Mumbai',
    'New Delhi' => '(GMT+05:30) New Delhi',
    'Sri Jayawardenepura' => '(GMT+05:30) Sri Jayawardenepura',
    'Kathmandu' => '(GMT+05:45) Kathmandu',
    'Almaty' => '(GMT+06:00) Almaty',
    'Astana' => '(GMT+06:00) Astana',
    'Dhaka' => '(GMT+06:00) Dhaka',
    'Urumqi' => '(GMT+06:00) Urumqi',
    'Rangoon' => '(GMT+06:30) Rangoon',
    'Bangkok' => '(GMT+07:00) Bangkok',
    'Hanoi' => '(GMT+07:00) Hanoi',
    'Jakarta' => '(GMT+07:00) Jakarta',
    'Krasnoyarsk' => '(GMT+07:00) Krasnoyarsk',
    'Novosibirsk' => '(GMT+07:00) Novosibirsk',
    'Beijing' => '(GMT+08:00) Beijing',
    'Chongqing' => '(GMT+08:00) Chongqing',
    'Hong Kong' => '(GMT+08:00) Hong Kong',
    'Irkutsk' => '(GMT+08:00) Irkutsk',
    'Kuala Lumpur' => '(GMT+08:00) Kuala Lumpur',
    'Perth' => '(GMT+08:00) Perth',
    'Singapore' => '(GMT+08:00) Singapore',
    'Taipei' => '(GMT+08:00) Taipei',
    'Ulaan Bataar' => '(GMT+08:00) Ulaan Bataar',
    'Osaka' => '(GMT+09:00) Osaka',
    'Sapporo' => '(GMT+09:00) Sapporo',
    'Seoul' => '(GMT+09:00) Seoul',
    'Tokyo' => '(GMT+09:00) Tokyo',
    'Yakutsk' => '(GMT+09:00) Yakutsk',
    'Adelaide' => '(GMT+09:30) Adelaide',
    'Darwin' => '(GMT+09:30) Darwin',
    'Brisbane' => '(GMT+10:00) Brisbane',
    'Canberra' => '(GMT+10:00) Canberra',
    'Guam' => '(GMT+10:00) Guam',
    'Hobart' => '(GMT+10:00) Hobart',
    'Melbourne' => '(GMT+10:00) Melbourne',
    'Port Moresby' => '(GMT+10:00) Port Moresby',
    'Sydney' => '(GMT+10:00) Sydney',
    'Vladivostok' => '(GMT+10:00) Vladivostok',
    'Magadan' => '(GMT+11:00) Magadan',
    'New Caledonia' => '(GMT+11:00) New Caledonia',
    'Solomon Is.' => '(GMT+11:00) Solomon Is.',
    'Auckland' => '(GMT+12:00) Auckland',
    'Fiji' => '(GMT+12:00) Fiji',
    'Kamchatka' => '(GMT+12:00) Kamchatka',
    'Marshall Is.' => '(GMT+12:00) Marshall Is.',
    'Wellington' => '(GMT+12:00) Wellington',
    'Nuku\'alofa' => '(GMT+13:00) Nuku\'alofa'
)));

define('ALL_COUNTRY', serialize(array(
    '' => 'Select Country',
    'AF' => 'Afghanistan',
    'AX' => 'Åland Islands',
    'AL' => 'Albania',
    'DZ' => 'Algeria',
    'AS' => 'American Samoa',
    'AD' => 'Andorra',
    'AO' => 'Angola',
    'AI' => 'Anguilla',
    'AQ' => 'Antarctica',
    'AG' => 'Antigua and Barbuda',
    'AR' => 'Argentina',
    'AM' => 'Armenia',
    'AW' => 'Aruba',
    'AU' => 'Australia',
    'AT' => 'Austria',
    'AZ' => 'Azerbaijan',
    'BS' => 'Bahamas',
    'BH' => 'Bahrain',
    'BD' => 'Bangladesh',
    'BB' => 'Barbados',
    'BY' => 'Belarus',
    'BE' => 'Belgium',
    'BZ' => 'Belize',
    'BJ' => 'Benin',
    'BM' => 'Bermuda',
    'BT' => 'Bhutan',
    'BO' => 'Bolivia',
    'BA' => 'Bosnia and Herzegovina',
    'BW' => 'Botswana',
    'BV' => 'Bouvet Island',
    'BR' => 'Brazil',
    'IO' => 'British Indian Ocean Territory',
    'VG' => 'British Virgin Islands',
    'BN' => 'Brunei',
    'BG' => 'Bulgaria',
    'BF' => 'Burkina Faso',
    'BI' => 'Burundi',
    'KH' => 'Cambodia',
    'CM' => 'Cameroon',
    'CA' => 'Canada',
    'CV' => 'Cape Verde',
    'BQ' => 'Caribbean Netherlands',
    'KY' => 'Cayman Islands',
    'CF' => 'Central African Republic',
    'TD' => 'Chad',
    'CL' => 'Chile',
    'CN' => 'China',
    'CX' => 'Christmas Island',
    'CC' => 'Cocos [Keeling] Islands',
    'CO' => 'Colombia',
    'KM' => 'Comoros',
    'CG' => 'Congo',
    'CK' => 'Cook Islands',
    'CR' => 'Costa Rica',
    'HR' => 'Croatia',
    'CU' => 'Cuba',
    'CW' => 'Curaçao',
    'CY' => 'Cyprus',
    'CZ' => 'Czech Republic',
    'CD' => 'Democratic Republic of the Congo',
    'DK' => 'Denmark',
    'DJ' => 'Djibouti',
    'DM' => 'Dominica',
    'DO' => 'Dominican Republic',
    'TL' => 'East Timor',
    'EC' => 'Ecuador',
    'EG' => 'Egypt',
    'SV' => 'El Salvador',
    'GQ' => 'Equatorial Guinea',
    'ER' => 'Eritrea',
    'EE' => 'Estonia',
    'ET' => 'Ethiopia',
    'FK' => 'Falkland Islands [Islas Malvinas]',
    'FO' => 'Faroe Islands',
    'FJ' => 'Fiji',
    'FI' => 'Finland',
    'FR' => 'France',
    'GF' => 'French Guiana',
    'PF' => 'French Polynesia',
    'TF' => 'French Southern Territories',
    'GA' => 'Gabon',
    'GM' => 'Gambia',
    'GE' => 'Georgia',
    'DE' => 'Germany',
    'GH' => 'Ghana',
    'GI' => 'Gibraltar',
    'GR' => 'Greece',
    'GL' => 'Greenland',
    'GD' => 'Grenada',
    'GP' => 'Guadeloupe',
    'GU' => 'Guam',
    'GT' => 'Guatemala',
    'GG' => 'Guernsey',
    'GN' => 'Guinea',
    'GW' => 'Guinea-Bissau',
    'GY' => 'Guyana',
    'HT' => 'Haiti',
    'HM' => 'Heard Island and McDonald Islands',
    'HN' => 'Honduras',
    'HK' => 'Hong Kong',
    'HU' => 'Hungary',
    'IS' => 'Iceland',
    'IN' => 'India',
    'ID' => 'Indonesia',
    'IQ' => 'Iraq',
    'IE' => 'Ireland',
    'IM' => 'Isle of Man',
    'IL' => 'Israel',
    'IT' => 'Italy',
    'CI' => 'Ivory Coast',
    'JM' => 'Jamaica',
    'JP' => 'Japan',
    'JE' => 'Jersey',
    'JO' => 'Jordan',
    'KZ' => 'Kazakhstan',
    'KE' => 'Kenya',
    'KI' => 'Kiribati',
    'XK' => 'Kosovo',
    'KW' => 'Kuwait',
    'KG' => 'Kyrgyzstan',
    'LA' => 'Laos',
    'LV' => 'Latvia',
    'LB' => 'Lebanon',
    'LS' => 'Lesotho',
    'LR' => 'Liberia',
    'LY' => 'Libya',
    'LI' => 'Liechtenstein',
    'LT' => 'Lithuania',
    'LU' => 'Luxembourg',
    'MO' => 'Macau',
    'MK' => 'Macedonia',
    'MG' => 'Madagascar',
    'MW' => 'Malawi',
    'MY' => 'Malaysia',
    'MV' => 'Maldives',
    'ML' => 'Mali',
    'MT' => 'Malta',
    'MH' => 'Marshall Islands',
    'MQ' => 'Martinique',
    'MR' => 'Mauritania',
    'MU' => 'Mauritius',
    'YT' => 'Mayotte',
    'MX' => 'Mexico',
    'FM' => 'Micronesia',
    'MD' => 'Moldova',
    'MC' => 'Monaco',
    'MN' => 'Mongolia',
    'ME' => 'Montenegro',
    'MS' => 'Montserrat',
    'MA' => 'Morocco',
    'MZ' => 'Mozambique',
    'MM' => 'Myanmar [Burma]',
    'NA' => 'Namibia',
    'NR' => 'Nauru',
    'NP' => 'Nepal',
    'NL' => 'Netherlands',
    'NC' => 'New Caledonia',
    'NZ' => 'New Zealand',
    'NI' => 'Nicaragua',
    'NE' => 'Niger',
    'NG' => 'Nigeria',
    'NU' => 'Niue',
    'NF' => 'Norfolk Island',
    'MP' => 'Northern Mariana Islands',
    'NO' => 'Norway',
    'OM' => 'Oman',
    'PK' => 'Pakistan',
    'PW' => 'Palau',
    'PS' => 'Palestinian Territories',
    'PA' => 'Panama',
    'PG' => 'Papua New Guinea',
    'PY' => 'Paraguay',
    'PE' => 'Peru',
    'PH' => 'Philippines',
    'PN' => 'Pitcairn Islands',
    'PL' => 'Poland',
    'PT' => 'Portugal',
    'PR' => 'Puerto Rico',
    'QA' => 'Qatar',
    'RE' => 'Réunion',
    'RO' => 'Romania',
    'RU' => 'Russia',
    'RW' => 'Rwanda',
    'BL' => 'Saint Barthélemy',
    'SH' => 'Saint Helena',
    'KN' => 'Saint Kitts and Nevis',
    'LC' => 'Saint Lucia',
    'MF' => 'Saint Martin',
    'PM' => 'Saint Pierre and Miquelon',
    'VC' => 'Saint Vincent and the Grenadines',
    'WS' => 'Samoa',
    'SM' => 'San Marino',
    'ST' => 'São Tomé and Príncipe',
    'SA' => 'Saudi Arabia',
    'SN' => 'Senegal',
    'RS' => 'Serbia',
    'SC' => 'Seychelles',
    'SL' => 'Sierra Leone',
    'SG' => 'Singapore',
    'SX' => 'Sint Maarten',
    'SK' => 'Slovakia',
    'SI' => 'Slovenia',
    'SB' => 'Solomon Islands',
    'SO' => 'Somalia',
    'ZA' => 'South Africa',
    'GS' => 'South Georgia and the South Sandwich Islands',
    'KR' => 'South Korea',
    'SS' => 'South Sudan',
    'ES' => 'Spain',
    'LK' => 'Sri Lanka',
    'SR' => 'Suriname',
    'SJ' => 'Svalbard and Jan Mayen',
    'SZ' => 'Swaziland',
    'SE' => 'Sweden',
    'CH' => 'Switzerland',
    'TW' => 'Taiwan',
    'TJ' => 'Tajikistan',
    'TZ' => 'Tanzania',
    'TH' => 'Thailand',
    'TG' => 'Togo',
    'TK' => 'Tokelau',
    'TO' => 'Tonga',
    'TT' => 'Trinidad and Tobago',
    'TN' => 'Tunisia',
    'TR' => 'Turkey',
    'TM' => 'Turkmenistan',
    'TC' => 'Turks and Caicos Islands',
    'TV' => 'Tuvalu',
    'UM' => 'U.S. Outlying Islands',
    'VI' => 'U.S. Virgin Islands',
    'UG' => 'Uganda',
    'UA' => 'Ukraine',
    'AE' => 'United Arab Emirates',
    'GB' => 'United Kingdom',
    'US' => 'United States',
    'UY' => 'Uruguay',
    'UZ' => 'Uzbekistan',
    'VU' => 'Vanuatu',
    'VA' => 'Vatican City',
    'VE' => 'Venezuela',
    'VN' => 'Vietnam',
    'WF' => 'Wallis and Futuna',
    'EH' => 'Western Sahara',
    'YE' => 'Yemen',
    'ZM' => 'Zambia',
    'ZW' => 'Zimbabwe'
)));

define('MOBILECODES', serialize(array(
    '' => array('name' => 'Select Country', 'code' => ''),
    'AD' => array('name' => 'ANDORRA', 'code' => '376'),
    'AE' => array('name' => 'UNITED ARAB EMIRATES', 'code' => '971'),
    'AF' => array('name' => 'AFGHANISTAN', 'code' => '93'),
    'AG' => array('name' => 'ANTIGUA AND BARBUDA', 'code' => '1268'),
    'AI' => array('name' => 'ANGUILLA', 'code' => '1264'),
    'AL' => array('name' => 'ALBANIA', 'code' => '355'),
    'AM' => array('name' => 'ARMENIA', 'code' => '374'),
    'AN' => array('name' => 'NETHERLANDS ANTILLES', 'code' => '599'),
    'AO' => array('name' => 'ANGOLA', 'code' => '244'),
    'AQ' => array('name' => 'ANTARCTICA', 'code' => '672'),
    'AR' => array('name' => 'ARGENTINA', 'code' => '54'),
    'AS' => array('name' => 'AMERICAN SAMOA', 'code' => '1684'),
    'AT' => array('name' => 'AUSTRIA', 'code' => '43'),
    'AU' => array('name' => 'AUSTRALIA', 'code' => '61'),
    'AW' => array('name' => 'ARUBA', 'code' => '297'),
    'AZ' => array('name' => 'AZERBAIJAN', 'code' => '994'),
    'BA' => array('name' => 'BOSNIA AND HERZEGOVINA', 'code' => '387'),
    'BB' => array('name' => 'BARBADOS', 'code' => '1246'),
    'BD' => array('name' => 'BANGLADESH', 'code' => '880'),
    'BE' => array('name' => 'BELGIUM', 'code' => '32'),
    'BF' => array('name' => 'BURKINA FASO', 'code' => '226'),
    'BG' => array('name' => 'BULGARIA', 'code' => '359'),
    'BH' => array('name' => 'BAHRAIN', 'code' => '973'),
    'BI' => array('name' => 'BURUNDI', 'code' => '257'),
    'BJ' => array('name' => 'BENIN', 'code' => '229'),
    'BL' => array('name' => 'SAINT BARTHELEMY', 'code' => '590'),
    'BM' => array('name' => 'BERMUDA', 'code' => '1441'),
    'BN' => array('name' => 'BRUNEI DARUSSALAM', 'code' => '673'),
    'BO' => array('name' => 'BOLIVIA', 'code' => '591'),
    'BR' => array('name' => 'BRAZIL', 'code' => '55'),
    'BS' => array('name' => 'BAHAMAS', 'code' => '1242'),
    'BT' => array('name' => 'BHUTAN', 'code' => '975'),
    'BW' => array('name' => 'BOTSWANA', 'code' => '267'),
    'BY' => array('name' => 'BELARUS', 'code' => '375'),
    'BZ' => array('name' => 'BELIZE', 'code' => '501'),
    'CA' => array('name' => 'CANADA', 'code' => '1'),
    'CC' => array('name' => 'COCOS (KEELING) ISLANDS', 'code' => '61'),
    'CD' => array('name' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'code' => '243'),
    'CF' => array('name' => 'CENTRAL AFRICAN REPUBLIC', 'code' => '236'),
    'CG' => array('name' => 'CONGO', 'code' => '242'),
    'CH' => array('name' => 'SWITZERLAND', 'code' => '41'),
    'CI' => array('name' => 'COTE D IVOIRE', 'code' => '225'),
    'CK' => array('name' => 'COOK ISLANDS', 'code' => '682'),
    'CL' => array('name' => 'CHILE', 'code' => '56'),
    'CM' => array('name' => 'CAMEROON', 'code' => '237'),
    'CN' => array('name' => 'CHINA', 'code' => '86'),
    'CO' => array('name' => 'COLOMBIA', 'code' => '57'),
    'CR' => array('name' => 'COSTA RICA', 'code' => '506'),
    'CU' => array('name' => 'CUBA', 'code' => '53'),
    'CV' => array('name' => 'CAPE VERDE', 'code' => '238'),
    'CX' => array('name' => 'CHRISTMAS ISLAND', 'code' => '61'),
    'CY' => array('name' => 'CYPRUS', 'code' => '357'),
    'CZ' => array('name' => 'CZECH REPUBLIC', 'code' => '420'),
    'DE' => array('name' => 'GERMANY', 'code' => '49'),
    'DJ' => array('name' => 'DJIBOUTI', 'code' => '253'),
    'DK' => array('name' => 'DENMARK', 'code' => '45'),
    'DM' => array('name' => 'DOMINICA', 'code' => '1767'),
    'DO' => array('name' => 'DOMINICAN REPUBLIC', 'code' => '1809'),
    'DZ' => array('name' => 'ALGERIA', 'code' => '213'),
    'EC' => array('name' => 'ECUADOR', 'code' => '593'),
    'EE' => array('name' => 'ESTONIA', 'code' => '372'),
    'EG' => array('name' => 'EGYPT', 'code' => '20'),
    'ER' => array('name' => 'ERITREA', 'code' => '291'),
    'ES' => array('name' => 'SPAIN', 'code' => '34'),
    'ET' => array('name' => 'ETHIOPIA', 'code' => '251'),
    'FI' => array('name' => 'FINLAND', 'code' => '358'),
    'FJ' => array('name' => 'FIJI', 'code' => '679'),
    'FK' => array('name' => 'FALKLAND ISLANDS (MALVINAS)', 'code' => '500'),
    'FM' => array('name' => 'MICRONESIA, FEDERATED STATES OF', 'code' => '691'),
    'FO' => array('name' => 'FAROE ISLANDS', 'code' => '298'),
    'FR' => array('name' => 'FRANCE', 'code' => '33'),
    'GA' => array('name' => 'GABON', 'code' => '241'),
    'GB' => array('name' => 'UNITED KINGDOM', 'code' => '44'),
    'GD' => array('name' => 'GRENADA', 'code' => '1473'),
    'GE' => array('name' => 'GEORGIA', 'code' => '995'),
    'GH' => array('name' => 'GHANA', 'code' => '233'),
    'GI' => array('name' => 'GIBRALTAR', 'code' => '350'),
    'GL' => array('name' => 'GREENLAND', 'code' => '299'),
    'GM' => array('name' => 'GAMBIA', 'code' => '220'),
    'GN' => array('name' => 'GUINEA', 'code' => '224'),
    'GQ' => array('name' => 'EQUATORIAL GUINEA', 'code' => '240'),
    'GR' => array('name' => 'GREECE', 'code' => '30'),
    'GT' => array('name' => 'GUATEMALA', 'code' => '502'),
    'GU' => array('name' => 'GUAM', 'code' => '1671'),
    'GW' => array('name' => 'GUINEA-BISSAU', 'code' => '245'),
    'GY' => array('name' => 'GUYANA', 'code' => '592'),
    'HK' => array('name' => 'HONG KONG', 'code' => '852'),
    'HN' => array('name' => 'HONDURAS', 'code' => '504'),
    'HR' => array('name' => 'CROATIA', 'code' => '385'),
    'HT' => array('name' => 'HAITI', 'code' => '509'),
    'HU' => array('name' => 'HUNGARY', 'code' => '36'),
    'ID' => array('name' => 'INDONESIA', 'code' => '62'),
    'IE' => array('name' => 'IRELAND', 'code' => '353'),
    'IL' => array('name' => 'ISRAEL', 'code' => '972'),
    'IM' => array('name' => 'ISLE OF MAN', 'code' => '44'),
    'IN' => array('name' => 'INDIA', 'code' => '91'),
    'IQ' => array('name' => 'IRAQ', 'code' => '964'),
    'IR' => array('name' => 'IRAN, ISLAMIC REPUBLIC OF', 'code' => '98'),
    'IS' => array('name' => 'ICELAND', 'code' => '354'),
    'IT' => array('name' => 'ITALY', 'code' => '39'),
    'JM' => array('name' => 'JAMAICA', 'code' => '1876'),
    'JO' => array('name' => 'JORDAN', 'code' => '962'),
    'JP' => array('name' => 'JAPAN', 'code' => '81'),
    'KE' => array('name' => 'KENYA', 'code' => '254'),
    'KG' => array('name' => 'KYRGYZSTAN', 'code' => '996'),
    'KH' => array('name' => 'CAMBODIA', 'code' => '855'),
    'KI' => array('name' => 'KIRIBATI', 'code' => '686'),
    'KM' => array('name' => 'COMOROS', 'code' => '269'),
    'KN' => array('name' => 'SAINT KITTS AND NEVIS', 'code' => '1869'),
    'KP' => array('name' => 'KOREA DEMOCRATIC PEOPLES REPUBLIC OF', 'code' => '850'),
    'KR' => array('name' => 'KOREA REPUBLIC OF', 'code' => '82'),
    'KW' => array('name' => 'KUWAIT', 'code' => '965'),
    'KY' => array('name' => 'CAYMAN ISLANDS', 'code' => '1345'),
    'KZ' => array('name' => 'KAZAKSTAN', 'code' => '7'),
    'LA' => array('name' => 'LAO PEOPLES DEMOCRATIC REPUBLIC', 'code' => '856'),
    'LB' => array('name' => 'LEBANON', 'code' => '961'),
    'LC' => array('name' => 'SAINT LUCIA', 'code' => '1758'),
    'LI' => array('name' => 'LIECHTENSTEIN', 'code' => '423'),
    'LK' => array('name' => 'SRI LANKA', 'code' => '94'),
    'LR' => array('name' => 'LIBERIA', 'code' => '231'),
    'LS' => array('name' => 'LESOTHO', 'code' => '266'),
    'LT' => array('name' => 'LITHUANIA', 'code' => '370'),
    'LU' => array('name' => 'LUXEMBOURG', 'code' => '352'),
    'LV' => array('name' => 'LATVIA', 'code' => '371'),
    'LY' => array('name' => 'LIBYAN ARAB JAMAHIRIYA', 'code' => '218'),
    'MA' => array('name' => 'MOROCCO', 'code' => '212'),
    'MC' => array('name' => 'MONACO', 'code' => '377'),
    'MD' => array('name' => 'MOLDOVA, REPUBLIC OF', 'code' => '373'),
    'ME' => array('name' => 'MONTENEGRO', 'code' => '382'),
    'MF' => array('name' => 'SAINT MARTIN', 'code' => '1599'),
    'MG' => array('name' => 'MADAGASCAR', 'code' => '261'),
    'MH' => array('name' => 'MARSHALL ISLANDS', 'code' => '692'),
    'MK' => array('name' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'code' => '389'),
    'ML' => array('name' => 'MALI', 'code' => '223'),
    'MM' => array('name' => 'MYANMAR', 'code' => '95'),
    'MN' => array('name' => 'MONGOLIA', 'code' => '976'),
    'MO' => array('name' => 'MACAU', 'code' => '853'),
    'MP' => array('name' => 'NORTHERN MARIANA ISLANDS', 'code' => '1670'),
    'MR' => array('name' => 'MAURITANIA', 'code' => '222'),
    'MS' => array('name' => 'MONTSERRAT', 'code' => '1664'),
    'MT' => array('name' => 'MALTA', 'code' => '356'),
    'MU' => array('name' => 'MAURITIUS', 'code' => '230'),
    'MV' => array('name' => 'MALDIVES', 'code' => '960'),
    'MW' => array('name' => 'MALAWI', 'code' => '265'),
    'MX' => array('name' => 'MEXICO', 'code' => '52'),
    'MY' => array('name' => 'MALAYSIA', 'code' => '60'),
    'MZ' => array('name' => 'MOZAMBIQUE', 'code' => '258'),
    'NA' => array('name' => 'NAMIBIA', 'code' => '264'),
    'NC' => array('name' => 'NEW CALEDONIA', 'code' => '687'),
    'NE' => array('name' => 'NIGER', 'code' => '227'),
    'NG' => array('name' => 'NIGERIA', 'code' => '234'),
    'NI' => array('name' => 'NICARAGUA', 'code' => '505'),
    'NL' => array('name' => 'NETHERLANDS', 'code' => '31'),
    'NO' => array('name' => 'NORWAY', 'code' => '47'),
    'NP' => array('name' => 'NEPAL', 'code' => '977'),
    'NR' => array('name' => 'NAURU', 'code' => '674'),
    'NU' => array('name' => 'NIUE', 'code' => '683'),
    'NZ' => array('name' => 'NEW ZEALAND', 'code' => '64'),
    'OM' => array('name' => 'OMAN', 'code' => '968'),
    'PA' => array('name' => 'PANAMA', 'code' => '507'),
    'PE' => array('name' => 'PERU', 'code' => '51'),
    'PF' => array('name' => 'FRENCH POLYNESIA', 'code' => '689'),
    'PG' => array('name' => 'PAPUA NEW GUINEA', 'code' => '675'),
    'PH' => array('name' => 'PHILIPPINES', 'code' => '63'),
    'PK' => array('name' => 'PAKISTAN', 'code' => '92'),
    'PL' => array('name' => 'POLAND', 'code' => '48'),
    'PM' => array('name' => 'SAINT PIERRE AND MIQUELON', 'code' => '508'),
    'PN' => array('name' => 'PITCAIRN', 'code' => '870'),
    'PR' => array('name' => 'PUERTO RICO', 'code' => '1'),
    'PT' => array('name' => 'PORTUGAL', 'code' => '351'),
    'PW' => array('name' => 'PALAU', 'code' => '680'),
    'PY' => array('name' => 'PARAGUAY', 'code' => '595'),
    'QA' => array('name' => 'QATAR', 'code' => '974'),
    'RO' => array('name' => 'ROMANIA', 'code' => '40'),
    'RS' => array('name' => 'SERBIA', 'code' => '381'),
    'RU' => array('name' => 'RUSSIAN FEDERATION', 'code' => '7'),
    'RW' => array('name' => 'RWANDA', 'code' => '250'),
    'SA' => array('name' => 'SAUDI ARABIA', 'code' => '966'),
    'SB' => array('name' => 'SOLOMON ISLANDS', 'code' => '677'),
    'SC' => array('name' => 'SEYCHELLES', 'code' => '248'),
    'SD' => array('name' => 'SUDAN', 'code' => '249'),
    'SE' => array('name' => 'SWEDEN', 'code' => '46'),
    'SG' => array('name' => 'SINGAPORE', 'code' => '65'),
    'SH' => array('name' => 'SAINT HELENA', 'code' => '290'),
    'SI' => array('name' => 'SLOVENIA', 'code' => '386'),
    'SK' => array('name' => 'SLOVAKIA', 'code' => '421'),
    'SL' => array('name' => 'SIERRA LEONE', 'code' => '232'),
    'SM' => array('name' => 'SAN MARINO', 'code' => '378'),
    'SN' => array('name' => 'SENEGAL', 'code' => '221'),
    'SO' => array('name' => 'SOMALIA', 'code' => '252'),
    'SR' => array('name' => 'SURINAME', 'code' => '597'),
    'ST' => array('name' => 'SAO TOME AND PRINCIPE', 'code' => '239'),
    'SV' => array('name' => 'EL SALVADOR', 'code' => '503'),
    'SY' => array('name' => 'SYRIAN ARAB REPUBLIC', 'code' => '963'),
    'SZ' => array('name' => 'SWAZILAND', 'code' => '268'),
    'TC' => array('name' => 'TURKS AND CAICOS ISLANDS', 'code' => '1649'),
    'TD' => array('name' => 'CHAD', 'code' => '235'),
    'TG' => array('name' => 'TOGO', 'code' => '228'),
    'TH' => array('name' => 'THAILAND', 'code' => '66'),
    'TJ' => array('name' => 'TAJIKISTAN', 'code' => '992'),
    'TK' => array('name' => 'TOKELAU', 'code' => '690'),
    'TL' => array('name' => 'TIMOR-LESTE', 'code' => '670'),
    'TM' => array('name' => 'TURKMENISTAN', 'code' => '993'),
    'TN' => array('name' => 'TUNISIA', 'code' => '216'),
    'TO' => array('name' => 'TONGA', 'code' => '676'),
    'TR' => array('name' => 'TURKEY', 'code' => '90'),
    'TT' => array('name' => 'TRINIDAD AND TOBAGO', 'code' => '1868'),
    'TV' => array('name' => 'TUVALU', 'code' => '688'),
    'TW' => array('name' => 'TAIWAN, PROVINCE OF CHINA', 'code' => '886'),
    'TZ' => array('name' => 'TANZANIA, UNITED REPUBLIC OF', 'code' => '255'),
    'UA' => array('name' => 'UKRAINE', 'code' => '380'),
    'UG' => array('name' => 'UGANDA', 'code' => '256'),
    'US' => array('name' => 'UNITED STATES', 'code' => '1'),
    'UY' => array('name' => 'URUGUAY', 'code' => '598'),
    'UZ' => array('name' => 'UZBEKISTAN', 'code' => '998'),
    'VA' => array('name' => 'HOLY SEE (VATICAN CITY STATE)', 'code' => '39'),
    'VC' => array('name' => 'SAINT VINCENT AND THE GRENADINES', 'code' => '1784'),
    'VE' => array('name' => 'VENEZUELA', 'code' => '58'),
    'VG' => array('name' => 'VIRGIN ISLANDS, BRITISH', 'code' => '1284'),
    'VI' => array('name' => 'VIRGIN ISLANDS, U.S.', 'code' => '1340'),
    'VN' => array('name' => 'VIET NAM', 'code' => '84'),
    'VU' => array('name' => 'VANUATU', 'code' => '678'),
    'WF' => array('name' => 'WALLIS AND FUTUNA', 'code' => '681'),
    'WS' => array('name' => 'SAMOA', 'code' => '685'),
    'XK' => array('name' => 'KOSOVO', 'code' => '381'),
    'YE' => array('name' => 'YEMEN', 'code' => '967'),
    'YT' => array('name' => 'MAYOTTE', 'code' => '262'),
    'ZA' => array('name' => 'SOUTH AFRICA', 'code' => '27'),
    'ZM' => array('name' => 'ZAMBIA', 'code' => '260'),
    'ZW' => array('name' => 'ZIMBABWE', 'code' => '263')
)));

define('REQUIREMENTS', serialize(array(
    '1' => 'Government-issued ID submitted to PopIn',
    '2' => 'Government-issued License or Certificate submitted to Popln',
    '3' => 'Reviews from other business owners and no negative reviews',
    '4' => 'Provide how many clients are being served'
)));

define('NOTICES', serialize(array(
    '1' => '1 hour',
    '12' => '12 hours',
    '24' => '1 day',
    '48' => '2 days',
    '168' => '7 days'
)));

define('GAPS', serialize(array(
    '0' => 'No time',
    '15' => '15 minutes',
    '30' => '30 minutes',
    '45' => '45 minutes',
    '60' => '1 hour'
)));

define('ADVANCE_NOTICES', serialize(array(
    '1' => '1 month',
    '2' => '2 months',
    '3' => '3 months',
    '6' => '6 months',
    '9' => '9 months',
    '12'=> '1 year'
)));

define('TIMES', serialize(array(
    '' => 'Select a time',
    '6' => '6AM',
    '7' => '7AM',
    '8' => '8AM',
    '9' => '9AM',
    '10' => '10AM',
    '11' => '11AM',
    '12' => '12PM (noon)',
    '13' => '1PM',
    '14' => '2PM',
    '15' => '3PM',
    '16' => '4PM',
    '17' => '5PM',
    '18' => '6PM',
    '19' => '7PM',
    '20' => '8PM',
    '21' => '9PM',
    '22' => '10PM',
    '23' => '11PM',
    '24' => '12AM (midnight)',
)));

define('FOOTER_SECTION', serialize(array(
    '1' => SITE_DISPNAME,
    '2' => 'Discover',
    '3' => 'Hosting'
)));

define('CAN_REASON', serialize(array(
    '1' => 'I have safety concerns',
    '2' => 'I have privacy concerns',
    '3' => 'I don\'t find it useful',
    '4' => 'I don\'t understand how to use it',
    '5' => 'It\'s temporary, I will be back',
    '6' => 'Other'
)));
