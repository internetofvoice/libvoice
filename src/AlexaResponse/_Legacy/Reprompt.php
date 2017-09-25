<?php

namespace Alexa\_Legacy;

class Reprompt
{
    public $outputSpeech;

    public function __construct()
    {
        $this->outputSpeech = new OutputSpeech;
    }

    /**
     * @return array
     */
    public function render()
    {
        return array(
            'outputSpeech' => $this->outputSpeech->render()
        );
    }
}
