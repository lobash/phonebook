<?php

return [
    'phone/delete' => 'phone/delete',
    'phone/add' => 'phone/add',
    'phone/view' => 'phone/view',
    'register' => 'register/index',
    '(\d+)' => 'phone/view/$1',
    '' => 'phone/index',
];