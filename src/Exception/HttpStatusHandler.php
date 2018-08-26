<?php

function serviceUnavailable(){
    http_response_code(503);
    exit;
}