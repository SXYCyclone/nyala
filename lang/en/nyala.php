<?php

return [
    'profile' => [
        'export_personal_data' => [
            'grid_section_title' => 'Export Personal Data',
            'grid_section_description' => 'Export the data of your account for backup or transfer to another service.',
            'subheading' => 'You can export your personal data at any time. This will create a zip file containing all of your personal data. This file will be stored on the server for 30 days and then automatically deleted.',
            'button' => 'Export Personal Data',
            'modal_title' => 'Export Personal Data',
            'modal_description' => 'To keep your information secure, please confirm your password to continue.',
            'queueing' => 'Your personal data export has been queued. You will receive an email when it is ready. The time it takes to create the export depends on the amount of data you have stored on our platform. If you have a lot of data, it may take a while.',
        ],
    ],

    'game-server-type' => [
        'minecraft' => [
            'name' => 'Minecraft',
            'description' => 'Minecraft is a sandbox video game developed by Mojang. The game allows players to build with a variety of different blocks in a 3D procedurally generated world, requiring creativity from players. Other activities in the game include exploration, resource gathering, crafting, and combat.',
        ],
        'minecraft-bedrock' => [
            'name' => 'Minecraft Bedrock',
            'description' => 'Minecraft Bedrock is a version of Minecraft developed by Mojang AB for mobile devices, consoles, and Windows 10. Minecraft Bedrock is the same game as Minecraft Java Edition.',
        ],
    ],

    'game-server-protocol' => [
        'source-rcon' => [
            'name' => 'Source RCON',
            'description' => 'Source RCON can be used to interact with game servers for issuing commands.',
        ],
        'gamespy4' => [
            'name' => 'GameSpy 4',
            'description' => 'GameSpy 4 can be used to query game servers for information such as the current map, number of players, and more.',
        ],
        'minecraft-ping' => [
            'name' => 'Minecraft Ping',
            'description' => 'Minecraft Ping can be used to query Minecraft servers for information such as the current map, number of players, and more.',
        ],
    ],
];
