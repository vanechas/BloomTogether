{{-- Notebook Icon --}}
@if($icon === 'notebook')
<svg width="{{ $size ?? 32 }}" height="{{ $size ?? 32 }}" viewBox="0 0 16 16" class="pixel-render {{ $class ?? '' }}" style="shape-rendering: crispEdges">
    <rect x="2" y="1" width="12" height="14" fill="#F8CAB9" />
    <rect x="3" y="2" width="10" height="12" fill="#FFFDF3" />
    <rect x="4" y="4" width="6" height="1" fill="#8B7355" />
    <rect x="4" y="6" width="8" height="1" fill="#8B7355" />
    <rect x="4" y="8" width="5" height="1" fill="#8B7355" />
    <rect x="4" y="10" width="7" height="1" fill="#8B7355" />
    <rect x="1" y="3" width="2" height="2" fill="#C58B1D" />
    <rect x="1" y="7" width="2" height="2" fill="#C58B1D" />
    <rect x="1" y="11" width="2" height="2" fill="#C58B1D" />
</svg>
@endif

{{-- Sprout Icon --}}
@if($icon === 'sprout')
<svg width="{{ $size ?? 32 }}" height="{{ $size ?? 32 }}" viewBox="0 0 16 16" class="pixel-render {{ $class ?? '' }}" style="shape-rendering: crispEdges">
    <rect x="2" y="10" width="12" height="4" fill="#5D4E37" />
    <rect x="3" y="11" width="10" height="2" fill="#6B5B3D" />
    <rect x="7" y="6" width="2" height="5" fill="#6B904D" />
    <rect x="5" y="4" width="2" height="3" fill="#7DAA5C" />
    <rect x="9" y="4" width="2" height="3" fill="#7DAA5C" />
    <rect x="6" y="3" width="1" height="2" fill="#7DAA5C" />
    <rect x="9" y="3" width="1" height="2" fill="#7DAA5C" />
</svg>
@endif

{{-- Friends Icon --}}
@if($icon === 'friends')
<svg width="{{ $size ?? 32 }}" height="{{ $size ?? 32 }}" viewBox="0 0 16 16" class="pixel-render {{ $class ?? '' }}" style="shape-rendering: crispEdges">
    <!-- Left flower -->
    <rect x="2" y="4" width="1" height="1" fill="#ED8383" />
    <rect x="4" y="4" width="1" height="1" fill="#ED8383" />
    <rect x="3" y="3" width="1" height="1" fill="#ED8383" />
    <rect x="3" y="5" width="1" height="1" fill="#ED8383" />
    <rect x="3" y="4" width="1" height="1" fill="#C58B1D" />
    <rect x="3" y="6" width="1" height="5" fill="#6B904D" />
    
    <!-- Right flower -->
    <rect x="11" y="4" width="1" height="1" fill="#F5D547" />
    <rect x="13" y="4" width="1" height="1" fill="#F5D547" />
    <rect x="12" y="3" width="1" height="1" fill="#F5D547" />
    <rect x="12" y="5" width="1" height="1" fill="#F5D547" />
    <rect x="12" y="4" width="1" height="1" fill="#C58B1D" />
    <rect x="12" y="6" width="1" height="5" fill="#6B904D" />
    
    <!-- Soil -->
    <rect x="1" y="11" width="14" height="3" fill="#5D4E37" />
    <rect x="2" y="12" width="12" height="1" fill="#6B5B3D" />
</svg>
@endif

{{-- Watering Can Icon --}}
@if($icon === 'watering-can')
<svg width="{{ $size ?? 32 }}" height="{{ $size ?? 32 }}" viewBox="0 0 16 16" class="pixel-render {{ $class ?? '' }}" style="shape-rendering: crispEdges">
    <rect x="3" y="6" width="8" height="6" fill="#7BA3C9" />
    <rect x="4" y="5" width="6" height="1" fill="#7BA3C9" />
    <rect x="11" y="8" width="3" height="2" fill="#7BA3C9" />
    <rect x="13" y="7" width="2" height="1" fill="#7BA3C9" />
    <rect x="14" y="6" width="1" height="1" fill="#5A8AB5" />
    <rect x="6" y="3" width="1" height="3" fill="#5A8AB5" />
    <rect x="6" y="2" width="4" height="2" fill="#5A8AB5" />
    <rect x="9" y="3" width="1" height="2" fill="#5A8AB5" />
    <!-- Water drops -->
    <rect x="14" y="9" width="1" height="1" fill="#9BC4E2" />
    <rect x="15" y="10" width="1" height="1" fill="#9BC4E2" />
</svg>
@endif