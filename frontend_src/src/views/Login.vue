<template>
  <div class="login">
    <h1>Login</h1>
    <b-container>
      <b-row>
        <b-col cols="12" sm="6" offset-sm="3">
          <b-card>
            <b-card-text>
              <b-container>
                <b-form class="text-left" @submit.prevent="onLogin">
                  <b-form-group id="email-input-group"
                                label="Email address:"
                                label-for="email-input">
                    <b-form-input v-model="form.email"
                                  id="email-input"
                                  :state="$v.form.email.$dirty ? !$v.form.email.$error : null"
                                  aria-describedby="email-input-live-feedback"/>

                    <b-form-invalid-feedback id="email-input-live-feedback">
                      This is a required field and must be a valid email address.
                    </b-form-invalid-feedback>
                  </b-form-group>

                  <b-form-group id="password-input-group"
                                label="Password:"
                                label-for="password-input">
                    <b-form-input v-model="form.password"
                                  id="password-input"
                                  type="password"
                                  :state="$v.form.password.$dirty ? !$v.form.password.$error : null"
                                  aria-describedby="password-input-live-feedback"/>

                    <b-form-invalid-feedback id="password-input-live-feedback">
                      This is a required field.
                    </b-form-invalid-feedback>
                  </b-form-group>

                  <b-button type="submit" variant="primary">Submit</b-button>
                </b-form>
              </b-container>
            </b-card-text>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, email as emailValidation } from 'vuelidate/lib/validators';
import RepositoryFactory from '../apiAccess/repositoryFactory';

const AuthRepository = RepositoryFactory.get('auth');

export default {
  name: 'Login',
  mixins: [validationMixin],
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
    };
  },
  validations: {
    form: {
      email: {
        required,
        emailValidation,
      },
      password: {
        required,
      },
    },
  },
  methods: {
    onLogin() {
      this.$v.form.$touch();
      if (this.$v.form.$invalid) {
        return;
      }

      const data = AuthRepository.login(this.form);
      data.then((response) => {
        console.log(response.data);
        console.log(response.status);
        console.log(response.statusText);
        console.log(response.headers);
        console.log(response.config);
      });
    },
  },
};
</script>
