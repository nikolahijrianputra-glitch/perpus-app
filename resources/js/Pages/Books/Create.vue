<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// useForm mengelola nilai input + pesan error validasi dari Laravel
const form = useForm({
    kode_buku: '',
    judul: '',
    pengarang: '',
    penerbit: '',
    tahun: '',
    stok: 0,
});

// Kirim ke route books.store -> method store() di BookController
function submit() {
    form.post(route('books.store'));
}

// Class input dipakai ulang supaya kode lebih rapi
const inputClass =
    'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500';
</script>

<template>
    <Head title="Tambah Buku" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tambah Buku
            </h2>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
                <!-- @submit.prevent: cegah reload halaman, lalu jalankan submit() -->
                <form
                    @submit.prevent="submit"
                    class="space-y-4 rounded-lg bg-white p-6 shadow-sm"
                >
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Buku</label>
                        <input v-model="form.kode_buku" type="text" :class="inputClass" />
                        <p v-if="form.errors.kode_buku" class="mt-1 text-sm text-red-600">
                            {{ form.errors.kode_buku }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul</label>
                        <input v-model="form.judul" type="text" :class="inputClass" />
                        <p v-if="form.errors.judul" class="mt-1 text-sm text-red-600">
                            {{ form.errors.judul }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pengarang</label>
                        <input v-model="form.pengarang" type="text" :class="inputClass" />
                        <p v-if="form.errors.pengarang" class="mt-1 text-sm text-red-600">
                            {{ form.errors.pengarang }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Penerbit</label>
                        <input v-model="form.penerbit" type="text" :class="inputClass" />
                        <p v-if="form.errors.penerbit" class="mt-1 text-sm text-red-600">
                            {{ form.errors.penerbit }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tahun</label>
                            <input
                                v-model="form.tahun"
                                type="text"
                                maxlength="4"
                                placeholder="contoh: 2024"
                                :class="inputClass"
                            />
                            <p v-if="form.errors.tahun" class="mt-1 text-sm text-red-600">
                                {{ form.errors.tahun }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stok</label>
                            <input v-model="form.stok" type="number" min="0" :class="inputClass" />
                            <p v-if="form.errors.stok" class="mt-1 text-sm text-red-600">
                                {{ form.errors.stok }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <!-- Tombol nonaktif saat request sedang diproses -->
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700 disabled:opacity-50"
                        >
                            Simpan
                        </button>
                        <Link href="/books" class="text-sm text-gray-600 hover:underline">
                            Batal
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
