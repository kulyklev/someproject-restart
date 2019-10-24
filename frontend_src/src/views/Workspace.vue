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
// import LineChart from '../components/workspace/result-chart.vue';
import SavedProgramsList from '../components/workspace/saved-programs-list.vue';
import CodeResultOutput from '../components/workspace/code-result-output.vue';

export default {
  name: 'Workspace',
  components: {
    CodeMirrorEditor,
    // LineChart,
    CodeResultOutput,
    SavedProgramsList,
  },
};
</script>
