<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, router, usePage } from '@inertiajs/vue3'
import { onMounted, reactive } from 'vue'
import axios from 'axios'
import { type BreadcrumbItem } from '@/types'

interface PageProps {
  bienId: string;
}

const page = usePage<PageProps>()
const bienId = page.props.bienId

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Bienes', href: '/bienes' },
  { title: 'Editar', href: `/bienes/${bienId}/edit` },
]

const form = reactive({
  nombre: '',
  categoria: '',
  descripcion: '',
  codigo: '',
  cantidad: 0,
})

onMounted(async () => {
  try {
    const res = await axios.get(`/api/bienes/${bienId}`)
    Object.assign(form, res.data)
  } catch (error) {
    console.error('Error al cargar bien:', error)
  }
})

async function actualizarBien() {
  try {
    await axios.put(`/api/bienes/${bienId}`, form)
    router.visit('/bienes')
  } catch (error) {
    console.error('Error al actualizar bien:', error)
  }
}
</script>

<template>
  <Head title="Editar Bien" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4 max-w-xl mx-auto">
      <h1 class="text-2xl font-bold mb-4">Editar Bien</h1>
      <form @submit.prevent="actualizarBien" class="space-y-3">
        <input v-model="form.nombre" placeholder="Nombre" class="border p-2 block w-full rounded" />
        <input v-model="form.categoria" placeholder="Categoría" class="border p-2 block w-full rounded" />
        <textarea v-model="form.descripcion" placeholder="Descripción" class="border p-2 block w-full rounded"></textarea>
        <input v-model="form.codigo" placeholder="Código" class="border p-2 block w-full rounded" />
        <input type="number" v-model="form.cantidad" placeholder="Cantidad" class="border p-2 block w-full rounded" />
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
      </form>
    </div>
  </AppLayout>
</template>

