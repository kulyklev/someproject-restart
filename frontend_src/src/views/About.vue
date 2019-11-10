<template>
  <b-container>
    <b-row>
      <h1>Інструкція для роботи з сервісом</h1>

      <b-card title="Відображення даних" class="text-left">
        <b-card-text>
          Існує два способи побудови графіків та візуалізації данних в данному сервісі:
        </b-card-text>

        <b-card-text>
          1. Візуалізувати данні засобами Python, перетворити візуалізованні данні у катринку та відобразити її.
          Данний спосіб краще підходить для відображення складних поверхонь та подібних речей.
          Для побудови гафіків краще використовувати другий спосіб.
          Для цього необхідно використати для візуалізації данних біблітеки <b>matplotlib</b> та перетворити
          побудоване відображення у картинку. Картинку необхідно помістити у змнінну <b>img_str</b>. Приклад наведено нижче.

          <codemirror v-model="codeExample1"
                      :options="cmOptions"
                      class="text-left"
                      style="border: 1px solid #eee; height: auto;"/>
        </b-card-text>

        <b-card-text>
          2. Візуалізувати данні засобами JavaScript. Для цього необхідно згенерувати точки за якими буде побудовано графік
          та повернути масив об'єктів заданого формати. Де кожен об'єкт представляє собою одну криву на графіку.
          Приклад побудови графіка та форматування даних з використанням данного способу наведено нижче.

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
    };
  },
};
</script>
