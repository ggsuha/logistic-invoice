<template layout="admin">
  <Head :title="`${action} Shipment`" />

  <PageSection :header="`${action} Shipment`">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-body">
            <section>
              <h3 class="section-title">Shipment Data</h3>
              <div class="form-group">
                <label for="number">ID Number</label>
                <input id="number" v-model="form.shipment.number" type="text" class="form-control" autofocus
                  placeholder="Input the ID Number" />
              </div>
              <div class="form-group">
                <label for="air_waybill">Air Waybill</label>
                <input id="air_waybill" v-model="form.shipment.air_waybill" type="text" class="form-control"
                  placeholder="Input the Air Waybill" />
              </div>
            </section>
            <section>
              <h3 class="section-title">Shipper Data</h3>
              <div class="form-group">
                <label for="shipper_name">Name</label>
                <input id="shipper_name" v-model="form.shipper.name" type="text" class="form-control" autofocus
                  placeholder="Input the Name" />
              </div>
              <div class="form-group">
                <label for="shipper_phone">Phone Number</label>
                <input id="shipper_phone" v-model="form.shipper.phone" type="text" class="form-control"
                  placeholder="Input the Phone Number" />
              </div>
            </section>
            <section>
              <h3 class="section-title">Receiver Data</h3>
              <div class="form-group">
                <label for="receiver_name">Name</label>
                <input id="receiver_name" v-model="form.receiver.name" type="text" class="form-control" autofocus
                  placeholder="Input the Name" />
              </div>
              <div class="form-row">
                <div class="col-12 col-sm-12 col-md-6">

                  <div class="form-group">
                    <label for="receiver_phone">Phone Number</label>
                    <input id="receiver_phone" v-model="form.receiver.phone" type="text" class="form-control"
                      placeholder="Input the Phone Number" />
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="receiver_postal">Postal Code</label>
                    <input id="receiver_postal" v-model="form.receiver.address.postal_code" type="text"
                      class="form-control" placeholder="Input the Postal Code" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="receiver_address">Address</label>
                <textarea id="receiver_address" v-model="form.receiver.address.street" class="form-control"
                  style="height: 100%;" rows="4" placeholder="Input the Address"></textarea>
              </div>
              <div class="form-group">
                <label for="receiver_country">Country</label>
                <input id="receiver_country" v-model="form.receiver.address.country" type="text" class="form-control"
                  placeholder="Input the Country" />
              </div>
            </section>
            <section>
              <h3 class="section-title">Item Data</h3>
              <div class="form-row">
                <div class="col-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="item_name">Name</label>
                    <input id="item_name" v-model="form.item.name" type="text" class="form-control"
                      placeholder="Input the item name" />
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6">
                  <label for="item_quantity">Quantity</label>
                  <input id="item_quantity" v-model="form.item.quantity" type="number" class="form-control"
                    placeholder="Input the item quantity" />
                </div>
              </div>
              <div class="form-row">
                <div class="col-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="item_weight">Weight</label>
                    <input id="item_weight" v-model="form.item.weight" type="number" class="form-control"
                      placeholder="Input the item weight" />
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6">
                  <label for="item_weight_unit">Weight Unit</label>
                  <BKSelect id="item_weight_unit" v-model="form.item.weight_unit" :data-placeholder="'Select unit'">
                    <option v-for="option in weight_units" :key="option.id" :value="option.id">{{ option.id }}</option>
                  </BKSelect>
                </div>
              </div>
              <div class="form-group">
                <label for="item_custom_value">Custom Value</label>
                <input id="item_custom_value" v-model="form.item.custom_value" type="text" class="form-control"
                  placeholder="Input the custom value" />
              </div>
              <div class="form-row">
                <div class="col-12 col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="item_length">Length (cm)</label>
                    <input id="item_length" v-model="form.item.x_axis" type="number" class="form-control"
                      placeholder="Input the item length" />
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="item_width">Width (cm)</label>
                    <input id="item_width" v-model="form.item.y_axis" type="number" class="form-control"
                      placeholder="Input the item width" />
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="item_height">Height (cm)</label>
                    <input id="item_height" v-model="form.item.z_axis" type="number" class="form-control"
                      placeholder="Input the item height" />
                  </div>
                </div>
              </div>
            </section>
            <div class="form-group row mb-4">
              <div class="col-12">
                <button class="btn btn-primary float-right" @click="submit">
                  {{ action }} Shipment
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </PageSection>
</template>

<script setup lang="ts">
import PageSection from "@components/admin/layout/Page/PageSection.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { useRoute } from "@/scripts/utils/ziggy/useRoute";
import { BKSelect } from "@timedoor/baskito-ui";
import swal from "sweetalert";
import { computed } from "vue";

const { route } = useRoute();

const weight_units = [{ id: 'kg' }, { id: 'gram' }]
const props = defineProps({
  shipment: {
    type: Object,
    default: null
  }
})

const action = computed(() => {
  return props.shipment ? 'Edit' : 'Create';
})

const form = useForm({
  shipment: {
    number: props.shipment?.shipment?.number,
    air_waybill: props.shipment?.shipment?.air_waybill,
  },
  shipper: {
    name: props.shipment?.shipper?.name,
    phone: props.shipment?.shipper?.phone,
  },
  receiver: {
    name: props.shipment?.receiver?.name,
    phone: props.shipment?.receiver?.phone,
    address: {
      street: props.shipment?.receiver?.address?.street ?? '',
      country: props.shipment?.receiver?.address?.country,
      postal_code: props.shipment?.receiver?.address?.postal_code,
    }
  },
  item: {
    name: props.shipment?.item?.name,
    quantity: props.shipment?.item?.quantity,
    weight: props.shipment?.item?.weight,
    weight_unit: props.shipment?.item?.weight_unit,
    custom_value: props.shipment?.item?.custom_value,
    x_axis: props.shipment?.item?.x_axis,
    y_axis: props.shipment?.item?.y_axis,
    z_axis: props.shipment?.item?.z_axis,
    dimension_unit: props.shipment?.item?.dimension_unit ?? 'cm',
  }
});

function submit() {
  if (props.shipment == null) {
    form.post(route("admin.shipment.store"), {
      onSuccess: (response) => {
        swal("Data successfully added");
      },
      onFinish: () => {
        //
      }
    });
  } else {
    form.patch(route("admin.shipment.update", { shipment: props.shipment.shipment.id }), {
      onSuccess: (response) => {
        swal("Data successfully updated.");
      },
      onFinish: () => {
        //
      }
    });
  }
}
</script>

<style scoped></style>
