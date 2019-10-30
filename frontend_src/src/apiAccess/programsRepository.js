import Repository from './repository';

// const resource = '/lala';

export default {
  get() {
    // TODO Get all programs
    // return Repository.post('/register', formData);
  },

  save(newProgram) {
    const formData = new FormData();

    formData.set('name', newProgram.name);
    formData.set('program', newProgram.code);

    return Repository.post('/programs', formData);
  },

  update(updatedProgram) {
    // TODO Update programs
  },

  delete(programId) {
    // TODO delete program
  },
};
