<?
namespace Onishchenko\Build;

class Recaptcha{

    public static function checkGoogleAPI(){
        if(\COption::GetOptionString("main", "open_google_recaptcha_key", "") && \COption::GetOptionString("main", "secret_google_recaptcha_key", "")){
            return true;
        }
        else{
            return false;
        }

    }

    public static function checkValidRecaptcha($recaptcha){
        if(!empty($recaptcha)) {
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=".\COption::GetOptionString("main", "secret_google_recaptcha_key", "")."&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR'];
            if(\COption::GetOptionString("main", "method", "") == 'curl'){
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_TIMEOUT, 10);
                $curlData = curl_exec($curl);
                curl_close($curl);
                $curlData = json_decode($curlData, true);
            }
            else{
                $curlData = json_decode(file_get_contents($url), true);
            }

            if($curlData['success']) {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

}
?>