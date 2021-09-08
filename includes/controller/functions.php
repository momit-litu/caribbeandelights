<?php


/**
 * Verify transaction is authentic
 *
 * @param array $data Post data from Paypal
 * @return bool True if the transaction is verified by PayPal
 * @throws Exception
 */
function verifyTransaction($data) {
    global $paypalUrl;

    $req = 'cmd=_notify-validate';
    foreach ($data as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
        $req .= "&$key=$value";
    }

    $ch = curl_init($paypalUrl);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
    $res = curl_exec($ch);

    if (!$res) {
        $errno = curl_errno($ch);
        $errstr = curl_error($ch);
        curl_close($ch);
        throw new Exception("cURL error: [$errno] $errstr");
    }

    $info = curl_getinfo($ch);

    // Check the http response
    $httpCode = $info['http_code'];
    if ($httpCode != 200) {
        throw new Exception("PayPal responded with http code $httpCode");
    }

    curl_close($ch);

    return $res === 'VERIFIED';
}

/**
 * Check we've not already processed a transaction
 *
 * @param string $txnid Transaction ID
 * @return bool True if the transaction ID has not been seen before, false if already processed
 */
function checkTxnid($txnid) {
    global $db;

    $txnid = $db->real_escape_string($txnid);
    $results = $db->query('SELECT * FROM `payments` WHERE txnid = \'' . $txnid . '\'');

    return ! $results->num_rows;
}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */

function addPayment($data) {
    global $db;
    //echo 'add';

    if (is_array($data)) {
       // echo 'pay';
        //$invoice_id =$data['item_number'];
        $item_number = trim(preg_replace('/\s+/', '', $data['item_number']));
        //$item_number = 'KD072004722';

        try {
            if (strpos($item_number, 'KDG') !== false){
                $invoice_no = $db->real_escape_string($item_number);
                $results = $db->query("UPDATE group_order SET payment_status = 2, payment_time= NOW(), payment_method=3 WHERE invoice_no =  '$invoice_no'");
            }
            $invoice_no = $db->real_escape_string($item_number);
            $results = $db->query("UPDATE order_master SET payment_status = 2, payment_time= NOW(), payment_method=3 WHERE invoice_no =  '$invoice_no'");

        }catch (Exception $e){}

        return true;

        /*
             $dateT = date('Y-m-d H:i:s');
             $method = 0;

             $stmt = $db->prepare('INSERT INTO `payments` (txnid, payment_amount, payment_status,method, itemid, createdtime) VALUES(?, ?, ?, ?, ?)');
             $stmt->bind_param(
                 'sdsss',
                 $data['txn_id'],
                 $data['payment_amount'],
                 $data['payment_status'],
                 $method,
                 $item_number,
                 $dateT
             );
             $stmt->execute();
             $stmt->close();

             return $db->insert_id;
             */
    }

    return false;
}