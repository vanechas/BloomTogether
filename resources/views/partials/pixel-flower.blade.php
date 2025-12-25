@php
$flowerConfigs = [
    'very-sad' => ['petals' => '#7BA3C9', 'center' => '#5A8AB5', 'stem' => '#5A7A4D', 'drooping' => true],
    'sad' => ['petals' => '#9BC4E2', 'center' => '#7BA3C9', 'stem' => '#5A7A4D', 'drooping' => false, 'small' => true],
    'neutral' => ['petals' => '#FFFDF3', 'center' => '#C58B1D', 'stem' => '#6B904D', 'drooping' => false],
    'happy' => ['petals' => '#F5D547', 'center' => '#C58B1D', 'stem' => '#6B904D', 'drooping' => false],
    'very-happy' => ['petals' => '#ED8383', 'center' => '#C58B1D', 'stem' => '#6B904D', 'drooping' => false, 'large' => true],
];

$sizeMap = ['sm' => 24, 'md' => 40, 'lg' => 56];
$config = $flowerConfigs[$mood] ?? $flowerConfigs['neutral'];
$pixelSize = $sizeMap[$size ?? 'md'] ?? 40;
$animated = $animated ?? false;
$class = $class ?? '';
@endphp

<svg 
    width="{{ $pixelSize }}" 
    height="{{ $pixelSize }}" 
    viewBox="0 0 8 8" 
    class="pixel-render {{ $animated ? 'animate-sway' : '' }} {{ $class }}"
    style="shape-rendering: crispEdges"
>
    <!-- Stem -->
    <rect x="3.5" y="5" width="1" height="3" fill="{{ $config['stem'] }}" />
    
    @if($config['drooping'] ?? false)
        <!-- Drooping sad flower -->
        <rect x="2" y="3" width="1" height="1" fill="{{ $config['petals'] }}" />
        <rect x="3" y="2" width="1" height="2" fill="{{ $config['petals'] }}" />
        <rect x="4" y="2" width="1" height="2" fill="{{ $config['petals'] }}" />
        <rect x="5" y="3" width="1" height="1" fill="{{ $config['petals'] }}" />
        <rect x="3" y="3" width="2" height="1" fill="{{ $config['center'] }}" />
        <rect x="2.5" y="4" width="1" height="1" fill="{{ $config['stem'] }}" />
    @elseif($config['small'] ?? false)
        <!-- Small bud -->
        <rect x="3" y="3" width="2" height="2" fill="{{ $config['petals'] }}" />
        <rect x="3.5" y="3.5" width="1" height="1" fill="{{ $config['center'] }}" />
    @elseif($config['large'] ?? false)
        <!-- Large flower (sunflower style) -->
        <rect x="3" y="0" width="2" height="1" fill="{{ $config['petals'] }}" />
        <rect x="1" y="1" width="1" height="1" fill="{{ $config['petals'] }}" />
        <rect x="6" y="1" width="1" height="1" fill="{{ $config['petals'] }}" />
        <rect x="2" y="1" width="4" height="1" fill="{{ $config['petals'] }}" />
        <rect x="1" y="2" width="6" height="3" fill="{{ $config['petals'] }}" />
        <rect x="2" y="5" width="4" height="1" fill="{{ $config['petals'] }}" />
        <rect x="3" y="2" width="2" height="2" fill="{{ $config['center'] }}" />
    @else
        <!-- Regular flower (daisy/tulip) -->
        <rect x="3" y="1" width="2" height="1" fill="{{ $config['petals'] }}" />
        <rect x="2" y="2" width="4" height="2" fill="{{ $config['petals'] }}" />
        <rect x="3" y="4" width="2" height="1" fill="{{ $config['petals'] }}" />
        <rect x="3" y="2" width="2" height="2" fill="{{ $config['center'] }}" />
    @endif
</svg>