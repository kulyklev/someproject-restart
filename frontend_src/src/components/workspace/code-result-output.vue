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
      <h2>Python console</h2>
      <pre class="text-left border" id="pythonCodeOutput">{{ pythonCodeErrors }}</pre>
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
      handler(data) {
        this.chartOptions.series = this.prepareData(data);
      },
      deep: true,
    },
  },
  methods: {
    prepareData(chartData) {
      const res = [];
      const xAxis = chartData[0];
      const yAxis = chartData[1];

      if (xAxis.length === yAxis.length) {
        // eslint-disable-next-line no-plusplus
        for (let i = 0; i < xAxis.length; i++) {
          res.push([xAxis[i], yAxis[i]]);
        }
        const tmp = {};
        tmp.data = chartData;

        console.log(tmp);

        return chartData;
      }
      // alert('Data for xAxis and yAxis has different length');
      return [];
    },
  },
};
</script>

<style scoped>

</style>
