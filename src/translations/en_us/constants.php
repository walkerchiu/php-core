<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Constants
    |--------------------------------------------------------------------------
    |
    */

    'constant' => 'Constant',

    'condition' => [
        '='  => 'A equals B',
        '!=' => 'A is not equal to B',
        '<'  => 'A is less than B',
        '<=' => 'A is less than or equals to B',
        '>'  => 'A is greater than B',
        '>=' => 'A is greater than or equals to B',
        'in'     => 'A is in B',
        'not in' => 'A is not in B',
        '&&'     => 'A AND B',
        '||'     => 'A OR B'
    ],
    'dataType' => [
        'array'          => 'Array',
        'boolean'        => 'Boolean',
        'datetime'       => 'Datetime',
        'int'            => 'Integer',
        'int_positive'   => 'Integer (Positive)',
        'int_unsigned'   => 'Integer (Unsigned)',
        'float'          => 'Float',
        'float_positive' => 'Float (Positive)',
        'float_unsigned' => 'Float (Unsigned)',
        'json'           => 'JSON',
        'string'         => 'String',
        'xml'            => 'XML'
    ],
    'filter' => [
        '*'  => 'Every one',
        '/'  => 'Only first :value',
        '/+' => 'Every :value intervals',
        '/~' => 'Every greater than :value',
        '~/' => 'Every less than :value'
    ],
    'operator' => [
        '='  => 'Assign',
        '+=' => 'Sum and Assign',
        '-=' => 'Subtract and Assign',
        '*=' => 'Multiply and Assign',
        '/=' => 'Divide and Assign',
        'after'   => 'After',
        'append'  => 'Append',
        'before'  => 'Before',
        'prepend' => 'Prepend'
    ]
];
