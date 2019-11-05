import Repository from './repository';

// const resource = '/lala';

export default {
  get() {
    return Repository.get('programs');
  },

  save(newProgram) {
    const formData = new FormData();

    formData.set('name', newProgram.name);
    formData.set('program', newProgram.program);

    return Repository.post('/programs', formData);
  },

  update(updatedProgram) {
    const programId = updatedProgram.id;
    const formData = new FormData();

    formData.set('name', updatedProgram.name);
    formData.set('program', updatedProgram.program);
    formData.set('_method', 'PUT');

    return Repository.post(`/programs/${programId}`, formData);
  },

  delete(selectedProgram) {
    const programId = selectedProgram.id;
    const formData = new FormData();
    formData.set('_method', 'DELETE');

    return Repository.delete(`/programs/${programId}`);
  },
};
