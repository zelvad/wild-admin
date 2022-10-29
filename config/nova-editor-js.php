<?php

return [
    /**
     * Configure tools
     */
    'toolSettings' => [
        'header' => [
            'activated' => true,
            'placeholder' => 'Heading',
            'shortcut' => 'CMD+SHIFT+H'
        ],
        'list' => [
            'activated' => true,
            'inlineToolbar' => true,
            'shortcut' => 'CMD+SHIFT+L'
        ],
        'code' => [
            'activated' => true,
            'placeholder' => '',
            'shortcut' => 'CMD+SHIFT+C'
        ],
        'link' => [
            'activated' => false,
            'shortcut' => 'CMD+SHIFT+L'
        ],
        'image' => [
            'activated' => true,
            'shortcut' => 'CMD+SHIFT+I',
            'path' => 'public/images',
            'disk' => 'local'
        ],
        'inlineCode' => [
            'activated' => true,
            'shortcut' => 'CMD+SHIFT+A',
        ],
        'checklist' => [
            'activated' => false,
            'inlineToolbar' => true,
            'shortcut' => 'CMD+SHIFT+J',
        ],
        'marker' => [
            'activated' => true,
            'shortcut' => 'CMD+SHIFT+M',
        ],
        'delimiter' => [
            'activated' => true,
        ],
        'table' => [
            'activated' => false,
            'inlineToolbar' => true,
        ],
        'embed' => [
            'activated' => true,
            'inlineToolbar' => true,
            'services' => [
                'codepen' => true,
                'imgur' => false,
                'vimeo' => true,
                'youtube' => true
            ],
        ],

        'raw' => [
            'activated' => false,
        ],

        'quote' => [
            'activated' => true,
        ],

        'paragraph' => [
            'activated' => true,
        ],

        'inline-code' => [
            'activated' => false,
        ],

        'heading' => [
            'activated' => true,
        ],

        'aling' => [
            'activated' => true,
        ],
    ],

    /**
     * Output validation config
     * https://github.com/editor-js/editorjs-php
     */
    'validationSettings' => [
        'tools' => [
            'header' => [
                'text' => [
                    'type' => 'string',
                ],
                'level' => [
                    'type' => 'int',
                    'canBeOnly' => [1, 2, 3, 4, 5]
                ]
            ],
            'paragraph' => [
                'text' => [
                    'type' => 'string',
                    'allowedTags' => 'i,b,u,a[href],span[class],code[class],mark[class]'
                ]
            ],
            'list' => [
                'style' => [
                    'type' => 'string',
                    'canBeOnly' =>
                        [
                            0 => 'ordered',
                            1 => 'unordered',
                        ],
                ],
                'items' => [
                    'type' => 'array',
                    'data' => [
                        '-' => [
                            'type' => 'string',
                            'allowedTags' => 'i,b,u',
                        ],
                    ],
                ],
            ],
            'image' => [
                'file' => [
                    'type' => 'array',
                    'data' => [
                        'url' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'caption' => [
                    'type' => 'string'
                ],
                'withBorder' => [
                    'type' => 'boolean'
                ],
                'withBackground' => [
                    'type' => 'boolean'
                ],
                'stretched' => [
                    'type' => 'boolean'
                ]
            ],
            'code' => [
                'code' => [
                    'type' => 'string'
                ]
            ],
            'linkTool' => [
                'link' => [
                    'type' => 'string'
                ],
                'meta' => [
                    'type' => 'array',
                    'data' => [
                        'title' => [
                            'type' => 'string',
                        ],
                        'description' => [
                            'type' => 'string',
                        ],
                        'image' => [
                            'type' => 'array',
                            'data' => [
                                'url' => [
                                    'type' => 'string',
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            'checklist' => [
                'items' => [
                    'type' => 'array',
                    'data' => [
                        '-' => [
                            'type' => 'array',
                            'data' => [
                                'text' => [
                                    'type' => 'string',
                                    'required' => false
                                ],
                                'checked' => [
                                    'type' => 'boolean',
                                    'required' => false
                                ],
                            ],

                        ],
                    ],
                ],
            ],
            'delimiter' => [

            ],
            'table' => [
                'content' => [
                    'type' => 'array',
                    'data' => [
                        '-' => [
                            'type' => 'array',
                            'data' => [
                                '-' => [
                                    'type' => 'string',
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'embed' => [
                'service' => [
                    'type' => 'string'
                ],
                'source' => [
                    'type' => 'string'
                ],
                'embed' => [
                    'type' => 'string'
                ],
                'width' => [
                    'type' => 'int'
                ],
                'height' => [
                    'type' => 'int'
                ],
                'caption' => [
                    'type' => 'string',
                    'required' => false,
                ],
            ]
        ]
    ]
];
