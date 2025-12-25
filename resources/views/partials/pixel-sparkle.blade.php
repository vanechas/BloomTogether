@php 
$color = $color ?? '#C58B1D';
$size = $size ?? 8;
$delay = $delay ?? 0;
$class = $class ?? '';
@endphp
<svg 
    width="{{ $size }}" 
    height="{{ $size }}" 
    viewBox="0 0 8 8" 
    class="pixel-render animate-sparkle {{ $class }}"
    style="shape-rendering: crispEdges; animation-delay: {{ $delay }}s"
>
    <rect x="3" y="0" width="2" height="2" fill="{{ $color }}" />
    <rect x="0" y="3" width="2" height="2" fill="{{ $color }}" />
    <rect x="6" y="3" width="2" height="2" fill="{{ $color }}" />
    <rect x="3" y="6" width="2" height="2" fill="{{ $color }}" />
    <rect x="3" y="3" width="2" height="2" fill="{{ $color }}" opacity="0.6" />
</svg>