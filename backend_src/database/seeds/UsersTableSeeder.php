<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\Models\User::class)->make();
        $user->save();

        $program1 = new \App\Models\Program();
        $program1->name = 'File download';
        $program1->program = 'import pyodide
import pandas as pd

data_url = "http://www.sentiweb.fr/datasets/incidence-PAY-3.csv"

raw_data = pd.read_csv(pyodide.open_url(data_url), skiprows=1)

print(raw_data)';

        $program2 = new \App\Models\Program();
        $program2->name = 'File download from browser. Not good idea';
        $program2->program = 'from js import document
from pprint import pprint

tmp = document.getElementById("__BVID__18").files;

f = open(tmp[0], "r")
print(f.read())';

        $program3 = new \App\Models\Program();
        $program3->name = 'Building chart';
        $program3->program = 'import numpy as np

x = np.linspace(0, 2.0 * np.pi, 100)
y = np.sin(x)
x, y';

        $program4 = new \App\Models\Program();
        $program4->name = 'Building in python';
        $program4->program = 'import matplotlib.pyplot as plt
                import numpy as np
                import io, base64

                x = np.linspace(0, 2.0 * np.pi, 100)
                y = np.sin(x)


                fig, ax = plt.subplots()
                ax.plot(x, y)

                buf = io.BytesIO()
                fig.savefig(buf, format=\'png\')
                buf.seek(0)
                img_str = \'data:image/png;base64,\' + base64.b64encode(buf.read()).decode(\'UTF-8\')';

        $program5 = new \App\Models\Program();
        $program5->name = 'Build chart';
        $program5->program = 'import numpy as np
                x = np.linspace(0, 2.0 * np.pi, 100)
                y = np.sin(x)
                
                x1 = np.linspace(0, 2.0 * np.pi, 100)
                y1 = np.sin(x1)
                
                tmp = np.vstack((x, y)).T
                tmp1 = np.vstack((x1, y1)).T
                
                listArr = []
                listArr.append({
                  "type": "line",
                  "name": "lalala",
                  "data": tmp,
                })
                listArr.append({
                  "type": "line",
                  "name": "lololo",
                  "data": tmp1,
                })
                
                listArr';

        $user->programs()->save($program1);
        $user->programs()->save($program2);
        $user->programs()->save($program3);
        $user->programs()->save($program4);
        $user->programs()->save($program5);

        /*factory(App\Models\User::class, 2)->create()->each(function ($user) {
            $user->programs()->save(factory(App\Models\Program::class)->make());
        });*/
    }
}
