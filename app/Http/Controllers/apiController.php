<?php

namespace App\Http\Controllers;

use League\Fractal\Manager;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Pagination\CursorInterface;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class apiController extends Controller
{
    protected $statusCode = 200;

    const CODE_WRONG_ARGS = 'WRONG-ARGUMENTS';
    const CODE_NOT_FOUND = 'NOT-FOUND';
    const CODE_INTERNAL_ERROR = 'INTERNAL-ERROR';
    const CODE_UNAUTHORISED = 'UNAUTHORISED';
    const CODE_FORBIDDEN = 'FORBIDDEN';

    /**
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
        if (isset($_GET['include'])) {
            $fractal->parseIncludes($_GET['include']);
        }
    }

    /**
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Returns a single item JSON Response.
     *
     * @param $item
     * @param $callback
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithItem($item, $callback)
    {
        $resource = new item($item, $callback);
        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * Returns a collection as a JSON Array.
     *
     * @param $collection
     * @param $callback
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);
        $rootScope = $this->fractal->createData($resource);

        return $this->respondwithArray($rootScope->toArray());
    }

    /**
     * Returns a JSON Array along with a cursor for pagination.
     *
     * @param $collection
     * @param $callback
     * @param CursorInterface $cursor
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithCursor($collection, $callback, CursorInterface $cursor)
    {
        $resource = new Collection($collection, $callback);
        $resource->setCursor($cursor);
        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * @param array $array
     * @param array $headers
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        return Response()->json($array, $this->statusCode, $headers);
    }

    /**
     * Returns a Error as JSON.
     *
     * @param $message
     * @param $errorCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error('You better have a good reason for triggering an error with a 200 status code', E_USER_WARNING);
        }

        return $this->respondWithArray([
           'error' => [
               'code'       => $errorCode,
               'http_code'  => $this->statusCode,
               'message'    => $message,
           ],
        ]);
    }

    /**
     * Generates a response with a 403 Forbidden header and Error message.
     *
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message, self::CODE_FORBIDDEN);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->respondWithError($message, Self::CODE_INTERNAL_ERROR);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function errorNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message, Self::CODE_NOT_FOUND);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function errorUnauthorised($message = 'Unauthorised')
    {
        return $this->setStatusCode(401)->respondWithError($message, Self::CODE_UNAUTHORISED);
    }

    /**
     * @param string $message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(403)->respondWithError($message, Self::CODE_WRONG_ARGS);
    }
}
