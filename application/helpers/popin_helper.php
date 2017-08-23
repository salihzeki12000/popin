<?php
function print_array($array, $exit=FALSE){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    if($exit){ die(); }
}
function get_available_slot($date, $inputArray) {
    if (!in_array($date, $inputArray)) {
        $startDate = date("F d, Y", strtotime($date));
    } else {
        $newDate = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        $startDate = get_available_slot($newDate, $inputArray);
    }

    return $startDate;
}
function get_start_date_by_currentdate($availableArray,$unavailableArray) {
    $today = strtotime(date("Y-m-d"));
    
    $startDate = null;
    if(!empty($availableArray)){
        for($i=0;$i<count($availableArray);$i++){
            if(strtotime($availableArray[$i]) < $today){
                continue;
            }else{
                $startDate = date("m-d-Y", strtotime($availableArray[$i]));
                break;
            }
        }
    }else{
        $startDate = date("m-d-Y",$today);
    }

    return $startDate;
}
function get_end_date_by_currentdate($availableArray,$unavailableArray) {
    $today = strtotime(date("Y-m-d"));
    
    $endDate = null;
    if(strtotime(end($availableArray)) >= $today){
        $endDate = end($availableArray);
    }else{
        $endDate = end($unavailableArray);
    }
    
    return date("m-d-Y", strtotime($endDate));
}
//Converting date to time ago e.g 1 day ago, 2 days ago…
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function get_location_from_ip($ip_address) {
    $response_location = "";
    return $response_location;
    $location = json_decode(file_get_contents('http://freegeoip.net/json/' . $ip_address), TRUE);

    
    if (!empty($location)):
        if (!empty($location['city'])) {
            $response_location .= $location['city'] . ", ";
        }
        if (!empty($location['region_code'])) {
            $response_location .= $location['region_code'] . ", ";
        }
        if (!empty($location['country_name'])) {
            $response_location .= $location['country_name'];
        }
    endif;
    return $response_location;
}

function getCurrency_symbol($currencyCode = 'USD') {
    $currencyCode = empty($currencyCode)?'USD':$currencyCode;
    
    $currencyArray = array(
        "AUD" => "&#36;", //Australian Dollar
        "BRL" => "R&#36;", // OR add &#8354; Brazilian Real
        "BDT" => "&#2547;", //Bangladeshi Taka
        "CAD" => "C&#36;", //Canadian Dollar
        "CHF" => "Fr", //Swiss Franc
        "CRC" => "&#8353;", //Costa Rican Colon
        "CZK" => "K&#269;", //Czech Koruna
        "DKK" => "kr", //Danish Krone
        "EUR" => "&euro;", //Euro
        "GBP" => "&pound;", //Pound Sterling
        "HKD" => "&#36", //Hong Kong Dollar
        "HUF" => "Ft", //Hungarian Forint
        "ILS" => "&#x20aa;", //Israeli New Sheqel
        "INR" => "&#8377;", //Indian Rupee
        "ILS" => "&#8362;", //Israeli New Shekel
        "JPY" => "&yen;", //also use &#165; Japanese Yen
        "KZT" => "&#8376;", //Kazakhstan Tenge
        "KRW" => "&#8361;", //Korean Won
        "KHR" => "&#6107;", //Cambodia Kampuchean Riel	
        "MYR" => "RM", //Malaysian Ringgit 
        "MXN" => "&#36", //Mexican Peso
        "NOK" => "kr", //Norwegian Krone
        "NGN" => "&#8358;", //Nigerian Naira
        "NZD" => "&#36", //New Zealand Dollar
        "PHP" => "&#x20b1;", //Philippine Peso
        "PKR" => "&#8360;", //Pakistani Rupees
        "PLN" => "&#122;&#322;", //Polish Zloty
        "SEK" => "kr", //Swedish Krona 
        "TWD" => "&#36;", //Taiwan New Dollar 
        "THB" => "&#3647;", //Thai Baht
        "TRY" => "&#8378;", //Turkish Lira
        "USD" => "&#36;", //U.S. Dollar
        "VND" => "&#8363;" //Vietnamese Dong
    );
    //print_array($currencyArray,true);
    
    $currency = strtoupper($currencyCode);
    //check country code exit in array or not
    if (array_key_exists($currency, $currencyArray)) {
        return $currencyArray[$currency];
    } else {
        return $currency;
    }
}
function createRatingStars($rating){
    $html = '';
    $html ='<fieldset class="rating1">
                <input type="radio"  value="5" '.($rating == '5'?'checked':'').' />
                <label class = "full"  title="Awesome - 5 stars">    
                </label>
                <input type="radio"  value="4.5" '.($rating == '4.5'?'checked':'').' /><label class="half"  title="4.5 stars"></label>
                <input type="radio"  value="4" '.($rating == '4'?'checked':'').' /><label class = "full" title="4 stars"></label>
                <input type="radio"   value="3.5" '.($rating == '3.5'?'checked':'').'  /><label class="half" title="3.5 stars"></label>
                <input type="radio"  value="3" '.($rating == '3'?'checked':'').' /><label class = "full"  title="3 stars"></label>
                <input type="radio"   value="2.5" '.($rating == '2.5'?'checked':'').'  /><label class="half"  title="2.5 stars"></label>
                <input type="radio"   value="2" '.($rating == '2'?'checked':'').'  /><label class = "full" title="2 stars"></label>
                <input type="radio"   value="1.5" '.($rating == '1.5'?'checked':'').' /><label class="half"  title="1.5 stars"></label>
                <input type="radio"   value="1" '.($rating == '1'?'checked':'').' /><label class = "full" title="1 star"></label>
                <input type="radio"  value="0.5" '.($rating == '0.5'?'checked':'').' /><label class="half" title="0.5 stars"></label>
            </fieldset>';
    return $html;
 }
 
function save_image($inPath,$outPath)
{ //Download images from remote server
    $in  = fopen($inPath, "rb");
    $out = fopen($outPath, "wb");
    while ($chunk = fread($in,8192))
    {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}

// Image rotate function
function rotate_image($source_image, $rotation){
    if(strtolower($rotation) == 'anti clockwise') {
        $degrees = 90;        
    }elseif(strtolower ($rotation) == 'clockwise') {
        $degrees = -90;         
    }
    
    $imaginfo = getimagesize($source_image);

    print_r($imaginfo );

    $mimetype = $imaginfo['mime'];


    if(strtolower($mimetype)=='image/jpg' || strtolower($mimetype)=='image/jpeg' ){

        echo "\n in jpeg file format ";

        $source = imagecreatefromjpeg($source_image);

        $imgtype='jpg';

    }elseif(strtolower($mimetype)=='image/gif' ){

        echo "\n in GIF file format ";

        $source = imagecreatefromgif($source_image);

        $imgtype='gif';

    }elseif(strtolower($mimetype)=='image/png'){

        echo "\n in PNG file format ";

        $source = imagecreatefrompng($source_image);

        $imgtype='png';

    }else{

        echo json_encode(array("error"=>"can not read file"));

        die();

    }
    
    // Rotate
    $rotate = imagerotate($source, $degrees, 0);
    
    if($imgtype=='jpg'){

        if($rotate){ imagejpeg($rotate, $source_image,100); }

    }elseif($imgtype=='png'){

        if($rotate){ imagepng($rotate, $source_image); }

    }elseif($imgtype=='gif'){

        if($rotate){ imagegif($rotate, $source_image,100); }

    }
}