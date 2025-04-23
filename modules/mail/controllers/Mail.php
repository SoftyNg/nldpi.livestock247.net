<?php

class Mail extends  Trongate {
    private $api_key = 'wSsVR613+xOhX/9/yjardu86m1VVAFzyFhws21Oi4iSvF/+Q8MdvwhabUQ+vH/ZMQ2RvHGdBou5/nxgB0TQKjNp8mQxUXSiF9mqRe1U4J3x17qnvhDzIWmhYkhKMJIMMwg1qmWdgFcsn+g==';
    private $api_url = 'https://api.zeptomail.com/v1.1/email';
    private $from_email = 'app@livestock247.net';
    private $from_name = 'NLDPI';
    private $reply_to = 'noreply@livestock247.net';
    
    public function send_mail($data){
        $subject = $data['subject'];
        $target_email = $data['target_email'];
        $target_name = $data['target_name'];
        
        if ($data['msg_html'] == '') {
            $msgHTML = '<p>No message here. Sorry...</p>';
            $msgPLAIN = 'No message here. Sorry...';
        } else {
            $msgHTML = $data['msg_html'];
            $msgPLAIN = $data['msg_plain'];
        }
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(array(
                "from" => array("address" => $this->from_email, "name" => $this->from_name),
                "to" => array(array("email_address" => array("address" => $target_email, "name" => $target_name))),
                "subject" => $subject,
                "htmlbody" => $msgHTML,
                "textbody" => $msgPLAIN,
                "reply_to" => array(array("address" => $this->reply_to))
            )),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Zoho-enczapikey " . $this->api_key,
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
            return false;
        } else {
            echo $response;
            return true;
        }
    }
}