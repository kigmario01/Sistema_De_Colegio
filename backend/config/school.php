<?php

return [
    'passing_score' => 10,
    'attendance' => [
        'warning_threshold' => 0.85,
        'critical_threshold' => 0.7,
    ],
    'notifications' => [
        'channels' => ['mail', 'database'],
    ],
];
