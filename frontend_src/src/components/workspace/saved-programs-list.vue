<template>
  <div>
    <span>The list of saved methods</span>

    <b-list-group class="text-left">
      <b-list-group-item button v-for="(program, index) in programs"
                         v-bind:key="program.id"
                         :class="{ 'active': activeProgramId === index }"
                         @click="openProgram(program.id)">
        {{ program.name }}
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

      this.$store.commit('setActiveProgramId', programId - 1);
      this.$store.commit('setInputCode', selectedProgram.code);
      this.$store.commit('setSelectedProgram', selectedProgram);
    },
  },
  computed: {
    activeProgramId() {
      const { activeProgramId } = this.$store.state;
      return activeProgramId;
    },
    programs() {
      return this.$store.state.savedPrograms;
    },
  },
};
</script>

<style scoped>

</style>
