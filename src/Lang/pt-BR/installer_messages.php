<?php

return [

    /*
     *
     * Shared translations.
     *
     */
    'title' => 'Instalador Laravel',
    'next' => 'Próximo Passo',
    'finish' => 'Instalar',

    /*
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'templateTitle' => 'Bem-vindo',
        'title'   => 'Bem-vindo ao Instalador',
        'message' => 'Bem-vindo ao assistente de configuração.',
        'next'    => 'Checar Requisitos',
    ],

    /*
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => 'Passo 1 | Requisitos do Servidor',
        'title' => 'Requisitos',
        'next'    => 'Checar Permissões',
    ],

    /*
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => 'Passo 2 | Permissões',
        'title' => 'Permissões',
        'next' => 'Configurar Ambiente',
    ],

    /*
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'menu' => [
            'templateTitle' => 'Passo 3 | Configurações de Ambiente',
            'title' => 'Configurações de Ambiente',
            'desc' => 'Selecione como deseja configurar o arquivo <code>.env</code> do aplicativo.',
            'wizard-button' => 'Assistente Guiado',
            'classic-button' => 'Editor de Texto',
        ],
        'wizard' => [
            'templateTitle' => 'Passo 3 | Configurações de Ambiente | Assistente Guiado',
            'title' => 'Assistente <code>.env</code> Guiado',
            'tabs' => [
                'environment' => 'Ambiente',
                'database' => 'Banco de Dados',
                'application' => 'Aplicação',
            ],
            'form' => [
                'name_required' => 'É necessário um nome de ambiente.',
                'app_name_label' => 'Nome da Aplicação',
                'app_name_placeholder' => 'Nome da Aplicação',
                'app_environment_label' => 'Ambiente da Aplicação',
                'app_environment_label_local' => 'Local',
                'app_environment_label_developement' => 'Development',
                'app_environment_label_qa' => 'Qa',
                'app_environment_label_production' => 'Production',
                'app_environment_label_other' => 'Other',
                'app_environment_placeholder_other' => 'Digite seu ambiente...',
                'app_debug_label' => 'App Debug',
                'app_debug_label_true' => 'Ativado',
                'app_debug_label_false' => 'Desativado',
                'app_log_level_label' => 'App Log Level',
                'app_log_level_label_debug' => 'debug',
                'app_log_level_label_info' => 'info',
                'app_log_level_label_notice' => 'notice',
                'app_log_level_label_warning' => 'warning',
                'app_log_level_label_error' => 'error',
                'app_log_level_label_critical' => 'critical',
                'app_log_level_label_alert' => 'alert',
                'app_log_level_label_emergency' => 'emergency',
                'app_url_label' => 'App Url',
                'app_url_placeholder' => 'Url da Aplicação',
                'db_connection_failed' => 'Não pôde conectar com a base de dados.',
                'db_connection_label' => 'Conexão de Banco de Dados',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
                'db_host_label' => 'Host de banco de dados',
                'db_host_placeholder' => 'Host do Banco de Dados',
                'db_port_label' => 'Porta de Banco de Dados',
                'db_port_placeholder' => 'Porta do Banco de Dados',
                'db_name_label' => 'Nome do Banco de Dados',
                'db_name_placeholder' => 'Nome do Banco de Dados',
                'db_username_label' => 'Nome de usuário do Banco de Dados',
                'db_username_placeholder' => 'Nome de usuário do Banco de Dados',
                'db_password_label' => 'Senha do Banco de Dados',
                'db_password_placeholder' => 'Senha do Banco de Dados',

                'app_tabs' => [
                    'more_info' => 'Mais Informações',
                    'broadcasting_title' => 'Broadcasting, Caching, Session e Queue',
                    'broadcasting_label' => 'Driver de Broadcast',
                    'broadcasting_placeholder' => 'Driver de Broadcast',
                    'cache_label' => 'Driver de Cache',
                    'cache_placeholder' => 'Driver de Cache',
                    'session_label' => 'Driver de Sessão',
                    'session_placeholder' => 'Driver de Sessão',
                    'queue_label' => 'Driver de Queue',
                    'queue_placeholder' => 'Driver de Queue',
                    'redis_label' => 'Driver de Redis',
                    'redis_host' => 'Host do Redis',
                    'redis_password' => 'Password do Redis',
                    'redis_port' => 'Porta do Redis',

                    'mail_label' => 'Mail',
                    'mail_driver_label' => 'Driver de Email',
                    'mail_driver_placeholder' => 'Driver de Email',
                    'mail_host_label' => 'Host do Email',
                    'mail_host_placeholder' => 'Host do Email',
                    'mail_port_label' => 'Porta do Email',
                    'mail_port_placeholder' => 'Porta do Email',
                    'mail_username_label' => 'Usuário do Email',
                    'mail_username_placeholder' => 'Usuário do Email',
                    'mail_password_label' => 'Senha Email',
                    'mail_password_placeholder' => 'Senha Email',
                    'mail_encryption_label' => 'Criptografia Email',
                    'mail_encryption_placeholder' => 'Criptografia Email',

                    'pusher_label' => 'Pusher',
                    'pusher_app_id_label' => 'Pusher App Id',
                    'pusher_app_id_palceholder' => 'Pusher App Id',
                    'pusher_app_key_label' => 'Pusher App Key',
                    'pusher_app_key_palceholder' => 'Pusher App Key',
                    'pusher_app_secret_label' => 'Pusher App Secret',
                    'pusher_app_secret_palceholder' => 'Pusher App Secret',
                ],
                'buttons' => [
                    'setup_database' => 'Configurar Banco de Dados',
                    'setup_application' => 'Configurar Aplicação',
                    'install' => 'Instalar',
                ],
            ],
        ],
        'classic' => [
            'templateTitle' => 'Passo 3 | Configurações de Ambiente | Editor de Texto',
            'title' => 'Editor de Texto',
            'save' => 'Salvar .env',
            'back' => 'Usar Modo Guiado',
            'install' => 'Salvar e Instalar',
        ],
        'success' => 'Suas Configurações foram salvas no arquivo .env.',
        'errors' => 'Não foi possível salvar o arquivo .env, crie-o manualmente.',
    ],

    'install' => 'Instalar',

    /*
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'Instalador do Laravel INSTALADO com sucesso em ',
    ],

    /*
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'Terminado',
        'finished' => 'Aplicação foi instalada com sucesso',
        'exit' => 'Clique aqui para sair',
    ],

    /*
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'Fim da Instalação',
        'templateTitle' => 'Fim da Instalação',
        'finished' => 'Aplicação foi instalada com sucesso.',
        'migration' => 'Saída do Console de Migrations e Seeds :',
        'console' => 'Saída do console de Aplicação:',
        'log' => 'Entrada de registro de instalação:',
        'env' => 'Arquivo .env Final:',
        'exit' => 'Clique aqui para sair',
    ],
];
