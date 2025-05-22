<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';

// Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Bienes', href: '/bienes' },
];

// Tipo de bien
interface Bien {
  id: number;
  nombre: string;
  categoria: string;
  descripcion: string;
  codigo: string;
  cantidad: number;
  estado: string;
}

const bienes = ref<Bien[]>([]);
const nuevoBien = ref<Omit<Bien, 'id' | 'estado'>>({
  nombre: '',
  categoria: '',
  descripcion: '',
  codigo: '',
  cantidad: 0,
});

// Para edición
const bienEditando = ref<Bien | null>(null);

// Obtener bienes
const obtenerBienes = async () => {
  try {
    const response = await axios.get('/api/bienes');
    bienes.value = response.data;
  } catch (error) {
    console.error('Error al cargar bienes:', error);
  }
};

// Crear bien
const crearBien = async () => {
  try {
    const response = await axios.post('/api/bienes', {
      ...nuevoBien.value,
      estado: nuevoBien.value.cantidad > 0 ? 'con existencia' : 'agotado',
    });
    bienes.value.push(response.data);
    nuevoBien.value = { nombre: '', categoria: '', descripcion: '', codigo: '', cantidad: 0 };
  } catch (error) {
    console.error('Error al crear el bien:', error);
  }
};

// Cargar datos del bien a editar
const editarBien = (bien: Bien) => {
  bienEditando.value = { ...bien };
};

// Actualizar bien
const actualizarBien = async () => {
  if (!bienEditando.value) return;
  try {
    const { id, ...data } = bienEditando.value;
    const response = await axios.put(`/api/bienes/${id}`, data);
    const index = bienes.value.findIndex(b => b.id === id);
    if (index !== -1) bienes.value[index] = response.data;
    bienEditando.value = null;
  } catch (error) {
    console.error('Error al actualizar el bien:', error);
  }
};

onMounted(obtenerBienes);
</script>

<template>
  <Head title="Bienes" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-4 p-4">

      <!-- Formulario crear -->
      <form @submit.prevent="crearBien" class="grid gap-4 md:grid-cols-3">
        <input v-model="nuevoBien.nombre" placeholder="Nombre" class="border p-2 rounded" required />
        <input v-model="nuevoBien.categoria" placeholder="Categoría" class="border p-2 rounded" required />
        <input v-model="nuevoBien.descripcion" placeholder="Descripción" class="border p-2 rounded" />
        <input v-model="nuevoBien.codigo" placeholder="Código" class="border p-2 rounded" required />
        <input v-model.number="nuevoBien.cantidad" type="number" placeholder="Cantidad" class="border p-2 rounded" min="0" required />
        <div class="md:col-span-3">
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Crear Bien</button>
        </div>
      </form>

      <!-- Formulario editar -->
      <form v-if="bienEditando" @submit.prevent="actualizarBien" class="grid gap-4 md:grid-cols-3 bg-yellow-100 p-4 rounded">
        <input v-model="bienEditando.nombre" placeholder="Nombre" class="border p-2 rounded" />
        <input v-model="bienEditando.categoria" placeholder="Categoría" class="border p-2 rounded" />
        <input v-model="bienEditando.descripcion" placeholder="Descripción" class="border p-2 rounded" />
        <input v-model="bienEditando.codigo" placeholder="Código" class="border p-2 rounded" />
        <input v-model.number="bienEditando.cantidad" type="number" placeholder="Cantidad" class="border p-2 rounded" min="0" />
        <div class="md:col-span-3 flex justify-between">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Guardar Cambios</button>
          <button type="button" @click="bienEditando = null" class="text-red-600">Cancelar</button>
        </div>
      </form>

      <!-- Tabla de bienes -->
      <div class="grid auto-rows-min gap-5 md:grid-cols-1">
        <table class="min-w-full bg-white rounded shadow">
          <thead>
            <tr class="bg-gray-200 text-left">
              <th class="p-2">Nombre</th>
              <th class="p-2">Categoría</th>
              <th class="p-2">Descripción</th>
              <th class="p-2">Código</th>
              <th class="p-2">Cantidad</th>
              <th class="p-2">Estado</th>
              <th class="p-2">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="bien in bienes" :key="bien.id" class="border-b hover:bg-gray-50">
              <td class="p-2">{{ bien.nombre }}</td>
              <td class="p-2">{{ bien.categoria }}</td>
              <td class="p-2">{{ bien.descripcion }}</td>
              <td class="p-2">{{ bien.codigo }}</td>
              <td class="p-2">{{ bien.cantidad }}</td>
              <td class="p-2">{{ bien.estado }}</td>
              <td class="p-2">
                <button @click="editarBien(bien)" class="text-blue-600 hover:underline">Editar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AppLayout>
</template>


