<?php

namespace Crasmedia\CloudFlare\Response;

use GuzzleHttp\Psr7\Response as GuzzleResponseInterface;

class GuzzleResponse implements ResponseInterface
{
    /**
     * Response data.
     *
     * @var \stdClass
     */
    protected $data;

    function __construct(GuzzleResponseInterface $response)
    {
        $this->data = json_decode($response->getBody(), true);
    }

    public function __get($property)
    {
        return $this->data['result'][$property];
    }

    public function getData()
    {
        return $this->data['result'];
    }

    public function getErrors()
    {
        return count($this->data['errors']) ? $this->data['errors'] : null;
    }

    public function didSucceed()
    {
        return $this->data['success'];
    }
}