<?php

namespace App;


class MyCrypt
{
    private $public_key = <<<EOD
-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBANDiE2+Xi/WnO+s120NiiJhNyIButVu6
zxqlVzz0wy2j4kQVUC4ZRZD80IY+4wIiX2YxKBZKGnd2TtPkcJ/ljkUCAwEAAQ==
-----END PUBLIC KEY-----
EOD;
   public function decrypt($signature){
	   $data="vodolei";
	   $binary_signature =base64_decode($signature);
 	   $ok = openssl_verify($data, $binary_signature, $this->public_key, OPENSSL_ALGO_SHA1);
	   return $ok;
   }
}
