<?php

return [

    /*
    |--------------------------------------------------------------------------
    | DotEnv Vault Path
    |--------------------------------------------------------------------------
    |
    | Here you may specify the path to where your .env.vault is located.
    | To create one, follow the instructions from: https://www.dotenv.org/docs
    |
    */
    'path' => base_path(),

    /*
    |--------------------------------------------------------------------------
    | DotEnv Vault Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify the name of your .env.vault file if you're using a
    | different filename. Learn more about the vault file from:
    | https://www.dotenv.org/docs/security/env-vault
    |
    */
    'vault_name' => '.env.vault',


    /*
    |--------------------------------------------------------------------------
    | DotEnv Vault Key
    |--------------------------------------------------------------------------
    |
    | Here you may specify the name of your key.env file if you're using a
    | different filename.
    | THIS FILE MUST BE ADDED TO .gitignore!!
    | It should contain the secret decryption key for unlocking the vault.
    | example key contents:
    | DOTENV_KEY="dotenv://:key_abc123...@dotenv.local/vault/.env.vault?environment=development"
    |
    */
    'key_name' => 'key.env',
];
