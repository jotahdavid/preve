<script setup lang="ts">
import { StickyNote } from 'lucide-vue-next';
import { dashboard } from '@/routes';
import transactionRoutes from '@/routes/transactions';
import type { BreadcrumbItem } from '@/types';
import { ITransaction } from '@/types/models/transaction';
import DetailItem from '@/components/Transaction/DetailItem.vue';
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import { formatCentsToDisplay } from '@/lib/currency';
import { formatTransactionDate } from '@/utils/formatDate';
import { cn } from '@/lib/utils';

interface Props {
  transaction: ITransaction;
}

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Dashboard',
    href: dashboard().url,
  },
  {
    title: 'Transactions',
    href: transactionRoutes.index().url,
  },
  {
    title: 'Transaction Details',
    href: '',
  },
];
function formattedAmount(transaction: ITransaction) {
  return formatCentsToDisplay(transaction.amount);
}

function amountClass(transaction: ITransaction) {
  return cn(
    'text-foreground text-md font-bold',
    transaction.type === 'expense'
      ? "text-destructive before:content-['-']"
      : 'text-positive',
  );
}
</script>

<template>
  <div class="max-w-lg mx-auto py-14">
    <Card class="gap-0 min-w-lg mx-auto">
      <CardContent class="-mb-4">
        <h2 class="text-lg font-medium">
          {{ transaction.description }}
        </h2>
        <div class="bg-muted rounded-lg p-4 my-4 space-y-4">
          <p class="text-lg font-medium">
            Details
          </p>

          <ul class="space-y-2">
            <DetailItem label="Date:" :value="formatTransactionDate(transaction.transaction_date)" />
            <DetailItem label="Category:" :value="transaction.category?.name" />
            <DetailItem label="Tag:" :value="transaction.tag?.name" />
            <DetailItem label="Notes:" :value="transaction.notes" />
            <DetailItem label="Created At:" :value="formatTransactionDate(transaction.created_at)" />
          </ul>

          <div class="w-full h-px border-b border-dashed border-muted-foreground/40" />

          <ul class="space-y-2">
            <DetailItem
              label="Amount:"
              :value="`R$ ${formattedAmount(transaction)}`"
              :value-class="amountClass(transaction)"
            />
          </ul>
        </div>
      </CardContent>

      <CardFooter v-if="transaction.notes" class="py-0 mt-4">
        <div class="notes-block relative w-full overflow-hidden rounded-md bg-muted/50 px-4 py-3">
          <div class="flex items-center gap-1.5 text-sm font-medium text-muted-foreground mb-1">
            <StickyNote :size="14" />
            Notes
          </div>
          <p class="text-sm text-foreground/80">
            {{ transaction.notes }}
          </p>
        </div>
      </CardFooter>
    </Card>
  </div>
</template>

<style scoped>
.notes-block::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 4px;
  border-radius: 4px 0 0 4px;
  background: linear-gradient(to bottom, #facc15, #fef08a);
}
</style>
