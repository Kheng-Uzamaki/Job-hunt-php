<?php

namespace App\Controllers;


class ErrorController
{


    /**
     * 404 not found error
     *
     * @return void
     */
    public static function notFound($message = 'Ressource not found')
    {
        http_response_code(404);
        loadView('error', [
            'status' => '404',
            'message' => $message
        ]);
    }

    /**
     * 403 unauthorize error
     *
     * @return void
     */
    public static function unauthorized($message = 'You are not authorized to access this!')
    {
        http_response_code(403);
        loadView('error', [
            'status' => '403',
            'message' => $message
        ]);
    }
}
