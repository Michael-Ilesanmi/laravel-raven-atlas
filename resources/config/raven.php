<?php

/*
 * This file is part of the Laravel Raven Atlas package.
 *
 * (c) Ilesanmi Michael - localdev <ioluwamichael@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /**
     * Public Key: Your Raven Atlas Public Key. Go to https://atlas.getravenbank.com/user/settings to get yours
     *
     */
    'publicKey' => env('RAVEN_PUBLIC_KEY'),

    /**
     * Secret: Your Raven Atlas Secret. Go to https://atlas.getravenbank.com/user/settings to get yours
     *
     */
    'secretKey' => env('RAVEN_SECRET_KEY'),

    /**
     * Base URL
     *
     */
    'baseUrl' => env('RAVEN_BASE_URL', 'https://integrations.getravenbank.com/v1/'),
    
    /**
     * Webhook Secret: Your Raven Atlas Webhook Secret. Go to https://atlas.getravenbank.com/user/settings to get yours
     *
     */
    'webhookSecret' => env('RAVEN_WEBHOOK_SECRET'),
];
