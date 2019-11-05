import AuthRepository from './authRepository';
import ProgramRepository from './programsRepository';

const repositories = {
  auth: AuthRepository,
  program: ProgramRepository,
};

const RepositoryFactory = {
  get: name => repositories[name],
};

export default RepositoryFactory;
