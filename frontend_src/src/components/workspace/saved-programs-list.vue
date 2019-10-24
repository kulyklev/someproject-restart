<template>
  <div>
    <span>The list of saved methods</span>

    <b-list-group class="text-left">
      <b-list-group-item button v-for="program in programs"
                         v-bind:key="program.id"
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
      programs: [],
    };
  },

  methods: {
    openProgram(programId) {
      const programs = this.$store.state.savedPrograms;
      const selectedProgram = programs.find(program => program.id === programId);

      this.$store.commit('setInputCode', selectedProgram.code);
      this.$store.commit('setSelectedProgram', selectedProgram);
    },
  },

  mounted() {
    this.programs = this.$store.state.savedPrograms;
  },
};
</script>

<style scoped>

</style>
