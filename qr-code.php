<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('error_reporting', E_ALL);

/* * ****************************************************************
 * 
 * Settings
 * 
 */


// Get $google_api key from : http://code.google.com/apis/console/

$google_api = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';

/* * *************************************************************** */

// load qr code class
$qr = new qrCodes();

// set API key
$qr->apiKey = $google_api;
// google qr api url
$qr->google_qr_url = "http://chart.apis.google.com/chart";
// google short url 
//$qr->google_shortener_url = 'https://www.googleapis.com/urlshortener/v1/url';

// get chart config
$conf = $qr->get_config_data($_POST);

// get post data
$post = $qr->get_post_data($_POST);

// contact Information
if ($post['type'] == 'contact') {

    // build vCard and make sure we dont add empty value
    if ($post['encoding'] == 'vCard') {
        $arr = array('BEGIN:VCARD');
        if (!empty($post['name']))
            $arr[] = 'N:' . $post['name'];
        if (!empty($post['company']))
            $arr[] = 'ORG:' . $post['company'];
        if (!empty($post['title']))
            $arr[] = 'TITLE:' . $post['title'];
        if (!empty($post['pnum']))
            $arr[] = 'TEL:' . $post['pnum'];
        if (!empty($post['website']))
            $arr[] = 'URL:' . $post['website'];
        if (!empty($post['email']))
            $arr[] = 'EMAIL:' . $post['email'];
        if (!empty($post['address']))
            $arr[] = 'ADR:' . $post['address'] . ' ' . $post['address2'];
        if (!empty($post['memo']))
            $arr[] = 'NOTE:' . $post['memo'];
        $arr[] = 'END:VCARD';

        // build string from array
        $content = urlencode(implode(PHP_EOL, $arr));
    }
    // MECARD and make sure we dont add empty value
    else {
        $arr = array();
        if (!empty($post['name']))
            $arr[] = 'MECARD:N:' . $post['name'];
        if (!empty($post['company']))
            $arr[] = 'ORG:' . $post['company'];
        if (!empty($post['title']))
            $arr[] = 'TITLE:' . $post['title'];
        if (!empty($post['pnum']))
            $arr[] = 'TEL:' . $post['pnum'];
        if (!empty($post['website'])) {
            $website = str_replace(':', '\:', $post['website']);
            $arr[] = 'URL:' . $website;
        }
        if (!empty($post['email']))
            $arr[] = 'EMAIL:' . $post['email'];
        if (!empty($post['address']))
            $arr[] = 'ADR:' . $post['address'] . ' ' . $post['address2'];
        if (!empty($post['memo']))
            $arr[] = 'NOTE:' . $post['memo'];

        // build string from array
        $merge = implode(';', $arr) . ';;';

        // encode it
        $content = urlencode($merge);
    }

    // output it
    $qr->send_json($conf, $content);
}
// email
elseif ($post['type'] == 'emailform') {

    // construct content
    $content = urlencode('mailto:' . $post['email']);

    // output it
    $qr->send_json($conf, $content);
} elseif ($post['type'] == 'phone') {

    // construct content
    $content = urlencode('tel:' . $post['pnum']);

    // output it
    $qr->send_json($conf, $content);
} elseif ($post['type'] == 'geo') {

    // construct content
    $content = urlencode('geo:' . $post['lati'] . ',' . $post['longi'] . '?q=' . $post['q']);

    // output it
    $qr->send_json($conf, $content);
} elseif ($post['type'] == 'smsform') {

    // construct content
    $content = urlencode('smsto:' . $post['pnum'] . ':' . $post['msg']);

    // output it
    $qr->send_json($conf, $content);
} elseif ($post['type'] == 'msgform' || $post['type'] == 'urlform') {

    // construct content
    $content = urlencode($post['msg']);

    // output it
    $qr->send_json($conf, $content);
} elseif ($post['type'] == 'wifiform') {

    // construct content
    $content = urlencode('WIFI:S:' . $post['ssid'] . ';T:' . $post['ntype'] . ';P:' . $post['pass'] . ';;');

    // output it
    $qr->send_json($conf, $content);
} elseif ($post['type'] == 'eventform') {

    $date1 = $post['date1'];
    $date2 = $post['date2'];

    // user tick all day event we just need a date
    if (!empty($post['allday']) && $post['allday'] == 'on') {
        // format dates
        $date1 = $qr->make_date($date1);
        $date2 = $qr->make_date($date2);
    }
    // user need date and time
    else {
        //format date and time
        $date1 = $qr->make_date_time($post['tz'], $date1, $post['time1']);
        $date2 = $qr->make_date_time($post['tz'], $date2, $post['time2']);
    }

    $arr = array('BEGIN:VEVENT');
    $arr[] = 'SUMMARY:' . $post['evtitle'];
    $arr[] = 'DTSTART:' . $date1;
    $arr[] = 'DTEND:' . $date2;

    // make sure we dont add empty location
    if (!empty($post['loc']))
        $arr[] = 'LOCATION:' . $post['loc'];

    // make sure we dont add empty description
    if (!empty($post['desc']))
        $arr[] = 'DESCRIPTION:' . $post['desc'];
    $arr[] = 'END:VEVENT';

    // make string from array
    $merge = implode(PHP_EOL, $arr);

    // construct content
    $content = urlencode($merge);

    // output it
    $qr->send_json($conf, $content);
}

