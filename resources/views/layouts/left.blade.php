<div class="navigation-menu-tab">
	<div class="flex-grow-1">
		<ul>
			<li>
				<a class="icon {{ request()->segment(1) == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
					<i class="bi bi-house-down"></i>
					<h5 class="text-center text-white">
						Home
					</h5>
				</a>
			</li>
			@if($groups = module('groups'))
			@foreach($groups as $group_data)
			<li>
				<a class="icon {{ request()->segment(2) == $group_data->field_primary ? 'active' : '' }}" href="{{ $group_data->field_url ?? '#' }}"
					data-nav-target="#{{ $group_data->field_primary }}">
					<i class="bi bi-{{ $group_data->field_icon }}"></i>
					<h5 class="text-center text-white">
						{{ __($group_data->field_name) }}
					</h5>
				</a>
			</li>
			@endforeach
			@endif

			<li>
				@auth
				<a data-turbo-prefetch="false" class="icon" href="{{ route('signout') }}">
					<i class="bi bi-person-x"></i>
					<h5 class="text-center text-white">
						Logout
					</h5>
				</a>
				@else
				<a data-turbo-prefetch="false" class="icon" href="{{ route('login') }}">
					<i class="bi bi-log-in"></i>
					<h5 class="text-center text-white">
						Login
					</h5>
				</a>
				@endauth
			</li>

		</ul>
	</div>
</div>

@if(Template::greatherAdmin())
<!-- begin::navigation menu -->
<div class="navigation-menu-body">

	<!-- begin::navigation-logo -->
	<div class="navigation-header">
		<div id="navigation-logo">
			<a href="{{ url('/') }}">
				<img class="logo" src="{{ logoUrl() }}" alt="logo">
			</a>
		</div>
	</div>
	<!-- end::navigation-logo -->

	<div class="navigation-menu-group">
		@if($groups = SharedData::get('groups'))
		@foreach($groups as $group_data)
		<!-- should be open home || in request()->segment(1) == 'home' ? 'open' -->
		<div class="{{ (request()->segment(2) == $group_data->field_primary) || in_array(request()->segment(1), ['home', 'profile']) ? 'open' : '' }}" id="{{ $group_data->field_primary }}">
			<ul>
				@if($menus = $group_data->has_menu)
				@foreach($menus as $menu)
				@if($menu->field_type == MenuType::Internal)
				<li>
					<a data-turbo-prefetch="false" href="{{ $menu->field_url }}">
						<span>{{ $menu->field_name }}</span>
					</a>
				</li>
				@elseif($menu->field_type == MenuType::External)
				<li>
					<a target="_blank" href="{{ $menu->field_url }}">
						<span>{{ $menu->field_name }}</span>
					</a>
				</li>
				@elseif($menu->field_type == MenuType::Devider)
				<li>
					<hr>
				</li>
				@elseif($menu->field_type == MenuType::Menu)
				@php
				$active = request()->segment(2) == $group_data->field_primary && request()->segment(3) == 'default' && request()->segment(4) == $menu->field_url;
				@endphp
				<li>
					<a data-turbo-prefetch="false" class="hot {{ $active ? 'active' : '' }}" @if(env('APP_SPA')) hx-target="#content" hx-push-url="true" hx-get="{{ $menu->field_action ? route($menu->field_action) : '' }}" @endif href="{{ $menu->field_action ? route($menu->field_action) : '' }}">
						<span>{{ $menu->field_name }}</span>
						<i class="right-cursor bi bi-arrow-right"></i>
					</a>
				</li>
				@elseif($menu->field_type == MenuType::Group)
				@php
				$open = request()->segment(2) == $group_data->field_primary && request()->segment(3) == $menu->field_primary;
				@endphp
				<li class="{{ $open ? 'open' : '' }}">
					<a href="#">
						{{ $menu->field_name }}
						<i class="sub-menu-arrow chevron-menu"></i>
					</a>
					@if($links = $menu->has_link)
					<ul>
						@foreach($links as $link)
						@php
						$active = $open && request()->segment(4) == $link->field_url;
						@endphp
						@if($link->field_type == MenuType::External || $link->field_type == MenuType::Internal)
						<li>
							<a data-turbo-prefetch="false"  class="link {{ $active ? 'active' : '' }}" target="{{ $link->field_type == MenuType::External ? '_blank' : '' }}" href="{{ $link->field_url }}">
								{{ $link->field_name }}
							</a>
						</li>
						@else
						<li>
							<a class="link {{ $active ? 'active' : '' }}" @if(env('APP_SPA')) hx-target="#content" hx-push-url="true" hx-get="{{ route($link->field_action) }}" @endif href="{{ route($link->field_action) }}">
								<i class="left-cursor bi bi-arrow-right"></i>
								<span>{{ $link->field_name }}</span>
							</a>
						</li>
						@endif
						@endforeach
					</ul>
					@endif
				</li>
				@endif
				@endforeach
				@endif
			</ul>
		</div>
		@endforeach
		@endif

	</div>
</div>
@endif