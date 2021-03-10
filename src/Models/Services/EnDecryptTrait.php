<?php

namespace WalkerChiu\Core\Models\Services;

Trait EnDecryptTrait
{
    /**
     * AES Encrypt
     *
     * @param String $parameter
     * @param String $key
     * @param String $iv
     * @return String
     */
    public function create_mpg_aes_encrypt($parameter = '', $key = '', $iv = '')
    {
        $return_str = '';

        if (!empty($parameter))
            $return_str = http_build_query($parameter);

        return trim(
            bin2hex(
                mcrypt_encrypt(
                    MCRYPT_RIJNDAEL_128,
                    $key,
                    $this->addpadding($return_str),
                    MCRYPT_MODE_CBC,
                    $iv
                )
            )
        );
    }

    private function addpadding(String $string, $blocksize = 32)
    {
        $len = strlen($string);
        $pad = $blocksize - ($len % $blocksize);
        $string .= str_repeat(chr($pad), $pad);

        return $string;
    }

    /**
     * AES Decrypt
     *
     * @param String $aes_str
     * @param String $key
     * @param String $iv
     * @return String
     */
    public function aes_decrypt(String $aes_str, String $key, String $iv)
    {
        $aes_str = str_replace(' ', '+', $aes_str);

        return $this->strippadding(
            mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128,
                $key,
                hex2bin($aes_str),
                MCRYPT_MODE_CBC,
                $iv
            )
        );
    }

    private function strippadding(String $string)
    {
        $slast = ord(substr($string, -1));
        $slastc = chr($slast);
        $pcheck = substr($string, -$slast);

        if (preg_match("/$slastc{" . $slast . "}/", $string))
            return substr($string, 0, strlen($string) - $slast);
        else
            return false;
    }



    /**
     * @param String $encryptText
     * @param String $encryptKey
     * @return String
     * 
     */
    function HmacSHA1Base64Encrypt(String $encryptText, String $encryptKey)
    {
        $signature = '';

        if (function_exists('hash_hmac')) {
            $hash_hmac = hash_hmac("sha1", $encryptText,$encryptKey,true);
            $signature = base64_encode($hash_hmac);
        } else {
            $blocksize = 64;
            $hashfunc  = 'sha1';

            if (strlen($encryptKey) > $blocksize) {
              $encryptKey = pack("H*", $hashfunc($encryptKey));
            }

            $encryptKey = str_pad($encryptKey, $blocksize, chr(0x00));
            $ipad = str_repeat(chr(0x36), $blocksize);
            $opad = str_repeat(chr(0x5c), $blocksize);
            $hmac = pack("H*", $hashfunc(($encryptKey ^ $opad).pack('H*', $hashfunc(($encryptKey ^ $ipad).$str))));
            $signature = base64_encode($hmac);
        }

        return $signature;
    }



    /**
     * MCRYPT
     *
     * @param String $parameter
     * @param String $key
     * @param String $iv
     * @return String
     */
    public static function encrypt($security, String $input, String $key)
    {
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = $security->pkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);

        return $data;
    }

    private static function pkcs5_pad (String $text, Int $blocksize)
    { 
        $pad = $blocksize - (strlen($text) % $blocksize);

        return $text . str_repeat(chr($pad), $pad);
    }

    public static function decrypt(String $sStr, String $sKey)
    {
        $decrypted = mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            $sKey,
            base64_decode($sStr),
            MCRYPT_MODE_ECB
        );
        $dec_s = strlen($decrypted);
        $padding = ord($decrypted[$dec_s-1]);
        $decrypted = substr($decrypted, 0, -$padding);

        return $decrypted;
    }
}
