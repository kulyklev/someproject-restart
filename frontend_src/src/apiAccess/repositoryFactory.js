import AuthRepository from './authRepository';

const repositories = {
  auth: AuthRepository,
};

const RepositoryFactory = {
  get: name => repositories[name],
  // post: name => repositories[name],
};

export default RepositoryFactory;
