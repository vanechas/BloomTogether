@php $size = $size ?? 80; @endphp
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 32 32" class="pixel-render" style="image-rendering: pixelated">
    <!-- Body - cute flower creature -->
    <rect x="12" y="20" width="8" height="8" fill="#6B904D" />
    <rect x="10" y="22" width="2" height="4" fill="#6B904D" />
    <rect x="20" y="22" width="2" height="4" fill="#6B904D" />
    
    <!-- Face/Head - flower -->
    <rect x="11" y="8" width="10" height="10" fill="#F8CAB9" />
    <rect x="9" y="10" width="2" height="6" fill="#F8CAB9" />
    <rect x="21" y="10" width="2" height="6" fill="#F8CAB9" />
    <rect x="13" y="6" width="6" height="2" fill="#F8CAB9" />
    <rect x="13" y="18" width="6" height="2" fill="#F8CAB9" />
    
    <!-- Petals -->
    <rect x="7" y="10" width="2" height="4" fill="#ED8383" />
    <rect x="23" y="10" width="2" height="4" fill="#ED8383" />
    <rect x="13" y="4" width="6" height="2" fill="#ED8383" />
    <rect x="11" y="6" width="2" height="2" fill="#ED8383" />
    <rect x="19" y="6" width="2" height="2" fill="#ED8383" />
    
    <!-- Eyes -->
    <rect x="13" y="11" width="2" height="3" fill="#4a3728" />
    <rect x="17" y="11" width="2" height="3" fill="#4a3728" />
    <rect x="13" y="11" width="1" height="1" fill="#fff" />
    <rect x="17" y="11" width="1" height="1" fill="#fff" />
    
    <!-- Smile -->
    <rect x="14" y="15" width="4" height="1" fill="#4a3728" />
    <rect x="13" y="14" width="1" height="1" fill="#4a3728" />
    <rect x="18" y="14" width="1" height="1" fill="#4a3728" />
    
    <!-- Blush -->
    <rect x="10" y="13" width="2" height="2" fill="#ED8383" opacity="0.6" />
    <rect x="20" y="13" width="2" height="2" fill="#ED8383" opacity="0.6" />
</svg>