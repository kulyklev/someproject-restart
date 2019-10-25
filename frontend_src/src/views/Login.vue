<template>
  <div class="login">
    <h1>This is a login page</h1>
    <b-container>
      <b-row>
        <b-col cols="12" sm="6" offset-sm="3">
          <b-card>
            <b-card-text>
              <b-container>
                <b-form class="text-left">
                  <b-form-group id="email-input-group"
                                label="Email address:"
                                label-for="email-input">
                    <b-form-input v-model="form.email"
                                  id="email-input"
                                  type="email"
                                  placeholder="Enter your email"
                                  required/>
                  </b-form-group>

                  <b-form-group id="password-input-group"
                                label="Password:"
                                label-for="password-input">
                    <b-form-input v-model="form.password"
                                  id="password-input"
                                  type="password"
                                  placeholder="Enter your password"
                                  required/>
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
export default {
  name: 'Login',
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
};
</script>
