<?php

return [
    'pages' => [
        'homepage'         => 'Strona główna',
        'cinematographies' => 'Filmy i seriale',
        'my_account'       => 'Moje konto',
    ],
    'views' => [
        'components' => [
            'navbar'         => [
                'search' => [
                    'label'       => 'Wyszukiwarka',
                    'placeholder' => 'Co dzisiaj oglądamy?',
                ],
            ],
            'cinematography' => [
                'details' => [
                    'type'     => [
                        'series' => 'Serial',
                        'movie'  => 'Film',
                    ],
                    'duration' => [
                        'hours'   => 'godz',
                        'minutes' => 'min',
                    ],
                    'rates'    => [
                        'rates' => 'oceny',
                    ],
                ],
            ],
        ],
    ],
];
