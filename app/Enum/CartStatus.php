<?php
namespace App\Enum;
enum CartStatus: string{
    case Default = 'defaults';
    case Progressing = 'progressing';
    case Progressed = 'progressed';
    case Paid = 'paid';
}

?>