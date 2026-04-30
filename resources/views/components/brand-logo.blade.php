@php
    $user = auth()->user();
    $logoPath = null;

    if ($user->isRole('Super Admin')) {
        $logoPath = 'settings/' . config('get.MAIN_LOGO');
    } elseif ($user->isRole('Admin')) {
        $logoPath = $user->company_logo;
    } else {
        $logoPath = optional($user->company)->company_logo;
    }

    $logoUrl = ($logoPath && \Storage::disk('public')->has($logoPath))
        ? asset('storage/' . $logoPath)
        : asset('images/no-img-100x92.jpg');
@endphp

<img
    src="{{ $logoUrl }}"
    alt="{{ config('get.SYSTEM_APPLICATION_NAME') }} logo"
    class="brand-image img-circle elevation-3"
    style="opacity: .8;height:40px;border-radius: 50%"
>
