<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'
import axios from 'axios'
import { router } from '@inertiajs/vue3'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Bienes', href: '/bienes' },
  { title: 'Crear', href: '/bienes/create' },
]

const form = reactive({
  nombre: '',
  categoria: '',
  descripcion: '',
  codigo: '',
  cantidad: 0,
})

async function crearBien() {
  try {
    await axios.post('/api/bienes', form)
    router.visit('/bienes')
  } catch (error) {
    console.error('Error al crear el bien:', error)
  }
}
</script>

<template>
  <Head title="Crear Bien" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4 max-w-xl mx-auto">
      <h1 class="text-2xl font-bold mb-4">Crear Bien</h1>
      <form @submit.prevent="crearBien" class="space-y-3">
        <input v-model="form.nombre" placeholder="Nombre" class="border p-2 block w-full rounded" />
        <input v-model="form.categoria" placeholder="Categoría" class="border p-2 block w-full rounded" />
        <textarea v-model="form.descripcion" placeholder="Descripción" class="border p-2 block w-full rounded"></textarea>
        <input v-model="form.codigo" placeholder="Código" class="border p-2 block w-full rounded" />
        <input type="number" v-model="form.cantidad" placeholder="Cantidad" class="border p-2 block w-full rounded" />
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
      </form>
    </div>
  </AppLayout>
</template>

