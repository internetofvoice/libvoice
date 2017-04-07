<?php
/**
 * @file Application.php
 *
 * The application abstraction layer to provide Application ID validation to
 * Alexa requests. Any implementations might provide their own implementations
 * via the $request->setApplicationAbstraction() function but must provide the
 * validateApplicationId() function.
 */

namespace Alexa\Request;

use InvalidArgumentException;

class Application
{
    public $applicationId;
    public $requestApplicationId;

    /**
     * Application constructor.
     * @param string $applicationId
     */
    public function __construct($applicationId)
    {
        $this->applicationId = preg_split('/,/', $applicationId);
    }

    /**
     * @param string $applicationId
     */
    public function setRequestApplicationId($applicationId)
    {
        $this->requestApplicationId = $applicationId;
    }

    /**
     * Validate that the request Application ID matches our Application. This is required as per Amazon requirements.
     *
     * @param string $requestApplicationId
     * @throws InvalidArgumentException
     */
    public function validateApplicationId($requestApplicationId = "")
    {
        if (empty($requestApplicationId)) {
            $requestApplicationId = $this->requestApplicationId;
        }

        if (!in_array($requestApplicationId, $this->applicationId)) {
            throw new InvalidArgumentException('Application Id not matched');
        }
    }
}
