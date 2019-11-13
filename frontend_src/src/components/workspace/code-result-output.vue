<template>
  <b-container fluid>
    <b-row>
      <h2>Data visualisation</h2>
    </b-row>
    <b-row class="halfViewPortHeight" id="jsChart">
      <highcharts :options="chartOptions"></highcharts>
    </b-row>

    <b-row class="d-none" id="pyPlotDiv">
      <b-img id="pyPlotFigure"/>
    </b-row>

    <b-row class="halfViewPortHeight">
      <h2 style="max-height: 1.5em">Python console</h2>
      <b-form-textarea id="pythonCodeOutput" class="bg-light" plaintext rows="15"></b-form-textarea>
    </b-row>
  </b-container>
</template>

<script>
import { Chart } from 'highcharts-vue';

export default {
  name: 'code-result-output',
  components: {
    highcharts: Chart,
  },
  data() {
    return {
      chartOptions: {
        chart: {
          type: 'line',
        },

        series: [{
          data: [
            [0, 29.9],
            [1, 71.5],
            [3, 106.4],
          ],
        }],
      },
    };
  },
  computed: {
    pythonCodeErrors() {
      return this.$store.state.pythonCodeErrors;
    },
  },
  watch: {
    '$store.state.codeResultOutput': {
      handler(chartData) {
        this.chartOptions.series = chartData;
      },
      deep: true,
    },
  },
  methods: {
  },
};
</script>

<style scoped>

</style>
