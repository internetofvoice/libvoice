<?php

namespace Alexa\Response;

class OutputSpeech
{
    public $type = 'PlainText';
    public $text = '';
    public $ssml = '';

    /**
     * @return array
     */
    public function render()
    {
        $reply = array(
            'type' => $this->type,
            'text' => $this->text
        );

        switch ($this->type) {
            case 'SSML':
                $reply = array(
                    'type' => $this->type,
                    'ssml' => $this->ssml
                );
        }

        return $reply;
    }
}
