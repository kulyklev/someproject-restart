<template>
  <div class="text-left m-3">
    <loading :active.sync="isLoading" :can-cancel="false" :is-full-page="true"/>

    <b-row class="mb-1">
      <b-form-input v-model="selectedProgram.name" placeholder="Enter your program name"/>
    </b-row>

    <b-row>
      <b-form-group label-for="editorTheme"
                    label="Editor theme" label-cols="4" >
        <b-form-select v-model="selectedCodemirrorTheme"
                       id="editorTheme"
                       :options="codemirrorThemes"/>
      </b-form-group>
    </b-row>

    <b-row>
      <b-button-group class="m-1">
        <b-button variant="outline-primary" class="mr-1" @click="runProgram()">
          <font-awesome-icon icon="play" />
        </b-button>

        <b-button variant="outline-primary" class="mr-1">
          Save
        </b-button>

        <b-button variant="outline-primary" class="mr-1" @click="newProgram()">
          New
        </b-button>

        <b-button variant="outline-primary" class="mr-1">
          Delete
        </b-button>
      </b-button-group>
    </b-row>
  </div>
</template>

<script>
import { test } from '../../pyodide/pyodide';
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
  name: 'code-mirror-control-panel',
  data() {
    return {
      isLoading: false,
      file: null,
      codemirrorThemes: [
        { value: 'default', text: 'default' },
        { value: '3024-day', text: '3024-day' },
        { value: '3024-night', text: '3024-night' },
        { value: 'abcdef', text: 'abcdef' },
        { value: 'ambiance', text: 'ambiance' },
        { value: 'base16-dark', text: 'base16-dark' },
        { value: 'base16-light', text: 'base16-light' },
        { value: 'bespin', text: 'bespin' },
        { value: 'blackboard', text: 'blackboard' },
        { value: 'cobalt', text: 'cobalt' },
        { value: 'colorforth', text: 'colorforth' },
        { value: 'darcula', text: 'darcula' },
        { value: 'dracula', text: 'dracula' },
        { value: 'duotone-dark', text: 'duotone-dark' },
        { value: 'duotone-light', text: 'duotone-light' },
        { value: 'eclipse', text: 'eclipse' },
        { value: 'elegant', text: 'elegant' },
        { value: 'erlang-dark', text: 'erlang-dark' },
        { value: 'gruvbox-dark', text: 'gruvbox-dark' },
        { value: 'hopscotch', text: 'hopscotch' },
        { value: 'icecoder', text: 'icecoder' },
        { value: 'idea', text: 'idea' },
        { value: 'isotope', text: 'isotope' },
        { value: 'lesser-dark', text: 'lesser-dark' },
        { value: 'liquibyte', text: 'liquibyte' },
        { value: 'lucario', text: 'lucario' },
        { value: 'material', text: 'material' },
        { value: 'material-darker', text: 'material-darker' },
        { value: 'material-palenight', text: 'material-palenight' },
        { value: 'material-ocean', text: 'material-ocean' },
        { value: 'mbo', text: 'mbo' },
        { value: 'mdn-like', text: 'mdn-like' },
        { value: 'midnight', text: 'midnight' },
        { value: 'monokai', text: 'monokai' },
        { value: 'moxer', text: 'moxer' },
        { value: 'neat', text: 'neat' },
        { value: 'neo', text: 'neo' },
        { value: 'night', text: 'night' },
        { value: 'nord', text: 'nord' },
        { value: 'oceanic-next', text: 'oceanic-next' },
        { value: 'panda-syntax', text: 'panda-syntax' },
        { value: 'paraiso-dark', text: 'paraiso-dark' },
        { value: 'paraiso-light', text: 'paraiso-light' },
        { value: 'pastel-on-dark', text: 'pastel-on-dark' },
        { value: 'railscasts', text: 'railscasts' },
        { value: 'rubyblue', text: 'rubyblue' },
        { value: 'seti', text: 'seti' },
        { value: 'shadowfox', text: 'shadowfox' },
        { value: 'solarized dark', text: 'solarized dark' },
        { value: 'solarized light', text: 'solarized light' },
        { value: 'the-matrix', text: 'the-matrix' },
        { value: 'tomorrow-night-bright', text: 'tomorrow-night-bright' },
        { value: 'tomorrow-night-eighties', text: 'tomorrow-night-eighties' },
        { value: 'ttcn', text: 'ttcn' },
        { value: 'twilight', text: 'twilight' },
        { value: 'vibrant-ink', text: 'vibrant-ink' },
        { value: 'xq-dark', text: 'xq-dark' },
        { value: 'xq-light', text: 'xq-light' },
        { value: 'yeti', text: 'yeti' },
        { value: 'yonce', text: 'yonce' },
        { value: 'zenburn', text: 'zenburn' },
      ],
        };
    },
    components: {
      Loading
    },
    computed: {
      selectedCodemirrorTheme: {
        get() {
            return this.$store.state.codemirrorTheme;
        },
        set(selectedCodemirrorTheme) {
            this.$store.commit('setCodemirrorTheme', selectedCodemirrorTheme);
        },
      },
      selectedProgram: {
          get() {
              if (this.$store.state.selectedProgram == null) {
                  return '';
              } else {
                  return this.$store.state.selectedProgram;
              }
          },
          set(selectedProgramName) {
              let tmp = this.selectedProgram;
              tmp.name = selectedProgramName;
              this.$store.commit('setSelectedProgram', tmp);
          }
      }
    },
    methods: {
      runProgram() {
          const { code } = this.$store.state;
          let codeResultOutput = null;
/*
          functioddn yourCustomLog(msfsg) {
            var oldLog = console.log;
            console.log = functioasdn (message) {
              alert(message);
              oldLog.apply(console, arguments);
            };
          }asd

          window.console.log = yourCustomLog;*/

          this.isLoading = true;

          test().then(() => {
              pyodide.loadPackage(['numpy', 'pandas']).then(() => {
                  codeResultOutput = pyodide.runPython(code);
                  this.prepareChartData(codeResultOutput);
                  this.isLoading = false;
              }).catch(e => {
                  this.$store.commit('setPythonCodeErrors', e);
                  this.isLoading = false;
              });
          }).catch(e => {
              this.isLoading = false;
          });
        },

      newProgram() {
          let programs = this.$store.state.savedPrograms;
          let maxId = Math.max(...programs.map(program => program.id));
          let newProgramId = maxId + 1;

          let newProgram = {
              id: newProgramId,
              name: 'New program',
              code: ''
          };

          this.$store.commit('setActiveProgramId', newProgramId - 1);
          programs.push(newProgram);
      },

      prepareChartData(codeResultOutput) {
          if (codeResultOutput == null) {
              alert('You didn`t return any data. Chart won`t be drown');
          } else {
            this.$store.commit('setCodeResultOutput', codeResultOutput);
          }
      }
    },
};
</script>
