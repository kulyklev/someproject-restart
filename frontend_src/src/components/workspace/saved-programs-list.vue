<template>
  <div>
    <span>The list of saved methods</span>

    <b-list-group class="text-left">
      <b-list-group-item button v-for="(program) in programs"
                         v-bind:key="program.id"
                         :class="{ 'active': (selectedProgram.id) === program.id }"
                         @click="openProgram(program.id)">
        {{ program.name }}
        <b-badge variant="warning"
                 :class="{ 'd-none': program.changed === false }">Unsaved</b-badge>
      </b-list-group-item>
    </b-list-group>
  </div>
</template>

<script>
export default {
  name: 'saved-programs-list',

  data() {
    return {
    };
  },

  methods: {
    openProgram(programId) {
      const programs = this.$store.state.savedPrograms;
      const selectedProgram = programs.find(program => program.id === programId);

      this.$store.commit('setSelectedProgram', selectedProgram);
    },
  },
  computed: {
    selectedProgram() {
      const { selectedProgram } = this.$store.state;
      return selectedProgram;
    },
    programs() {
      return this.$store.state.savedPrograms;
    },
  },
};
</script>
