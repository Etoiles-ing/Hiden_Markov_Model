
<link href="dashboard.css" rel="stylesheet">
<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script><script src="dashboard/dashboard.js"></script>

<br><br><br><br>
<h2>Markov Matrix</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm text-white-50">
          <thead>
            <tr>
              <th scope="col">Page</th>
              <?php
              for ($i=0;$i<5;$i++){
                $textcolorPrev = ($i == $currentPage) ? 'style="color: #DE0220;"' : 'class="text-white-50"';
                echo ('<th scope="col" '. $textcolorPrev .'> Page '.strval($i)."</th>");
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i=0;$i<5;$i++){
                $textcolorNext = ($i == $currentPage) ? 'style="color: #007bff;"' : 'class="text-white-50"';
                echo ("<tr>");
                echo ('<td '. $textcolorNext .'> Page '.strval($i)."</td>");
                for ($j=0;$j<5;$j++){
                    echo ('<td class="text-white-50" >'.strval($markovModelMatrix[$i][$j][0])." | ".strval(number_format($markovModelMatrix[$i][$j][1]*100))."% | ".strval(number_format($markovModelMatrix[$i][$j][2]*100))."%</td>");
                }
                echo ("</tr>");
            }
            ?>
            </body>
        </table>
    </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
