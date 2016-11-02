<?php

/*
 * This File includes a result class to retrieve one object as basic object
 */

namespace Christianparadies\Equipment;

/**
 * Provides a message type ajar to twitter bootstrap style.
 *
 * This class is able to store data and a message. Also its possible to check
 * if the result is valid or not.
 *
 * @author cparadies
 */
class Result
{
    /**
     * @var boolean is valid or not
     */
    protected $valid;

    /**
     * @var string Message of the result
     */
    protected $message;

    /**
     * @var int the type of the message
     */
    protected $messageType;

    /**
     * @var mixed the data for the result
     */
    protected $data;

    /**
     * @var int default message
     */
    const DEFAULT_MESSAGE = 0;

    /**
     * @var int success message
     */
    const SUCCESS_MESSAGE = 1;

    /**
     * @var int info message
     */
    const INFO_MESSAGE = 2;

    /**
     * @var int warning message
     */
    const WARNING_MESSAGE = 3;

    /**
     * @var int error message
     */
    const ERROR_MESSAGE = 4;

    /**
     * Checks if this result is valid
     * @return boolean
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * Get the message set to this result
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get the message type for this result.
     *
     * @return int
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Get data for this result. This data could be mixed data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set valid for this object
     *
     * @param boolean $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    /**
     * Set the message for this object
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Set the message type for this object.
     *
     * To set the message type use the constants of this class like
     * Result::ERROR_MESSAGE
     * @param int $messageType
     */
    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;
    }

    /**
     * Set the data associated with this result
     *
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Convert object to json
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Convert result object to array
     *
     * @return array
     */
    public function toArray()
    {
        $result['result']['message'] = $this->getMessage();
        $result['result']['messageType'] = $this->getMessageType();
        $result['result']['data'] = $this->getData();
        $result['result']['valid'] = $this->isValid();

        return $result;
    }

    /**
     * Get a new instance of a result
     *
     * @param string $message
     * @param int $messageType
     * @param mixed $data
     * @param boolean $valid
     * @return \Christianparadies\Equipment\Result
     */
    public static function getResult(
        $message,
        $messageType,
        $data,
        $valid
    ) {
        $result = new Result();
        $result->setMessage($message);
        $result->setMessageType($messageType);
        $result->setValid($valid);
        $result->setData($data);

        return $result;
    }
}
