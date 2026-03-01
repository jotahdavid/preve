<script setup lang="ts">
defineProps<{
  label: string;
  value?: string | null;
  valueClass?: string;
}>();
</script>

<template>
  <li v-if="value" class="flex justify-between text-muted-foreground text-sm gap-2">
    <span>
      {{ label }}
    </span>
    <p :class="valueClass ?? 'text-right max-w-xs'">
      {{ value }}
    </p>
  </li>
</template>
