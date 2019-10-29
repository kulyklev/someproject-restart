import Repository from './repository';

// const resource = '/lala';

export default {
  register(payload) {
    const formData = new FormData();

    formData.set('name', payload.name);
    formData.set('email', payload.email);
    formData.set('password', payload.password);
    formData.set('password_confirmation', payload.passwordConfirmation);

    return Repository.post('/register', formData);
  },

  login(payload) {
    const formData = new FormData();

    formData.set('email', payload.email);
    formData.set('password', payload.password);

    return Repository.post('/login', formData);
  },

  setAuthToken(token) {
    Repository.defaults.headers.common['Authorization'] = token;
  },
};
