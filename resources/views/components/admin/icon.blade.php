@props(['name', 'class' => 'h-5 w-5', 'stroke' => '1.8'])

@php
    $paths = [
        'calendar' => '<rect x="3" y="4.5" width="18" height="16.5" rx="2"/><path d="M16 3v3M8 3v3M3 9.5h18"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'chat' => '<path d="M21 12a8 8 0 0 1-11.6 7.1L4 20l1-4.6A8 8 0 1 1 21 12z"/><path d="M8.5 11h7M8.5 14h4"/>',
        'fuel' => '<path d="M4 21V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v16M3 21h12M7 8h4"/><path d="M14 10h2a2 2 0 0 1 2 2v4a1.5 1.5 0 0 0 3 0V8.5L18 5.5"/>',
        'chart' => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
        'box' => '<path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8M12 13v8"/>',
        'logout' => '<path d="M15 4h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-3M10 17l-5-5 5-5M5 12h11"/>',
        'search' => '<circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/>',
        'menu' => '<path d="M4 6h16M4 12h16M4 18h16"/>',
        'close' => '<path d="M6 6l12 12M18 6L6 18"/>',
        'chevron-left' => '<path d="M15 18l-6-6 6-6"/>',
        'chevron-right' => '<path d="M9 6l6 6-6 6"/>',
        'chevron-down' => '<path d="M6 9l6 6 6-6"/>',
        'download' => '<path d="M12 4v11M7 10l5 5 5-5M5 20h14"/>',
        'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
        'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
        'note' => '<path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9l-6-6z"/><path d="M14 3v6h6M8 13h8M8 17h5"/>',
        'check' => '<path d="M5 13l4 4L19 7"/>',
        'check-circle' => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
        'x-circle' => '<circle cx="12" cy="12" r="9"/><path d="M9 9l6 6M15 9l-6 6"/>',
        'hourglass' => '<path d="M6 3h12M6 21h12M7 3c0 5 5 6 5 9s-5 4-5 9M17 3c0 5-5 6-5 9s5 4 5 9"/>',
        'car' => '<path d="M3 13l1.8-4.5A2 2 0 0 1 6.7 7h10.6a2 2 0 0 1 1.9 1.5L21 13v4a1 1 0 0 1-1 1h-1.5M3 13v4a1 1 0 0 0 1 1h1.5M3 13h18M9 18h6"/><circle cx="7.5" cy="17.5" r="1.5"/><circle cx="16.5" cy="17.5" r="1.5"/>',
        'user' => '<circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/>',
        'plus' => '<path d="M12 5v14M5 12h14"/>',
        'pencil' => '<path d="M4 20h4L19 9l-4-4L4 16v4z"/><path d="M13.5 6.5l4 4"/>',
        'trash' => '<path d="M4 7h16M10 11v6M14 11v6M5 7l1 13a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1l1-13M9 7V4h6v3"/>',
        'arrow-left' => '<path d="M19 12H5M11 18l-6-6 6-6"/>',
        'external' => '<path d="M14 4h6v6M20 4l-9 9M18 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h5"/>',
        'map-pin' => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
        'alert' => '<path d="M12 9v4M12 17h.01"/><path d="M10.3 3.9L1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/>',
        'bell' => '<path d="M18 16V11a6 6 0 0 0-12 0v5l-2 2h16l-2-2zM10 21h4"/>',
        'sparkle' => '<path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8L12 3z"/>',
        'flame' => '<path d="M12 21a7 7 0 0 0 7-7c0-4-3-6-4-9-1 2-2 3-3.5 3.5C11 6 10 4 10 3c-3 3-5 6.5-5 11a7 7 0 0 0 7 7z"/>',
        'home' => '<path d="M3 11l9-7 9 7M5 9.5V20h14V9.5"/>',
        'droplet' => '<path d="M12 3s6 6.5 6 11a6 6 0 0 1-12 0c0-4.5 6-11 6-11z"/>',
        'store' => '<path d="M4 9l1.5-5h13L20 9M4 9h16v11H4zM4 9a2.7 2.7 0 0 0 5.3 0 2.7 2.7 0 0 0 5.4 0 2.7 2.7 0 0 0 5.3 0M10 20v-5h4v5"/>',
        'euro' => '<path d="M18 6.5A7 7 0 1 0 18 17.5M4 10h9M4 14h9"/>',
        'users' => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0M16 4.5a3.5 3.5 0 0 1 0 7M18 14a6.5 6.5 0 0 1 3.5 6"/>',
        'trending' => '<path d="M3 17l6-6 4 4 8-8M15 7h6v6"/>',
        'image' => '<rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><path d="M21 16l-5-5-9 9"/>',
    ];
@endphp

<svg
    xmlns="http://www.w3.org/2000/svg"
    {{ $attributes->merge(['class' => $class]) }}
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
    stroke-width="{{ $stroke }}"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
>
    {!! $paths[$name] ?? $paths['sparkle'] !!}
</svg>
