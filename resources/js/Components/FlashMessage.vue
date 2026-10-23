<script setup>
import { usePage } from '@inertiajs/vue3';

// Membaca pesan flash yang dibagikan dari HandleInertiaRequests (flash.success)
const page = usePage();
</script>

<template>
    <div
        v-if="page.props.flash?.success"
        class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
    >
        {{ page.props.flash.success }}
    </div>
</template>
