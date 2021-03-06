<template>
  <div class="register">
    <h1>Registration</h1>

    <b-container>
      <b-row>
        <b-col cols="12" sm="6" offset-sm="3">
          <b-card>
            <b-card-text>
              <b-container>
                <ValidationObserver ref="observer" v-slot="{ passes }">
                  <b-form class="text-left" @submit.prevent="passes(onSubmit)" @reset="resetForm">
                    <ValidationProvider rules="required"
                                        name="Name"
                                        ref="nameProvider"
                                        v-slot="{ valid, errors }"
                                        maxlength="255">
                      <b-form-group
                        label="Name:"
                        label-for="nameInput"
                      >
                        <b-form-input
                          v-model="form.name"
                          :state="errors[0] ? false : (valid ? true : null)"
                          placeholder="Enter your name"/>
                        <b-form-invalid-feedback id="inputLiveFeedback">
                          {{ errors[0] }}
                        </b-form-invalid-feedback>
                      </b-form-group>
                    </ValidationProvider>

                    <ValidationProvider rules="required|email"
                                        name="Email"
                                        ref="emailProvider"
                                        v-slot="{ valid, errors }">
                      <b-form-group
                        label="Email address:"
                        label-for="exampleInput1"
                        description="We'll never share your email with anyone else."
                      >
                        <b-form-input
                          type="email"
                          v-model="form.email"
                          :state="errors[0] ? false : (valid ? true : null)"
                          placeholder="Enter email"/>
                        <b-form-invalid-feedback id="inputLiveFeedback">
                          {{ errors[0] }}
                        </b-form-invalid-feedback>
                      </b-form-group>
                    </ValidationProvider>

                    <ValidationProvider
                      rules="required"
                      name="Password"
                      ref="passwordProvider"
                      vid="password"
                      v-slot="{ valid, errors }"
                      minlength="8"
                    >
                      <b-form-group
                        label="Password:"
                        description="We'll never share your password with anyone else."
                      >
                        <b-form-input
                          type="password"
                          v-model="form.password"
                          :state="errors[0] ? false : (valid ? true : null)"
                          placeholder="Enter password"
                        ></b-form-input>
                        <b-form-invalid-feedback id="inputLiveFeedback">
                          {{ errors[0] }}
                        </b-form-invalid-feedback>
                      </b-form-group>
                    </ValidationProvider>

                    <ValidationProvider
                      rules="required|confirmed:password"
                      name="Password confirmation"
                      ref="passwordConfirmationProvider"
                      v-slot="{ valid, errors }"
                    >
                      <b-form-group label="Confirm Password:" label-for="exampleInput1">
                        <b-form-input
                          type="password"
                          v-model="form.passwordConfirmation"
                          :state="errors[0] ? false : (valid ? true : null)"
                          placeholder="Confirm Password"
                        ></b-form-input>
                        <b-form-invalid-feedback id="inputLiveFeedback">
                          {{ errors[0] }}
                        </b-form-invalid-feedback>
                      </b-form-group>
                    </ValidationProvider>

                    <b-button type="submit" variant="primary" class="m-1">Submit</b-button>
                    <b-button type="reset" variant="danger" class="m1">Reset</b-button>
                  </b-form>
                </ValidationObserver>
              </b-container>
            </b-card-text>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { ValidationObserver, ValidationProvider } from 'vee-validate';
import RepositoryFactory from '../apiAccess/repositoryFactory';

const AuthRepository = RepositoryFactory.get('auth');

export default {
  name: 'register',
  components: {
    ValidationObserver,
    ValidationProvider,
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        passwordConfirmation: '',
      },
    };
  },
  methods: {
    validateState(ref) {
      if (
        this.veeFields[ref]
        && (this.veeFields[ref].dirty || this.veeFields[ref].validated)
      ) {
        return !this.veeErrors.has(ref);
      }
      return null;
    },
    onSubmit() {
      const data = AuthRepository.register(this.form);

      data.then((response) => {
        const user = {
          token: response.data.access_token,
        };

        AuthRepository.setAuthToken(user.token);
        localStorage.setItem('user-token', user.token);

        this.$store.commit('setUser', user);
        this.newProgram();

        this.$router.push({ name: 'workspace' });
      }).catch((errorResponse) => {
        const { errors } = errorResponse.response.data;

        if (Object.prototype.hasOwnProperty.call(errors, 'name')) {
          this.$refs.nameProvider.setErrors(errors.name);
        }

        if (Object.prototype.hasOwnProperty.call(errors, 'email')) {
          this.$refs.emailProvider.setErrors(errors.email);
        }

        if (Object.prototype.hasOwnProperty.call(errors, 'password')) {
          this.$refs.passwordProvider.setErrors(errors.password);
        }
      });
    },

    resetForm() {
      this.from.name = '';
      this.from.email = '';
      this.from.password = '';
      this.from.passwordConfirmation = '';
      requestAnimationFrame(() => {
        this.$refs.observer.reset();
      });
    },

    newProgram() {
      const newProgram = {
        id: 1,
        name: 'New program',
        program: '',
        changed: true,
        created: true,
      };

      this.$store.commit('setSelectedProgram', newProgram);
      this.$store.commit('setSavedPrograms', [newProgram]);
    },
  },
};
</script>
