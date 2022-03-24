<?php

namespace App\Models;

use App\Traits\FormatTimestamp;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use FormatTimestamp;
}
