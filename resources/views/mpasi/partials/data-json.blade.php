<script>
    window.MPASI_DATA = {
        products: @json($products ?? []),
        outlets: @json($outlets ?? []),
        dailyMenus: @json($dailyMenus ?? []),
        rewards: @json($rewards ?? []),
        settings: @json($settings ?? []),
        preOrders: @json($preOrders ?? []),
        redemptions: @json($redemptions ?? []),
        initialRole: @json($initialRole ?? 'pelanggan'),
    };
</script>
