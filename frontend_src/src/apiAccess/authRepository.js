import Repository from './repository';

// const resource = '/lala';

export default {
  register(payload) {
    return Repository.post('/register', payload);
  },

  login(payload) {
    return Repository.post('/login', payload);
  },
};
