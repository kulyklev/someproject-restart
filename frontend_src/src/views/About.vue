<template>
  <b-container>
    <b-row>
      <h1>Інструкція для роботи з сервісом</h1>

      <b-card title="Відображення даних" class="text-left">
        <b-card-text>
          Існує два способи побудови графіків та візуалізації данних в данному сервісі:
        </b-card-text>

        <b-card-text>
          1. Візуалізація задопомогою засобів Python виконується наступним чином,
          будується графік задопомогою біблітеки <b>matplotlib</b>, який потім перетворюється
          у зображення. Зображення необхідно помістити у змнінну <b>img_str</b>.
          Приклад наведено нижче.

          <codemirror v-model="codeExample1"
                      :options="cmOptions"
                      class="text-left"
                      style="border: 1px solid #eee; height: auto;"/>
        </b-card-text>

        <b-card-text>
          2. Візуалізація даних засобами JavaScript відбувається задопомогою бібліотеки
          <a href="https://www.highcharts.com/">Highcharts</a>. Для цього потрібно згенерувати об'єкт
          chartOptions.series. Опис цього об'єкта та можливих значень можно знайти за
          <a href="https://www.highcharts.com/docs/chart-concepts/series">цим посиланням</a> та
          <a href="https://api.highcharts.com/highcharts/series">цим</a>.
          <b>Згенерований об'єкт обов'язково повинен викликатися в останній строчці програми.</b>

          <codemirror v-model="codeExample2"
                      :options="cmOptions"
                      class="text-left"
                      style="border: 1px solid #eee; height: auto;"/>
        </b-card-text>

        <b-card-text>
          3. Приклад побудови двох графіків задопомогою засобів JavaScript.

          <codemirror v-model="codeExample3"
                      :options="cmOptions"
                      class="text-left"
                      style="border: 1px solid #eee; height: auto;"/>
        </b-card-text>
      </b-card>

      <b-card title="Завантаження файлів з даними" class="text-left">
        <b-card-text>
          Зараз достпуний тільки один спосіб завантаження файлів задопомогою Python
          бібліотеки pandas. Для цього необхідно завантажити файл у хмарне сховище
          даних(наприклад Google Drive або Dropbox) та зробити його доступним за посиланням.
          Приклад такого завантаження наведено нижче.

          <codemirror v-model="codeExample4"
                      :options="cmOptions"
                      class="text-left"
                      style="border: 1px solid #eee; height: auto;"/>
        </b-card-text>
      </b-card>

    </b-row>
  </b-container>
</template>

<script>
import { codemirror } from 'vue-codemirror';
import 'codemirror/lib/codemirror.css';
import 'codemirror/mode/python/python';
import 'codemirror/theme/elegant.css';
import '../assets/styles/about.scss';

export default {
  components: {
    codemirror,
  },
  name: 'code-mirror-editor',

  data() {
    return {
      cmOptions: {
        readOnly: true,
        mode: 'text/x-python',
        tabSize: 1,
        styleActiveLine: true,
        lineNumbers: true,
        line: true,
        foldGutter: true,
        styleSelectedText: true,
        matchBrackets: true,
        showCursorWhenSelecting: true,
        theme: 'elegant',
        extraKeys: { Ctrl: 'autocomplete' },
        hintOptions: {
          completeSingle: false,
        },
      },
      codeExample1: 'import matplotlib.pyplot as plt\n'
                    + 'import io, base64\n'
                    + '    \n'
                    + 'fig, ax = plt.subplots()\n'
                    + 'ax.plot([1,3,2])\n'
                    + '    \n'
                    + 'buf = io.BytesIO()\n'
                    + 'fig.savefig(buf, format=\'png\')\n'
                    + 'buf.seek(0)\n'
                    + 'img_str = \'data:image/png;base64,\' + base64.b64encode(buf.read()).decode(\'UTF-8\')',
      codeExample2: 'import numpy as np\n'
                    + '\n'
                    + 'x = np.linspace(0, 2.0 * np.pi, 100)\n'
                    + 'y = np.sin(x)\n'
                    + '\n'
                    + 'x1 = np.linspace(1, 2.0 * np.pi, 100)\n'
                    + 'y1 = np.sin(x)\n'
                    + '\n'
                    + 'resList = []\n'
                    + '\n'
                    + 'chart1 = {\n'
                    + ' "type": "line",\n'
                    + ' "name": "Chart 1",\n'
                    + ' "dataX": x,\n'
                    + ' "dataY": y,\n'
                    + '}\n'
                    + '\n'
                    + 'chart2 = {\n'
                    + ' "type": "line",\n'
                    + ' "name": "Chart 1",\n'
                    + ' "dataX": x1,\n'
                    + ' "dataY": y1,\n'
                    + '}\n'
                    + '\n'
                    + 'resList.append(chart1)\n'
                    + 'resList.append(chart2)\n'
                    + '\n'
                    + 'resList',
      codeExample3: 'import numpy as np\n'
                    + 'x = np.linspace(0, 2.0 * np.pi, 100)\n'
                    + 'y = np.sin(x)\n'
                    + '\n'
                    + 'x1 = np.linspace(0, 2.0 * np.pi, 100)\n'
                    + 'y1 = np.sin(x1/2)\n'
                    + '                \n'
                    + 'tmp = np.vstack((x, y)).T\n'
                    + 'tmp1 = np.vstack((x1, y1)).T\n'
                    + '\n'
                    + 'listArr = []\n'
                    + 'listArr.append({\n'
                    + '\t"type": "line",\n'
                    + '\t"name": "lalala",\n'
                    + '\t"data": tmp,\n'
                    + '})\n'
                    + 'listArr.append({\n'
                    + '\t"type": "line",\n'
                    + '\t"name": "lololo",\n'
                    + '\t"data": tmp1,\n'
                    + '})\n'
                    + '\n'
                    + 'listArr',
      codeExample4: 'import pyodide\n'
                    + 'import pandas as pd\n'
                    + '\n'
                    + 'data_url = "http://www.sentiweb.fr/datasets/incidence-PAY-3.csv"\n'
                    + '\n'
                    + 'raw_data = pd.read_csv(pyodide.open_url(data_url), skiprows=1)\n'
                    + '\n'
                    + 'print(raw_data)',
    };
  },
};
</script>
