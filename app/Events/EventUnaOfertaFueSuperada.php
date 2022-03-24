<?php

namespace App\Events;

class EventUnaOfertaFueSuperada
{

    public $item_id;
    public $user_id;

    public function __construct($item,$user_id)
    {
        $this->item_id = $item;
        $this->user_id = $user_id;
    }

}
