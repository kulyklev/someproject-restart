<template>
  <b-container>
    <h2>Charts</h2>
    <b-row>
      <b-col cols="12" class="halfViewPortHeight">
        <highcharts :options="chartOptions"></highcharts>
      </b-col>

      <b-col cols="12" class="halfViewPortHeight">
        <h2>Python console</h2>
        <pre class="text-left border">{{ pythonCodeErrors }}</pre>
      </b-col>
    </b-row>
    <div id="pyplotdiv"><img id="pyplotfigure"/></div>
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
        tmp.data = res;
        console.log(tmp);
        return tmp;
      }
      // alert('Data for xAxis and yAxis has different length');
      return [];
    },
  },
};
</script>

<style scoped>

</style>
