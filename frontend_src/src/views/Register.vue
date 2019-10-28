<template>
  <div class="register">
    <h1>This is a login page</h1>

    <b-container>
      <b-row>
        <b-col cols="12" sm="6" offset-sm="3">
          <b-card>
            <b-card-text>
              <b-container>
                <b-form class="text-left" @submit.prevent="onRegister">
                  <b-form-group id="name-input-group"
                                label="Name:"
                                label-for="name-input">

                    <b-form-input v-model="$v.form.name.$model"
                                  id="name-input"
                                  type="text"
                                  :state="$v.form.name.$dirty ? !$v.form.name.$error : null"
                                  aria-describedby="name-input-live-feedback"/>

                    <b-form-invalid-feedback id="name-input-live-feedback">
                      This is a required field and must be at least 3 characters.
                    </b-form-invalid-feedback>
                  </b-form-group>

                  <b-form-group id="email-input-group"
                                label="Email address:"
                                label-for="email-input">

                    <b-form-input v-model="form.email"
                                  id="email-input"

                                  :state="$v.form.email.$dirty ? !$v.form.email.$error : null"
                                  aria-describedby="email-input-live-feedback"/>

                    <b-form-invalid-feedback id="email-input-live-feedback">
                      This is a required field and must be a valid email string.
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
                      This is a required field and must be at least 8 characters.
                    </b-form-invalid-feedback>
                  </b-form-group>

                  <b-form-group id="password-confirmation-input-group"
                                label="Confirm your password:"
                                label-for="password-confirmation-input">
                    <b-form-input v-model="form.passwordConfirmation"
                                  id="password-confirmation-input"
                                  type="password"
                                  :state="$v.form.passwordConfirmation.$dirty ?
                                   !$v.form.passwordConfirmation.$error : null"
                                  aria-describedby="password-confirmation-input-live-feedback"/>

                    <b-form-invalid-feedback id="password-confirmation-input-live-feedback">
                      This is a required field and must much password field.
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
import {
  required, minLength, maxLength, email as emailValidation, sameAs,
} from 'vuelidate/lib/validators';
import RepositoryFactory from '../apiAccess/repositoryFactory';


const AuthRepository = RepositoryFactory.get('auth');

export default {
  name: 'register',
  mixins: [validationMixin],
  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
        passwordConfirmation: null,
      },
    };
  },
  validations: {
    form: {
      name: {
        required,
        minLength: minLength(4),
        maxLength: maxLength(255),
      },
      email: {
        required,
        emailValidation,
      },
      password: {
        required,
      },
      passwordConfirmation: {
        required,
        sameAsPassword: sameAs('password'),
      },
    },
  },
  methods: {
    onRegister() {
      this.$v.form.$touch();
      if (this.$v.form.$invalid) {
        return;
      }

      const { data } = AuthRepository.register(this.form);
      console.log(data);
    },
  },
};
</script>
