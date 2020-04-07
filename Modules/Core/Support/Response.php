<?php

namespace Modules\Core\Support;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\JsonResource;

class Response implements Responsable
{
    /**
     * @var int
     */
    private int $code;

    /**
     * @var null
     */
    private $message;

    /**
     * @var array|null|JsonResource
     */
    private $data;

    /**
     * @var int|null
     */
    private ?int $statusCode;

    /**
     * Response constructor.
     * @param  int  $code
     * @param  array  $data
     * @param  null  $message
     * @param  int  $statusCode
     */
    public function __construct(int $code = ApiCode::CORE_SUCCESS_OK, $data = [], $message = null, int $statusCode = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        $statusCode = $this->statusCode ?: ApiCode::status($this->code);
        $message = $this->message ?? ApiCode::message($this->code);

        $data = $this->data;

        if ($data instanceof JsonResource) {
            $data = $data->toArray($request);
        }

        return response()->json([
            'code'      => $this->code,
            'data'      => $data ?: null,
            'message'   => $message,
            'locale'    => config('app.locale', 'en'),
        ], $statusCode);
    }

    /**
     * @param  array  $data
     * @param  int  $code
     * @param  null  $message
     * @param  int|null  $statusCode
     * @return Response
     */
    public static function success($data = [], int $code = ApiCode::CORE_SUCCESS_OK, $message = null, int $statusCode = null)
    {
        return new self($code, $data, $message, $statusCode);
    }

    /**
     * @param  int  $code
     * @param  null  $message
     * @param  int|null  $statusCode
     * @return Response
     */
    public static function error(int $code = ApiCode::CORE_SUCCESS_OK, $message = null, int $statusCode = null)
    {
        return new self($code, null, $message, $statusCode);
    }
}
