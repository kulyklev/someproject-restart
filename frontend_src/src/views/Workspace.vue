<template>
  <b-container fluid>
    <b-row class="ml-1 mr-1">
      <b-col sm="3" md="2">
        <saved-programs-list></saved-programs-list>
      </b-col>

      <b-col sm="9" md="10">
        <b-row>
          <b-col md="6">
            <code-mirror-editor></code-mirror-editor>
          </b-col>

          <b-col md="6">
            <code-result-output></code-result-output>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import CodeMirrorEditor from '../components/workspace/code-mirror-editor.vue';
import SavedProgramsList from '../components/workspace/saved-programs-list.vue';
import CodeResultOutput from '../components/workspace/code-result-output.vue';

export default {
  name: 'Workspace',
  components: {
    CodeMirrorEditor,
    CodeResultOutput,
    SavedProgramsList,
  },
  methods: {
    createFirstProgram() {
      const newProgram = {
        id: 1,
        name: 'New program',
        program: '',
        changed: true,
      };

      this.$store.commit('setSelectedProgram', newProgram);
      this.$store.commit('addProgramToSavedPrograms', newProgram);
    },
    selectProgramWithMinId(programs) {
      const minProgramId = Math.min(...programs.map(program => program.id));
      const selectedProgram = programs.find(program => program.id === minProgramId);
      this.$store.commit('setSelectedProgram', selectedProgram);
    },
  },
  created() {
    const programs = this.$store.state.savedPrograms;

    if (programs.length === 0) {
      this.createFirstProgram();
    } else {
      this.selectProgramWithMinId(programs);
    }
  },
};
</script>
