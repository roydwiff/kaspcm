<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Authorization_Token
{
    protected $ci;
    protected $token_key;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->token_key = 'dbeee579a71ac892b2ea6da30ebeee05894d0a11'; // Ganti dengan secret key kamu
    }

    public function generateToken($data)
    {
        $payload = array(
            'iat' => time(),
            'exp' => time() + (1 * 1), // token 1 jam
            'data' => $data
        );

        return JWT::encode($payload, $this->token_key, 'HS256');
    }

    public function validateToken()
    {
        $headers = $this->getAuthorizationHeader();
        $token = $this->getBearerToken($headers);

        if (!$token) {
            return false;
        }

        try {
            $decoded = JWT::decode($token, new Key($this->token_key, 'HS256'));
            return (array) $decoded->data;
        } catch (Exception $e) {
            return false;
        }
    }

    private function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $headers = isset($requestHeaders['Authorization']) ? trim($requestHeaders['Authorization']) : null;
        }
        return $headers;
    }

    private function getBearerToken($header)
    {
        if (!empty($header)) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}
