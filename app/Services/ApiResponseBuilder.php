<?php

namespace App\Services;

class ApiResponseBuilder
{
    private ApiResponseService $response;
    public function __construct(){
        $this->response=new ApiResponseService();
    }

    public function message(string $message)
    {
        $this->response->setMessage($message);
        return $this;
    }
    public function data(mixed $data,int $code=200){
        $this->response->setData($data);
        $code!=200??$this->response->setCode($code);
        return $this;
    }

    public function get()
    {
        return $this->response;
    }

    public function response()
    {
        return $this->response->response();
    }
}
