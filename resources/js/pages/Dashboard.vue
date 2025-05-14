<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import {  PackageOpen,ChartNoAxesColumn,FileSpreadsheet,Archive,PackageCheck,FileCheck,User  } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Prestamo',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-5 md:grid-cols-4">
                <div class="relative aspect-video overflow-hidden rounded-xl flex items-center pl-4 dark:bg-red-500 bg-red-400 ">
                    <PackageOpen class="w-25 h-30 " stroke-width="0.8" />
                    <span class="text-2xl font-medium pl-12 mb-35">Prestamos</span>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl flex items-center pl-4 dark:bg-blue-500 bg-blue-400 ">
                    <ChartNoAxesColumn class="w-25 h-30 " stroke-width="1" />
                    <span class="text-2xl font-medium pl-4 mb-35">Inventario Actual</span>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl flex items-center pl-4 dark:bg-green-500 bg-green-400">
                    <FileSpreadsheet class="w-25 h-30 " stroke-width="1" />
                    <span class="text-2xl font-medium pl-12 mb-35">Facturas de Prestamos</span>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl flex items-center pl-4 dark:bg-yellow-500 bg-yellow-400">
                    <Archive class="w-25 h-30 " stroke-width="1" />
                    <span class="text-2xl font-medium pl-18 mb-35">Bienes</span>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl flex items-center pl-4 dark:bg-purple-500 bg-purple-400">
                    <PackageCheck class="w-25 h-30 " stroke-width="1" />
                    <span class="text-2xl font-medium pl-12 mb-35">Devoluciones</span>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl flex items-center pl-4 dark:bg-pink-500 bg-pink-400">
                    <FileCheck class="w-25 h-30 " stroke-width="1" />
                    <span class="text-2xl font-medium pl-12 mb-35">Facturas de Devoluciones</span>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl flex items-center pl-4 dark:bg-teal-500 bg-teal-400">
                    <User class="w-25 h-30 " stroke-width="1" />
                    <span class="text-2xl font-medium pl-12 mb-35">Usuarios</span>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
