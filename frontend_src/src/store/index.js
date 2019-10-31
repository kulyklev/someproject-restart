import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    codemirrorTheme: 'default',
    savedPrograms: [
      {
        id: 1,
        name: 'File download',
        code: 'import pyodide\n'
          + 'import pandas as pd\n'
          + '\n'
          + 'data_url = "http://www.sentiweb.fr/datasets/incidence-PAY-3.csv"\n'
          + '\n'
          + 'raw_data = pd.read_csv(pyodide.open_url(data_url), skiprows=1)\n'
          + '\n'
          + 'print(raw_data)',
        changed: false,
      },
      {
        id: 2,
        name: 'File download from browser. Not good idea',
        code: 'from js import document\n'
          + 'from pprint import pprint\n'
          + '\n'
          + '\n'
          + '\n'
          + 'tmp = document.getElementById("__BVID__18").files;\n'
          + '\n'
          + 'f = open(tmp[0], "r")\n'
          + 'print(f.read())',
        changed: false,
      },
      {
        id: 3,
        name: 'Building chart',
        code: 'import numpy as np\n'
          + '\n'
          + 'x = np.linspace(0, 2.0 * np.pi, 100)\n'
          + 'y = np.sin(x)\n'
          + 'x, y',
        changed: false,
      },
    ],
    selectedProgram: null,
    code: '',
    codeResultOutput: '',
    pythonCodeErrors: '',
    user: {
      token: localStorage.getItem('user-token') || null,
    },
  },
  mutations: {
    setCodemirrorTheme(state, selectedCodemirrorTheme) {
      state.codemirrorTheme = selectedCodemirrorTheme;
    },
    setCodeResultOutput(state, codeResultOutput) {
      state.codeResultOutput = codeResultOutput;
    },
    setSelectedProgram(state, selectedProgram) {
      state.selectedProgram = selectedProgram;
    },
    setPythonCodeErrors(state, pythonCodeErrors) {
      state.pythonCodeErrors = pythonCodeErrors;
    },
    addProgramToSavedPrograms(state, newProgram) {
      state.savedPrograms.push(newProgram);
    },
    updateSavedPrograms(state, updatedProgram) {
      const programs = state.savedPrograms;
      const foundIndex = programs.findIndex(programm => programm.id === updatedProgram.id);
      programs[foundIndex] = updatedProgram;
      state.savedPrograms = programs;
    },
    deleteSavedProgram(state, programToDelete) {
      const programs = state.savedPrograms;
      const foundIndex = programs.findIndex(programm => programm.id === programToDelete.id);
      programs.splice(foundIndex, 1);
      state.savedPrograms = programs;
    },
    setUser(state, user) {
      state.user = user;
    },
    setSavedPrograms(state, savedPrograms) {
      state.savedPrograms = savedPrograms;
    },
  },
  actions: {
  },
  getters: {
    user(state) {
      return state.user;
    },
  },
  modules: {
  },
});
