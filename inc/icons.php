<?php
/**
 * Kumpulan ikon SVG inline (stroke memakai currentColor).
 */
function icon(string $name, int $size = 24): string
{
    $paths = [
        'palette'   => '<circle cx="13.5" cy="6.5" r="1.5"/><circle cx="17.5" cy="10.5" r="1.5"/><circle cx="8.5" cy="7.5" r="1.5"/><circle cx="6.5" cy="12.5" r="1.5"/><path d="M12 2a10 10 0 1 0 0 20 2 2 0 0 0 2-2c0-.6-.3-1-.6-1.4-.3-.4-.6-.8-.6-1.4a2 2 0 0 1 2-2h2A5 5 0 0 0 22 10c0-4.4-4.5-8-10-8Z"/>',
        'code'      => '<path d="m8 8-4 4 4 4"/><path d="m16 8 4 4-4 4"/><path d="m13.5 5.5-3 13"/>',
        'megaphone' => '<path d="m3 11 15-6v14L3 13v-2Z"/><path d="M18 8a3 3 0 0 1 0 6"/><path d="M7 12v6a2 2 0 0 0 4 0v-4"/>',
        'video'     => '<rect x="2" y="6" width="14" height="12" rx="2"/><path d="m16 10 6-3v10l-6-3v-4Z"/>',
        'layers'    => '<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/>',
        'chart'     => '<path d="M3 3v18h18"/><path d="M7 15v3"/><path d="M12 10v8"/><path d="M17 6v12"/>',
        'camera'    => '<path d="M4 8h3l1.5-2h7L17 8h3a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z"/><circle cx="12" cy="13" r="3.5"/>',
        'check'     => '<path d="m5 13 4 4L19 7"/>',
        'arrow'     => '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
        'arrow-left'=> '<path d="M19 12H5"/><path d="m11 18-6-6 6-6"/>',
        'phone'     => '<path d="M6 3h3l2 5-2.5 1.5a12 12 0 0 0 6 6L16 13l5 2v3a2 2 0 0 1-2.2 2A17 17 0 0 1 4 5.2 2 2 0 0 1 6 3Z"/>',
        'mail'      => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 7 8.5 6 8.5-6"/>',
        'pin'       => '<path d="M12 22s7-6.1 7-11a7 7 0 1 0-14 0c0 4.9 7 11 7 11Z"/><circle cx="12" cy="11" r="2.6"/>',
        'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5.5l3.5 2"/>',
        'whatsapp'  => '<path d="M20.5 11.6A8.4 8.4 0 0 1 8 19.4L3.5 20.5l1.1-4.4A8.4 8.4 0 1 1 20.5 11.6Z"/><path d="M8.8 8.4c.3-.6.6-.6 1-.6h.6c.2 0 .5 0 .7.5l.7 1.6c.1.3 0 .5-.1.7l-.5.6c-.2.2-.2.4-.1.6a6 6 0 0 0 2.8 2.6c.3.1.5.1.7-.1l.6-.7c.2-.2.4-.2.6-.1l1.6.8c.4.2.4.4.4.6 0 .5-.4 1.4-1.5 1.6-1 .2-2.3 0-4-1.1-1.9-1.2-3.1-3.1-3.4-4.3-.3-1.1 0-2 .4-2.3Z"/>',
        'star'      => '<path d="m12 3.5 2.6 5.4 5.9.8-4.3 4.1 1 5.9-5.2-2.8-5.2 2.8 1-5.9L3.5 9.7l5.9-.8L12 3.5Z"/>',
        'cart'      => '<circle cx="9" cy="19" r="1.4"/><circle cx="17" cy="19" r="1.4"/><path d="M3 4h2l2.2 10.4A1.5 1.5 0 0 0 8.7 15.6h8.6a1.5 1.5 0 0 0 1.5-1.2L20 7H6"/>',
        'search'    => '<circle cx="11" cy="11" r="6.5"/><path d="m16 16 4.5 4.5"/>',
        'menu'      => '<path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h16"/>',
        'close'     => '<path d="m6 6 12 12"/><path d="m18 6-12 12"/>',
        'quote'     => '<path d="M9 6c-3 1.5-4.5 4-4.5 7.5V18h5.5v-5.5H7c0-2 .6-3.4 2-4.2V6Z"/><path d="M18.5 6c-3 1.5-4.5 4-4.5 7.5V18H19.5v-5.5H16.5c0-2 .6-3.4 2-4.2V6Z"/>',
        'shield'    => '<path d="M12 3l7 3v6c0 4.4-2.9 7.7-7 9-4.1-1.3-7-4.6-7-9V6l7-3Z"/><path d="m9 12 2 2 4-4"/>',
        'sparkle'   => '<path d="M12 3v4"/><path d="M12 17v4"/><path d="M3 12h4"/><path d="M17 12h4"/><path d="m6.5 6.5 2.5 2.5"/><path d="m15 15 2.5 2.5"/><path d="m17.5 6.5-2.5 2.5"/><path d="m9 15-2.5 2.5"/>',
        'users'     => '<circle cx="9" cy="8" r="3.2"/><path d="M3.5 20a5.5 5.5 0 0 1 11 0"/><path d="M16 5.5a3 3 0 0 1 0 5.6"/><path d="M17.5 20a5.6 5.6 0 0 0-2-4.3"/>',
        'target'    => '<circle cx="12" cy="12" r="8.5"/><circle cx="12" cy="12" r="4.5"/><circle cx="12" cy="12" r="1"/>',
        'download'  => '<path d="M12 4v10"/><path d="m8 11 4 4 4-4"/><path d="M5 19h14"/>',
        'file'      => '<path d="M7 3h6l5 5v13H7V3Z"/><path d="M13 3v5h5"/>',
        'refresh'   => '<path d="M20 11a8 8 0 1 0-2.3 6"/><path d="M20 5v6h-6"/>',
        'instagram' => '<rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="3.8"/><circle cx="17" cy="7" r="1"/>',
        'linkedin'  => '<rect x="3.5" y="3.5" width="17" height="17" rx="3"/><path d="M8 10v7"/><path d="M8 7.2v.1"/><path d="M12 17v-4a2.2 2.2 0 0 1 4.4 0v4"/>',
        'youtube'   => '<rect x="2.5" y="5.5" width="19" height="13" rx="4"/><path d="m11 9.5 4 2.5-4 2.5v-5Z"/>',
        'building'  => '<path d="M4 21V6l7-3v18"/><path d="M11 10h7a2 2 0 0 1 2 2v9"/><path d="M7 8v.1M7 12v.1M7 16v.1M15 14v.1M15 18v.1"/>',
        'cable'     => '<path d="M4 4h4a4 4 0 0 1 4 4v8a4 4 0 0 0 4 4h4"/><path d="M4 8h3"/><path d="M17 16h-3"/><circle cx="4" cy="20" r="1.6"/><circle cx="20" cy="4" r="1.6"/>',
        'hardhat'   => '<path d="M3 17h18"/><path d="M5 14a7 7 0 0 1 14 0"/><path d="M9 8.2V5.6a1.6 1.6 0 0 1 1.6-1.6h2.8A1.6 1.6 0 0 1 15 5.6v2.6"/>',
        'ruler'     => '<rect x="2.5" y="8.5" width="19" height="7" rx="1.5" transform="rotate(-45 12 12)"/><path d="M9 9.5l1.8 1.8"/><path d="M11.5 7l1.8 1.8"/><path d="M14 4.5l1.8 1.8"/>',
        'clipboard' => '<path d="M9 4h6v3H9z"/><path d="M15 5.5h2A1.5 1.5 0 0 1 18.5 7v12A1.5 1.5 0 0 1 17 20.5H7A1.5 1.5 0 0 1 5.5 19V7A1.5 1.5 0 0 1 7 5.5h2"/><path d="M9 12h6"/><path d="M9 16h4"/>',
        'wrench'    => '<path d="M15.5 3.5a5 5 0 0 0-4.4 7.3L3.8 18.1a2 2 0 0 0 2.8 2.8l7.3-7.3a5 5 0 0 0 6.3-6.6l-2.9 2.9-2.6-.6-.6-2.6 2.9-2.9a5 5 0 0 0-1.5-.3Z"/>',
        'compass'   => '<circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2 5-5 2 2-5 5-2Z"/>',
        'tower'     => '<path d="M12 21V9"/><path d="M8.5 21 12 9l3.5 12"/><path d="M6 9h12"/><path d="M8 5.5 12 9l4-3.5"/><path d="M4.5 12.5 8 9l3.5 3.5"/><path d="M19.5 12.5 16 9l-3.5 3.5"/>',
        'truck'     => '<path d="M2.5 7.5h10v9h-10z"/><path d="M12.5 10.5h4l3 3v3h-7z"/><circle cx="6" cy="18.5" r="1.6"/><circle cx="16.5" cy="18.5" r="1.6"/>',
    ];

    $body = $paths[$name] ?? $paths['check'];
    return '<svg class="ico ico-' . htmlspecialchars($name, ENT_QUOTES) . '" width="' . $size . '" height="' . $size
        . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
        . $body . '</svg>';
}
