<?php


namespace Itechpk\Brandedsms ;


class BrandedSms {

    private $username = null;
    private $apiKey = null;
    private $mask = null;
    private $returnType = 'json';

    public $lastCode = null;
    public $lastReply = null;
    public $lastId = null;
    public $lastSts = false;

    /**
     * @param $userId
     * @param $key
     * @param $mask
     */
    public function config($userId, $key, $mask)
    {
        $this->username = $userId;
        $this->apiKey = $key;
        $this->mask = $mask;
    }

    /**
     * @param $to
     * @param $sms
     * @return bool
     */
    public function send($to, $sms)
    {
        // Configuration variables
        $id = $this->username;
        $key = $this->apiKey;
        $mask = $this->mask;

        // Data for text message
        $to = str_replace("+","",$to);
        $message = $sms;
        // must URL encode to safely send all characters to the API URL
        $message = urlencode($message);
        // Prepare data for POST request
        $data = "id=".$id."&key=".$key."&mask=".$mask."&to=".$to."&msg=".$message;
        // Send the POST request with cURL
        $ch = curl_init('http://www.brandedsms.pk/api/sendsms.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $this->parseResult($result);
    }

    /**
     * @param $res
     * @return bool
     */
    private function parseResult($res)
    {
        if($res != null)
        {
            if($this->returnType == 'json')
            {
                $jobj = json_decode($res,true);
                /// 2nd parameter true converts the result into array
                $this->lastId = $jobj['id'];
                $this->lastCode = $jobj['code'];
                $this->lastReply = $jobj['response'];
                if(strtolower($jobj['type']) == 'success')
                    $this->lastSts = true;
                else
                    $this->lastSts = false;

                return $this->lastSts;
            }
            else
            {
                $this->lastSts = false;
                $this->lastReply = 'return type is not json';
                $this->lastCode = 999;
                $this->lastId = null;
                return false;
            }
        }
        else
        {
            $this->lastSts = false;
            $this->lastReply = 'result is null';
            $this->lastCode = 999;
            $this->lastId = null;
            return false;
        }
    }

}//class end