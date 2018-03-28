<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2017/1/23
 * Time: 上午12:06
 */

namespace Conf;


use Core\AbstractInterface\AbstractEvent;
use Core\Component\Di;
use Core\Component\Logger;
use Core\Component\Version\Control;
use Core\Http\Request;
use Core\Http\Response;
use Core\Swoole\AsyncTaskManager;
use Core\Swoole\Server;

class Event extends AbstractEvent
{
    function frameInitialize()
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    function frameInitialized()
    {
        // TODO: Implement frameInitialized() method.
    }


    function beforeWorkerStart(\swoole_server $server)
    {
        // TODO: Implement beforeWorkerStart() method.
        $listener = $server->addlistener('0.0.0.0', '9502', SWOOLE_TCP);
        $listener->set([
            'open_eof_check' => false,
            'package_max_length' => 2048
        ]);
        $listener->on('connect', function (\swoole_server $swoole_server, $fd) {
            Logger::getInstance()->console('client connect');
        });
        $listener->on('receive', function (\swoole_server $swoole_server, $fd, $from_id, $data) {
            Logger::getInstance()->console('received data : ' . $data);
            $swoole_server->send($fd, 'swoole ' . $data . ' at time: ' . time());
        });
        $listener->on('close', function (\swoole_server $swoole_server, $fd) {
            Logger::getInstance()->console('client close');
        });
    }

    function onStart(\swoole_server $server)
    {
        // TODO: Implement onStart() method.
    }

    function onShutdown(\swoole_server $server)
    {
        // TODO: Implement onShutdown() method.
    }

    function onWorkerStart(\swoole_server $server, $workerId)
    {
        // TODO: Implement onWorkerStart() method.
    }

    function onWorkerStop(\swoole_server $server, $workerId)
    {
        // TODO: Implement onWorkerStop() method.
    }

    function onRequest(Request $request, Response $response)
    {
        // TODO: Implement onRequest() method.
    }

    function onDispatcher(Request $request, Response $response, $targetControllerClass, $targetAction)
    {
        // TODO: Implement onDispatcher() method.
    }

    function onResponse(Request $request, Response $response)
    {
        // TODO: Implement afterResponse() method.
    }

    function onTask(\swoole_server $server, $taskId, $workerId, $taskObj)
    {
        // TODO: Implement onTask() method.
    }

    function onFinish(\swoole_server $server, $taskId, $taskObj)
    {
        // TODO: Implement onFinish() method.
    }

    function onWorkerError(\swoole_server $server, $worker_id, $worker_pid, $exit_code)
    {
        // TODO: Implement onWorkerError() method.
    }
}
