<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    private int $statusCode = 200;
    private function setStatusCode($statusCode){
        $this->statusCode = $statusCode;
        return $this;
    }

    private function getStatusCode() : int{
        return $this->statusCode;
    }
    public function successResponse($message) : JsonResponse
    {
        return new JsonResponse(["status"=>$this->getStatusCode(), "result"=>$message], $this->getStatusCode());
    }

    public function errorResponse($err) : JsonResponse
    {
        $errors = $this->isJson($err) ? json_decode($err) : $err;
        return new JsonResponse(["status"=>$this->getStatusCode(),"error"=>$errors], $this->getStatusCode());
    }
    private function isJson($string) : bool{
        return is_string($string) && is_array(json_decode($string, true));
    }
}

