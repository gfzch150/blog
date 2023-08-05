<?php

namespace App\Exceptions;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;







class Handler extends ExceptionHandler
{
    
    
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];
    public function errorResponse($message , $status, $code=null ){
        $code = $code ?? $status;
        return response()->json(
            [
                'message' => $message ,
                'code' => $code
            ],
            $status
        );
        }
    

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        
        if($exception instanceof ModelNotFoundException){
                return $this->errorResponse(
                    '無法找到資源'  ,    
                    Response::HTTP_NOT_FOUND
            );
            }
        if ($exception instanceof NotFoundHttpException){
            return $this->errorResponse(
                
                    '無法找到網址',
                Response::HTTP_NOT_FOUND
            );
        }
        if($exception instanceof MethodNotAllowedHttpException){
            return response()->json(
                [
                    'message' => 'get失敗'
                ],
                Response::HTTP_METHOD_NOT_ALLOWED
            );
        }
           
        }
       
    }
    

