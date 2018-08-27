<?php

/**
 * @return bool
 *
 * Function for response connection error (503)
 */
function connectionError()
{
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    echo("503 Service Temporarily Unavailable");
    return false;
}

/**
 * @return bool
 *
 * Function for response not found error (404)
 */
function notFoundError()
{
    header('HTTP/1.1 404 Not Found');
    echo("404 Not Found");
}

/**
 * @return bool
 *
 * Function for response bad request error (400)
 */
function badRequestError()
{
    header('HTTP/1.1 400 Bad Request');
    echo("400 Bad Request");
}