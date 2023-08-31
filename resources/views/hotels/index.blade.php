<x-app :breadcrumb="$breadcrumb_info"> 
    <hotels-index
        :variables='@json(get_defined_vars())'
    ></hotels-index>

    <x-slot name="scripts">
        <script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>
        <script src="{{ asset('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
    </x-slot> 
</x-app>