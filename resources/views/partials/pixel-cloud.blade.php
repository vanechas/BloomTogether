@php 
$sizeMap = ['sm' => 40, 'md' => 64, 'lg' => 96];
$pixelSize = $sizeMap[$size ?? 'md'] ?? 64;
@endphp
<svg 
    width="{{ $pixelSize }}" 
    height="{{ $pixelSize * 0.5 }}" 
    viewBox="0 0 16 8" 
    class="pixel-render {{ $class ?? '' }}"
    style="shape-rendering: crispEdges"
>
    <rect x="4" y="2" width="8" height="4" fill="#FFFFFF" fill-opacity="0.9" />
    <rect x="2" y="3" width="3" height="3" fill="#FFFFFF" fill-opacity="0.9" />
    <rect x="11" y="3" width="3" height="3" fill="#FFFFFF" fill-opacity="0.9" />
    <rect x="6" y="1" width="4" height="2" fill="#FFFFFF" fill-opacity="0.9" />
    <rect x="3" y="4" width="10" height="2" fill="#FFFFFF" fill-opacity="0.8" />
</svg>