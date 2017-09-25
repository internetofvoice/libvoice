<?php

namespace Alexa\_Legacy;

class Card
{
    public $type = 'Simple';
    public $title = '';
    public $content = '';

    /**
     * @return array
     */
    public function render()
    {
        return array(
            'type' => $this->type,
            'title' => $this->title,
            'content' => $this->content,
        );
    }
}
