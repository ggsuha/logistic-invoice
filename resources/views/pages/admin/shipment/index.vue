<template layout="admin">
  <Head title="Dashboard" />

  <PageSection header="Dashboard Page" :back-link="$route('admin.dashboard')">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Shipment</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 5px">No</th>
                    <th>ID Number</th>
                    <th>Shipper</th>
                    <th>Receiver</th>
                    <th>Air Waybill</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-if="(shipments.data.length > 0)">
                    <tr v-for="shipment, index in shipments.data" :key="shipment.id">
                      <td>{{ shipments.from + index }}</td>
                      <td>{{ shipment.number }}</td>
                      <td>{{ shipment.shipper.name }}</td>
                      <td>{{ shipment.receiver.name }}</td>
                      <td>{{ shipment.air_waybill }}</td>
                      <td>
                        <Link :href="$route('admin.dashboard')" class="btn btn-success" title="Show"><i
                          class="far fa-eye"></i>
                        </Link>&nbsp;
                        <Link :href="$route('admin.dashboard')" class="btn btn-danger" title="Edit"><i
                          class="fas fa-trash"></i>
                        </Link>
                      </td>
                    </tr>
                  </template>

                  <template v-else>
                    <tr class="text-center">
                      <td colspan="10">Tidak ada data</td>
                    </tr>
                  </template>

                </tbody>
              </table>
            </div>
            <Pagination :links="shipments.links" />
          </div>
        </div>
      </div>
    </div>
  </PageSection>
</template>

<script setup lang="ts">
import Pagination from "@/views/components/pagination-section.vue";
import PageSection from "@components/admin/layout/Page/PageSection.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
  shipments: {
    type: Object,
    required: true,
  }
})
</script>

<style scoped></style>
