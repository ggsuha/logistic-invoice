<template layout="admin">
  <Head title="Edit Akun" />

  <PageSection header="Edit Akun">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Profil</h4>
          </div>
          <div class="card-body">
            <section>
              <div class="form-group">
                <label for="name">Nama Perusahaan</label>
                <input id="name" v-model="form.name" type="text" class="form-control"
                  :class="{ 'is-invalid': form.errors.name }" placeholder="Contoh: Joko Widodo Corp" autocomplete="off" />
                <div v-if="form.errors.name" class="invalid-feedback">
                  {{ form.errors.name }}</div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" :value="user.email" type="text" class="form-control" disabled autocomplete="off" />
              </div>
              <div class="form-group">
                <label for="phone_number">Nomor Telepon</label>
                <input id="phone_number" v-model="form.phone" type="text" class="form-control"
                  :class="{ 'is-invalid': form.errors.phone }" placeholder="Contoh: 082131303789" autocomplete="off" />
                <div v-if="form.errors.phone" class="invalid-feedback">
                  {{ form.errors.phone }}</div>
              </div>
              <div class="form-group">
                <label for="address">Alamat</label>
                <textarea id="address" v-model="form.address" class="form-control"
                  :class="{ 'is-invalid': form.errors.address }" style="height: 100%;" rows="4"
                  placeholder="Contoh: Jalan Pemuda no 15, Cengkareng Selatan" autocomplete="off"></textarea>
                <div v-if="form.errors.address" class="invalid-feedback">
                  {{ form.errors.address }}</div>
              </div>

              <div class="form-group">
                <label for="header_children">Header</label>
                <input id="header_children" v-model="form.header" type="text" class="form-control"
                  :class="{ 'is-invalid': form.errors.header }" placeholder="Contoh: Global Logistic"
                  autocomplete="off" />
                <div v-if="form.errors.header" class="invalid-feedback">
                  {{ form.errors.header }}</div>
              </div>

              <div class="form-group">
                <label for="logo">Logo</label>
                <div v-if="props.user?.detail?.logo_url" style="width: 300px; margin-bottom: 10px;">
                  <img style="width: 100%; border: 1px gray solid;" :src="props.user?.detail?.logo_url" alt="Logo">
                </div>
                <input id="logo" type="file" accept="image/*" class="form-control" placeholder="Contoh: Global Logistic"
                  @change="changeImage" autocomplete="off" />
              </div>

            </section>
            <div class="form-group row mb-4">
              <div class="col-12">
                <button class="btn btn-primary float-right" @click="submit">
                  Ubah Data Akun
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Password</h4>
          </div>
          <div class="card-body">
            <section>
              <div class="form-group">
                <label for="old">Password Lama</label>
                <input id="old" v-model="passwordForm.old" type="password" class="form-control"
                  :class="{ 'is-invalid': passwordForm.errors.old }" placeholder="Masukkan password lama"
                  autocomplete="off" />
                <div v-if="passwordForm.errors.old" class="invalid-feedback">
                  {{ passwordForm.errors.old }}</div>
              </div>
              <div class="form-group">
                <label for="new-password">Password Baru</label>
                <input id="new-password" v-model="passwordForm.password" type="password" class="form-control"
                  :class="{ 'is-invalid': passwordForm.errors.password }" placeholder="Masukkan password baru"
                  autocomplete="off" />
                <div v-if="passwordForm.errors.password" class="invalid-feedback">
                  {{ passwordForm.errors.password }}</div>
              </div>
              <div class="form-group">
                <label for="confirm-password">Konfirmasi Password Baru</label>
                <input id="confirm-password" v-model="passwordForm.password_confirmation" type="password"
                  class="form-control" placeholder="Masukkan konfirmasi password baru" autocomplete="off" />
              </div>

            </section>
            <div class="form-group row mb-4">
              <div class="col-12">
                <button class="btn btn-primary float-right" @click="passwordSubmit">
                  Ubah password
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
import swal from "sweetalert";

const { route } = useRoute();

const props = defineProps({
  user: {
    type: Object,
    required: true
  },
})

const form = useForm({
  name: props.user?.name,
  phone: props.user?.detail?.phone,
  address: props.user?.detail?.address ?? '',
  header: props.user?.detail?.header,
  logo: null,
});

const passwordForm = useForm({
  old: null,
  password: null,
  password_confirmation: null,
});

function changeImage(event: Event) {
  const file = event.target.files[0];

  if (file) {
    const reader = new FileReader();

    form.logo = file;

    reader.readAsDataURL(file);
  }
}

function submit() {
  form.transform((data) => ({
    ...data,
    _method: 'patch',
  })).post(
    route("admin.profile.update"),
    {
      preserveScroll: true,
      onSuccess: (response) => {
        swal("Data berhasil diubah.");
      },
    });
}

function passwordSubmit() {
  passwordForm.post(
    route("admin.password.update"),
    {
      preserveScroll: true,
      onSuccess: (response) => {
        swal("Password berhasil diubah.");
        passwordForm.reset();
      },
    });
}
</script>

<style scoped></style>
