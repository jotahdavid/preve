<script setup lang="ts">
import { computed } from 'vue';

import { TrendingUp, Wallet } from 'lucide-vue-next';

import DashboardCard from '@/components/Dashboard/DashboardCard.vue';
import { formatCentsToDisplay } from '@/lib/currency';

interface Props {
  availableBalance: number;
  forecast: number;
}

const props = defineProps<Props>();

const balanceVariant = computed(() => {
  if (props.availableBalance > 0) return 'positive';
  if (props.availableBalance < 0) return 'destructive';
  return 'neutral';
});

const forecastVariant = computed(() => {
  if (props.forecast > 0) return 'positive';
  if (props.forecast < 0) return 'destructive';
  return 'neutral';
});
</script>

<template>
  <div class="grid grid-cols-2 gap-6 mb-4">
    <DashboardCard
      title="Available Balance"
      description="Income minus paid expenses this month"
      :amount="formatCentsToDisplay(availableBalance)"
      :variant="balanceVariant"
    >
      <template #icon>
        <Wallet :size="16" />
      </template>
    </DashboardCard>

    <DashboardCard
      title="Forecast"
      description="Balance after pending expenses"
      :amount="formatCentsToDisplay(forecast)"
      :variant="forecastVariant"
    >
      <template #icon>
        <TrendingUp :size="16" />
      </template>
    </DashboardCard>
  </div>
</template>
