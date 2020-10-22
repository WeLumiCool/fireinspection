<div class="sidebar-fixed position-fixed">
    <div class="list-group list-group-flush ">
        <a href="{{ route('welcome') }}" class="logo-wrapper waves-effect mb-3" style="text-align: center;padding-top: 10px;">
            <img src="{{ asset('image/admin_logo.svg') }}" class="img-fluid" alt="logo" >
        </a>

        <a href="{{ route('admin.builds.index') }}"
           class="list-group-item list-group-item-action waves-effect {{ request()->is('admin/builds*') ? 'active' : '' }}">
            <i class="fas fa-building mr-3"></i>{{ __('Объекты') }}</a>

        <a href="{{ route('admin.psps.index') }}"
           class="list-group-item list-group-item-action waves-effect {{ request()->is('admin/psps*') ? 'active' : '' }}">
            <i class="fas fa-vector-square mr-3"></i>{{ __('Средства Пожаротушения') }}</a>

        <a href="{{ route('admin.users.index') }}"
           class="list-group-item list-group-item-action waves-effect {{ request()->is('admin/user*') ? 'active' : '' }}">
            <i class="fas fa-users mr-3"></i>{{ __('Пользовтели') }}</a>

        <a href="{{ route('admin.typeViolations.index') }}"
           class="list-group-item list-group-item-action waves-effect {{ request()->is('admin/typeViolation*') ? 'active' : '' }}">
            <i class="fas fa-users mr-3"></i>{{ __('Тип нарушений') }}</a>

        <a href="{{ route('admin.typeBuilds.index') }}"
           class="list-group-item list-group-item-action waves-effect {{ request()->is('admin/typeBuild*') ? 'active' : '' }}">
            <i class="fas fa-users mr-3"></i>{{ __('Тип объектов') }}</a>


    </div>
</div>
