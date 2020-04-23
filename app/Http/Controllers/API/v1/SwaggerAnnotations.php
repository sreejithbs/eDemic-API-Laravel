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
 * @OA\Tag(
 *     name="Authentication",
 *     description="API Endpoints for Authentication",
 * )
 * @OA\Tag(
 *     name="Messages",
 *     description="API Endpoints for Messages",
 * )
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints for Users",
 * )
 * @OA\Tag(
 *     name="Doctor Users",
 *     description="API Endpoints for Doctor Users",
 * )
 * @OA\Tag(
 *     name="Diseases",
 *     description="API Endpoints for Diseases",
 * )
 * @OA\Tag(
 *     name="Map",
 *     description="API Endpoints for Map",
 * )
 */