die(json_encode(array('status' => 'error')));

class qrCodes {

    //Get API key from : http://code.google.com/apis/console/
    var $apiKey = 'AIzaSyCP-r-uyicnxTUbM2nrgDxPCwLU15dISVM';
    // google qr api url
    var $google_qr_url = "http://chart.apis.google.com/chart";
    // google short url 
    //var $google_shortener_url = 'https://www.googleapis.com/urlshortener/v1/url';

    /**
     * create google short url using curl
     * 
     * @param type $data
     * @return type json
     
    function google_short_url($data) {

        $query = http_build_query($data);

        $postData = array(
            'longUrl' => $this->google_qr_url . '?' . $query,
            'key' => $this->apiKey
        );
        $jsonData = json_encode($postData);

        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, $this->google_shortener_url);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

        $response = curl_exec($curlObj);

        $json = json_decode($response);
        curl_close($curlObj);
        return $json;
    }
   */

    /**
     * strip post config
     * 
     * @param type $post
     * @return type array
     */
    function get_post_data($post = array()) {
        $config = array(
            'size' => '',
            'error' => '',
            'char' => ''
        );

        $diff = array_diff_key($post, $config);
        return $diff;
    }

    /**
     * get post config for google chart from our post
     * 
     * @param type $post
     * @return type array
     */
    function get_config_data($post = array()) {
        // set chart type
        $conf = array('cht' => 'qr');

        // set additional config for qr chart
        $conf['chs'] = $post['size'] . 'x' . $post['size'];
        $conf['chld'] = $post['error'] . '|' . $_COOKIE["margin"];
        $conf['choe'] = $post['char'];
        return $conf;
    }

    /**
     * format date time yyyymmddThhmmssZ
     * 
     * @param type $tz
     * @param type $qdate
     * @param type $qtime
     * @return type string
     */
    function make_date_time($tz, $qdate, $qtime) {
        // set default timezone
        $GMT = new DateTimeZone("GMT");

        // timezone to use
        $newTZ = new DateTimeZone($tz);

        // make time with hh:mm:ss format
        $format24 = date("H:i:s", strtotime($qtime));

        // split date
        $date = explode('-', $qdate);

        // split time
        $time = explode(':', $format24);

        // lets construct our date time
        $datetime = new DateTime();
        $datetime->setTimezone($GMT);
        $datetime->setDate($date[0], $date[1], $date[2]);
        $datetime->setTime($time[0], $time[1], $time[2]);

        // set to the correct timezone
        $datetime->setTimezone($newTZ);

        // return with format yyyymmddThhmmssZ
        return $datetime->format('Ymd\THis\Z');
    }

    /**
     * format date with yyyymmdd
     * 
     * @param type $qdate
     * @return string
     */
    function make_date($qdate) {
        $date = new DateTime($qdate);
        return $date->format('Ymd');
    }

    /**
     * send json back to browser
     * 
     * @param array $conf
     * @param type $content
     */
    function send_json($conf, $content) {
        $conf['chl'] = $content;

        // send request
        //$json = $this->google_short_url($conf);

        // add text data
        $json->content = urldecode($content);

        // add real url
        $json->real = $this->google_qr_url . '?' . http_build_query($conf);

        // add status
        $json->status = 'ok';

        // output it
        echo json_encode($json);
        exit;
    }

}
