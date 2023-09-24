<?php

namespace App\Exceptions;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof \App\Repository\Exceptions\NotFoundException) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->getMessage(),
            ], \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return parent::render($request, $e);
    }
}
