<script>
/* import { Line, mixins } from 'vue-chartjs';

const { reactiveData } = mixins;

export default {
  extends: Line,
  mixins: [reactiveData],
  props: ['options'],
  mounted() {
    // this.chartData is created in the mixin.
    // If you want to pass options please create a local options object
    this.renderChart(this.chartData, this.options);
  },
  watch: {
    '$store.state.codeResultOutput': {
      handler(data) {
        this.chartData = this.prepareData(data);
      },
      deep: true,
    },
  },
  methods: {
    prepareData(chartData) {
      const res = [];
      const xAxis = chartData[0];
      const yAxis = chartData[1];

      if (xAxis.length !== yAxis.length) {
        // eslint-disable-next-line no-plusplus
        for (let i = 0; i < xAxis.length; i++) {
          res.push([xAxis[i], yAxis[i]]);
        }
        return res;
      }
      // alert('Data for xAxis and yAxis has different length');
      return [];
    },
  },

}; */
</script>


<!--<script>-->
<!--    import { Line, mixins } from 'vue-chartjs';-->
<!--    const { reactiveProp } = mixins;-->

<!--export default {-->
<!--    extends: Line,-->
<!--    mixins: [reactiveProp],-->
<!--    name: 'result-chart',-->
<!--    props: {-->
<!--        chartData: {-->
<!--            type: Object,-->
<!--            default: null-->
<!--        },-->
<!--        options: {-->
<!--            type: Object,-->
<!--            default: null-->
<!--        }-->
<!--    },-->
<!--    data() {-->
<!--        return {-->
<!--          chartInfo: this.chartData-->
<!--        };-->
<!--    },-->
<!--    mounted () {-->
<!--        this.renderChart(this.chartInfo, this.options)-->
<!--    },-->
<!--    computed: {-->
<!--        codeResultOutput() {-->
<!--            return this.$store.state.codeResultOutput;-->
<!--        },-->
<!--    },-->
<!--    watch: {-->
<!--        codeResultOutput(newDataset) {-->
<!--            this.chartInfo = newDataset;-->
<!--        },-->
<!--    },-->
<!--    /*mounted() {-->
<!--        this.renderChart(this.chartData, options);-->
<!--    }*/-->
<!--};-->
<!--</script>-->
