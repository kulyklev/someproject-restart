<template>
  <div class="workspace w-100">
    <b-row class="ml-1 mr-1">
      <b-col cols="2">
        <saved-programs-list></saved-programs-list>
      </b-col>
      <b-col>
        <code-mirror-editor></code-mirror-editor>
      </b-col>
      <b-col>
        <code-result-output></code-result-output>
<!--        <line-chart/>-->
      </b-col>
    </b-row>
  </div>
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
        code: '',
      };

      this.$store.commit('setSelectedProgram', newProgram);
      this.$store.commit('setNewProgram', newProgram);
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
