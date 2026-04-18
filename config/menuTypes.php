<?php
if(config('default.subDivision'))
{
    return [
        'category',
        'officeDetail',
        'subDivision',
        'subordinate',


    ];
}
else
{
    return [
        'category',
        'officeDetail',
        'subordinate',

    ];
}
