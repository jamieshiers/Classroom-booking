<?php

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;

class ApiController extends Controller {


    protected $statusCode = 200;

    const CODE_WRONG_ARGS = 'Wrong Arguments Supplied';
    const CODE_UNAUTHORIZED  = "Unauthorised";
    const CODE_INTERNAL_ERROR = "Internal Error";
    const CODE_FORBIDDEN = "Forbidden";

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    public function setStatusCode()
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function getStatusCode()
    {
        $this->statusCode;
    }

    protected function respondWithItem($item, $callback)
    {
        $resouce = new item($item, $callback);
        $rootScope = $this->fractal->createData($resource);
        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithCollection($collection, $callback){

        $resource = new collection($collection, $callback);
        $rootScope = $this->fractal->createData($resource);
        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithArray(array $array, array $headers = [])
    {
        return Response::json($array, $this->statusCode, $headers);
    }

    protected function respondWithError($message, $errorCode)
    {
        if($this->statusCode === 200)
            {
                trigger_error(
                    "You better have a good reason for triggering an error with a 200 status code", E_USER_WARNING
                    );
            }

        return $this->respondWithArray([
                'error' => [
                    'code'      => $errorCode, 
                    'http_code' => $this->statusCode,
                    'message'   => $message,
                ]
            ]);
    }




}