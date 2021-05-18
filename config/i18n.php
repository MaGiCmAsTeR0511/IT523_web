<?php
return [
    'sourcePath' => __DIR__. '\..' . DIRECTORY_SEPARATOR . 'models',
    'languages' => ['de-AT'], //Add languages to the array for the language files to be generated.
    'translator' => 'Yii::t',
    'sort' => false,
    'removeUnused' => false,
    'only' => ['*.php'],
    'format' => 'php',
    'messagePath' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'messages',
    'overwrite' => true,
];