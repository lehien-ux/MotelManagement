<?php

namespace App\Enums;

class Constant extends BaseEnum
{
    const MONTH = [
        1 => 'Tháng 1',
        2 => 'Tháng 2',
        3 => 'Tháng 3',
        4 => 'Tháng 4',
        5 => 'Tháng 5',
        6 => 'Tháng 6',
        7 => 'Tháng 7',
        8 => 'Tháng 8',
        9 => 'Tháng 9',
        10 => 'Tháng 10',
        11 => 'Tháng 11',
        12 => 'Tháng 12',
    ];

    const CONTRACT_ACTIVE = 1;
    const CONTRACT_EXPIRED = 0;
    const CONTRACT_PENDING = 2;
    const WAIT_ADMIN_CONFIRM = 3;

    //room
    const ROOM_FREE = 0;
    const ROOM_NOT_FREE = 1;
    const TRANSPLANT = 1;

    const PAID = 1;
    const NOT_PAY = 0;

    const TWO_YEARS = 63072000;

    const OVERDUE_15_DAY = 15;
    const MIN_DAY_OF_CONTRACT = 2592000;
}