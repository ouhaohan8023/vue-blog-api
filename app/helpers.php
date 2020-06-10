<?php
function callMake($data, $code = 200, $msg = 'success')
{
    $ctx['data'] = $data;
    $ctx['code'] = $code;
    $ctx['msg'] = $msg;
    return $ctx;
}
