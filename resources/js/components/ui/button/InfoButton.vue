<script setup lang="ts">
import { Info } from 'lucide-vue-next';

import { DropdownMenuItem } from '@/components/ui/dropdown-menu';

defineProps<{
  title?: string;
}>();

const emit = defineEmits<{
  click: [];
}>();
</script>

<template>
  <DropdownMenuItem @click="emit('click')">
    <Info class="size-4" />
    {{ title ?? 'Details' }}
  </DropdownMenuItem>
</template>
