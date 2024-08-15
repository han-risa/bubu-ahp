<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo_bubu.jpg')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Dataset" :link="route('dataset')" icon="bi bi-database-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Perangkingan" icon="bi bi-clipboard-fill">
        <x-maz-sidebar-sub-item name="Perangkingan Baru" :link="route('components.alert')"></x-maz-sidebar-sub-item>
        <x-maz-sidebar-sub-item name="Riwayat Perangkingan" :link="route('components.accordion')"></x-maz-sidebar-sub-item>
    </x-maz-sidebar-item>

</x-maz-sidebar>
