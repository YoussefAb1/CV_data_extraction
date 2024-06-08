<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userRole = $request->user()->role;
        Log::info('User role check', ['user_id' => $request->user()->id, 'role' => $userRole, 'allowed_roles' => $roles]);

        $authorizedRoles = ['admin', 'syndic']; // Ajoutez 'syndic' à la liste des rôles autorisés

        if (!in_array($userRole, $authorizedRoles)) {
            Log::info('User role is not authorized', ['role' => $userRole]);
            dd('User role is not authorized', $userRole); // Utilisez dd() pour déboguer et arrêter l'exécution du code
            return redirect('dashboard');
        }
        return $next($request);
    }
}
