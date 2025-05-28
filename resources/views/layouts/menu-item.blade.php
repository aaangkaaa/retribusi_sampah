@php
    // Debug: Tampilkan data menu yang diterima
    echo "<!-- Debug Menu Data: " . json_encode($menus) . " -->";
    echo '<!-- MENU DEBUG: ' . json_encode($menus) . ' -->';
@endphp

@foreach($menus as $menu)
    @php 
        $hasChildren = isset($menu->children) && $menu->children->count() > 0;
        $isLevel1 = is_null($menu->parent_id);
    @endphp
    <li class="nav-item{{ $hasChildren ? ' dropdown' : '' }}">
        <a class="nav-link{{ $hasChildren ? ' dropdown-toggle arrow-none' : '' }}" 
           href="{{ $hasChildren ? '#' : url($menu->url) }}" 
           {{ $hasChildren ? 'data-bs-toggle=dropdown role=button aria-haspopup=true aria-expanded=false' : '' }}>
            @if($isLevel1 && $menu->icon) <i class="{{ $menu->icon }}"></i> @endif
            {{ $menu->nama }}
        </a>
        @if($hasChildren)
            <ul class="dropdown-menu">
                @foreach($menu->children as $child)
                    @php 
                        $hasGrandChildren = isset($child->children) && $child->children->count() > 0;
                    @endphp
                    <li class="{{ $hasGrandChildren ? 'dropdown-submenu' : '' }}">
                        <a class="dropdown-item{{ $hasGrandChildren ? ' dropdown-toggle' : '' }}" 
                           href="{{ $hasGrandChildren ? '#' : url($child->url) }}"
                           {{ $hasGrandChildren ? 'data-bs-toggle=dropdown role=button aria-haspopup=true aria-expanded=false' : '' }}>
                            {{ $child->nama }}
                        </a>
                        @if($hasGrandChildren)
                            <ul class="dropdown-menu">
                                @foreach($child->children as $grandChild)
                                    <li>
                                        <a class="dropdown-item" href="{{ url($grandChild->url) }}">
                                            {{ $grandChild->nama }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
<li class="nav-item">
    <a class="nav-link" href="#" id="menu-logout">
        <i class="fa fa-sign-out-alt"></i> Logout
    </a>
</li> 