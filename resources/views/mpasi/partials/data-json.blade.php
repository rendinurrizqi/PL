<script>
    window.MPASI_DATA = {
        products: @json($products ?? []),
        outlets: @json($outlets ?? []),
        dailyMenus: @json($dailyMenus ?? []),
        rewards: @json($rewards ?? []),
        settings: @json($settings ?? []),
        initialRole: @json($initialRole ?? 'pelanggan'),
    };
</script>
