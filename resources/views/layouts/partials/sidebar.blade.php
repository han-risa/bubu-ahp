<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo_bubu.jpg')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Desain" :link="route('desain.index')" icon="bi bi-list-ul"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Perangkingan" icon="bi bi-clipboard-fill">
        <x-maz-sidebar-sub-item name="Perangkingan Baru" :link="route('ranking.index')"></x-maz-sidebar-sub-item>
        <x-maz-sidebar-sub-item name="Riwayat Perangkingan" :link="route('ranking.index')"></x-maz-sidebar-sub-item>
    </x-maz-sidebar-item>

</x-maz-sidebar>
