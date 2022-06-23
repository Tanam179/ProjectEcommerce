<?php
namespace App\Enum;
enum OrderStatus: string{
    case Progressing = 'progressing';
    case Progressed = 'progressed';
    case Paid = 'paid';
    case Cancel = 'cancel';
}

?>