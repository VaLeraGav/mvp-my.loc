<?php

namespace Core;

class ErrorHandler
{
    private array $errors = [
        'Exception' => 'Exception',
        '1' => 'E_ERROR',
        '2' => 'E_WARNING',
        '4' => 'E_PARSE',
        '8' => 'E_NOTICE',
        '16' => 'E_CORE_ERROR',
        '32' => 'E_CORE_WARNING',
        '64' => 'E_COMPILE_ERROR',
        '256' => 'E_USER_ERROR',
        '512' => 'E_USER_WARNING',
        '1024' => 'E_USER_NOTICE',
        '4096' => 'E_RECOVERABLE_ERROR',
        '8192' => 'E_DEPRECATED',
        '16384' => 'E_USER_DEPRECATED',
    ];

    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1); // показывать все ошибки
        } else {
            error_reporting(0); // не показывать ошибки
        }
        set_error_handler([$this, 'errorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
        register_shutdown_function([$this, 'fatalErrorHandler']); // зарегистрировать функцию с  error_get_last

        ob_start(); // для того чтобы не выводить ошибки от встроенного PHP, при фатальных
    }

    public function restoreErrorHandler(): void
    {
        restore_error_handler();
    }

    public function errorHandler($errno, $errstr, $errfile, $errline): bool
    {
        $this->logErrors($errno, $errstr, $errfile, $errline);

        $typeOfCaughtErrors = [E_USER_ERROR, E_RECOVERABLE_ERROR];

        if (DEBUG || in_array($errno, $typeOfCaughtErrors)) {
            $this->displayError($errno, $errstr, $errfile, $errline);
        }

        return true;
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        $constError = $this->errors[$errno];
        http_response_code($response);
        if ($response == 404 && !DEBUG) {
            require VIEW . '/errors/404.php';
            die;
        }
        if (DEBUG) {
            require VIEW . '/errors/dev.php';
        } else {
            require VIEW . '/errors/prod.php';
        }
        die;
    }

    public function fatalErrorHandler(): void
    {
        $error = error_get_last();

        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logErrors($error['type'], $error['message'], $error['file'], $error['line']);

            ob_end_clean();

            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    public function exceptionHandler($e): bool
    {
        $this->logErrors('Exception', $e->getMessage(), $e->getFile(), $e->getLine());

        $this->displayError(
            'Exception',
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            // $e->getCode() - выкидывает ошибку при SQLSTATE[HY000]
        );
        return true;
    }

    protected function logErrors($error, $message = '', $file = '', $line = ''): void
    {
        $log = new Logger('errorHand');
        $backtrace = [
            [
                'file' => $file,
                'line' => $line
            ]
        ];

        $path = TMP . '/errorHandler.log';
        $log->setLogFile($path);

        if (!file_exists($path)) {
            throw new \Exception("Не нашел путь в logErrors {$path}");
        }

        $constError = $this->errors[$error] ?? "Indefinite ERROR";

        $log->setMessage($constError, $message, $backtrace);
        error_log(
            $log->getMessage() . PHP_EOL,
            3,
            $path
        );
    }

}