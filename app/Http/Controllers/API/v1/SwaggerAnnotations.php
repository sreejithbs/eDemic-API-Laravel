<?php

namespace App\Http\Requests\API;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="e-Demic API Documentation",
 *      description="API endpoints and descriptions for e-Demic Laravel API",
 *      @OA\Contact(
 *          name="Developer : Sreejith B S",
 *          email="sreejith.bs@quinoid.in",
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      ),
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Server"
 * )
 */

/**
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="api_key",
 *     name="API Authorization"
 * )
 */

/**
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints of Users",
 * )
 */