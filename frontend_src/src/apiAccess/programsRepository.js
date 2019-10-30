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
    const programId = updatedProgram.id;
    const formData = new FormData();

    formData.set('name', updatedProgram.name);
    formData.set('program', updatedProgram.code);
    formData.set('_method', 'PUT');

    return Repository.post(`/programs/${programId}`, formData);
  },

  delete(programId) {
    // TODO delete program
  },
};
