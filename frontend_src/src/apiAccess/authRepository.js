import Repository from './repository';

// const resource = '/lala';

export default {
  register(payload) {
    return Repository.post('/register', payload);
  },

  login(payload) {
    const formData = new FormData();

    formData.set('email', payload.email);
    formData.set('password', payload.password);

    return Repository.post('/login', formData);
  },
};
