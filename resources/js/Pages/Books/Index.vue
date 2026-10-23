<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { Head, Link } from '@inertiajs/vue3';

// Data buku dari BookController@index (hasil paginate)
defineProps({
    books: Object,
});
</script>

<template>
    <Head title="Data Buku" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Data Buku
            </h2>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Pesan sukses setelah simpan -->
                <FlashMessage />

                <div class="mb-4 flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        Total: {{ books.total }} buku
                    </p>
                    <Link
                        href="/books/create"
                        class="rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700"
                    >
                        + Tambah Buku
                    </Link>
                </div>

                <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 text-left text-gray-600">
                            <tr>
                                <th class="px-4 py-3 font-medium">Kode</th>
                                <th class="px-4 py-3 font-medium">Judul</th>
                                <th class="px-4 py-3 font-medium">Pengarang</th>
                                <th class="px-4 py-3 font-medium">Tahun</th>
                                <th class="px-4 py-3 font-medium">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <!-- books.data karena paginate() membungkus data di properti "data" -->
                            <tr v-for="book in books.data" :key="book.id">
                                <td class="px-4 py-3">{{ book.kode_buku }}</td>
                                <td class="px-4 py-3">{{ book.judul }}</td>
                                <td class="px-4 py-3">{{ book.pengarang }}</td>
                                <td class="px-4 py-3">{{ book.tahun }}</td>
                                <td class="px-4 py-3">{{ book.stok }}</td>
                            </tr>

                            <!-- Tampil kalau belum ada data -->
                            <tr v-if="books.data.length === 0">
                                <td
                                    colspan="5"
                                    class="px-4 py-6 text-center text-gray-500"
                                >
                                    Belum ada data buku.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Link paginasi (Previous, 1, 2, ..., Next) -->
                <div class="mt-4 flex flex-wrap gap-1">
                    <template v-for="link in books.links" :key="link.label">
                        <Link
                            v-if="link.url"
                            :href="link.url"
                            class="rounded border px-3 py-1 text-sm hover:bg-gray-100"
                            :class="
                                link.active
                                    ? 'border-gray-800 bg-gray-800 text-white hover:bg-gray-800'
                                    : 'border-gray-300 text-gray-700'
                            "
                        >
                            <span v-html="link.label"></span>
                        </Link>
                        <span
                            v-else
                            class="rounded border border-gray-200 px-3 py-1 text-sm text-gray-400"
                            v-html="link.label"
                        ></span>
                    </template>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
