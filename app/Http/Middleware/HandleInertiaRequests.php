<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * Template root yang dimuat saat kunjungan pertama.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Versi asset saat ini.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Data yang otomatis dikirim ke SEMUA halaman Vue.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            // Pesan flash (contoh: "Buku berhasil ditambahkan") dari ->with('success', ...)
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
            ],
        ];
    }
}
