<?php

interface LoggerInterface
{
    public function log();
}

class ConsoleLogger implements LoggerInterface
{
    public function log()
    {
        return ("enregistrement console log\n");
    }
}

class FileLogger implements LoggerInterface
{
    public function log()
    {
        return ("enregistrement file log\n");
    }
}

class DBLogger implements LoggerInterface
{
    public function log()
    {
        return ("enregistrement db log\n");
    }
}


class LogFactory
{
    public static function enregisterLog($type)
    {
        switch ($type) {
            case 'fileLogger':
                $log = new ConsoleLogger();
                return $log->log();
            case 'consoleLogger':
                $log = new FileLogger();
                return $log->log();
            case 'DbLogger':
                $log = new DBLogger();
                return $log->log();
            default:
                throw new Exception('logger non trouvé');
        }

        return $log;
    }
}

$db = LogFactory::enregisterLog('fileLogger');
$db2 = LogFactory::enregisterLog('consoleLogger');
print_r($db);
print_r($db2);

