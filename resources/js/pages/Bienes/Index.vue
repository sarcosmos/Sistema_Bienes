<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue'
import axios from 'axios'
import { type BreadcrumbItem } from '@/types'

interface Bien {
  id: number
  nombre: string
  categoria: string
  descripcion?: string
  codigo?: string
  cantidad: number
}

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Inicio', href: '/dashboard' },
  { title: 'Bienes', href: '/bienes' },
]

const bienes = ref<Bien[]>([])

onMounted(async () => {
  try {
    const response = await axios.get('/api/bienes')
    bienes.value = response.data
  } catch (error) {
    console.error('Error al cargar bienes:', error)
  }
})
</script>


<template>
  <Head title="Bienes" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-4 p-4">
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Lista de Bienes</h1>
        <Link href="/bienes/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Crear Bien</Link>
      </div>

      <table class="table-auto w-full border border-gray-200 shadow rounded">
        <thead class="bg-gray-100">
          <tr>
            <th class="border px-4 py-2 text-left">Nombre</th>
            <th class="border px-4 py-2 text-left">Categoría</th>
            <th class="border px-4 py-2 text-left">Cantidad</th>
            <th class="border px-4 py-2 text-left">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="bien in bienes" :key="bien.id" class="hover:bg-gray-50">
            <td class="border px-4 py-2">{{ bien.nombre }}</td>
            <td class="border px-4 py-2">{{ bien.categoria }}</td>
            <td class="border px-4 py-2">{{ bien.cantidad }}</td>
            <td class="border px-4 py-2">
              <Link :href="`/bienes/${bien.id}/edit`" class="text-blue-500 hover:underline">Editar</Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>



 