<?php
namespace App\Consts;

class SexConst
{
    const NOT_KNOWN = 0;

    const MALE = 1;

    const FEMALE = 2;

    const NOT_APPLICABLE = 9;

    const NOT_KNOWN_NAME = '未回答';

    const MALE_NAME = '男性';

    const FEMALE_NAME = '女性';

    const NOT_APPLICABLE_NAME = 'その他';

    const List = [
        self::NOT_KNOWN => self::NOT_KNOWN_NAME,
        self::MALE => self::MALE_NAME,
        self::FEMALE => self::FEMALE_NAME,
        self::NOT_APPLICABLE => self::NOT_APPLICABLE_NAME
    ];
}