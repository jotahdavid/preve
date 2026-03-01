<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

import Heading from '@/components/Heading.vue';
import ContainerTransactions from '@/components/Transaction/ContainerTransactions.vue';
import CreateTransactionDialog from '@/components/Transaction/CreateTransactionDialog.vue';
import FilterTransaction from '@/components/Transaction/FilterTransaction.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import transactionRoutes from '@/routes/transactions';
import type { BreadcrumbItem } from '@/types';
import { ITransaction } from '@/types/models/transaction';

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
</script>

<template>
  <Head title="Transaction" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="page-container">
      <!-- HEADING -->
      <Heading
        title="Transaction Details"
        description="View the details of your transaction here."
      />

      {{ transaction }}
    </div>
  </AppLayout>
</template>
