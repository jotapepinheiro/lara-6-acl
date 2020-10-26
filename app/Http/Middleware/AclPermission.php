<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Closure;

class AclPermission
{
	const DELIMITER = '|';

	protected $auth;

	/**
	 * Creates a new instance of the middleware.
	 *
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param  $permissions
     * @return mixed
     */
	public function handle(Request $request, Closure $next, $permissions)
	{
		if (!is_array($permissions)) {
			$permissions = explode(self::DELIMITER, $permissions);
		}

		if ($this->auth->guest() || !$request->user()->can($permissions)) {
			abort(403);
		}

		return $next($request);
	}
}
