<!-- eslint-disable vue/first-attribute-linebreak -->
<template>
  <Head title="Login" />

  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="@/images/logo.png" alt="logo" width="250" />
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="#" @submit.prevent="submit">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" v-model="loginForm.email" type="email" class="form-control"
                      :class="{ 'is-invalid': loginForm.errors.email }" name="email" tabindex="1" required autofocus />
                    <div v-if="loginForm.errors.email" class="invalid-feedback">
                      {{ loginForm.errors.email }}
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">
                        Password
                      </label>
                    </div>
                    <input id="password" v-model="loginForm.password" type="password" class="form-control" name="password"
                      tabindex="2" required />
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input id="remember-me" v-model="loginForm.remember" type="checkbox" name="remember"
                        class="custom-control-input" tabindex="3" />
                      <label class="custom-control-label" for="remember-me">
                        Remember Me
                      </label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Andon Gawé Taiyoooo-kun 2023
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import { useRoute } from '@/scripts/utils/ziggy/useRoute';
import { Head, useForm } from '@inertiajs/vue3';

const { route } = useRoute();
const loginForm = useForm({
  email: '',
  password: '',
  remember: false,
});
const submit = () => {
  loginForm.post(route('admin.login'), {
    onFinish: () => loginForm.reset('password'),
  });
};
</script>

<style scoped></style>
