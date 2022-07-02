
        <?php
          /* Database connection settings */
          $host = 'localhost';
          $user = 'root';
          $pass = '';
          $db = 'nicepage';
          $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);


          $job_location = '';
          $count_company_byLocation = '';


          //query to get data from the table
          $sql = "WITH tempTable AS ( SELECT job_location, COUNT(DISTINCT company) AS count_company_byLocation FROM `results5 updated` GROUP BY job_location ) SELECT * FROM tempTable ORDER BY count_company_byLocation DESC LIMIT 0,10; ";
            $result = mysqli_query($mysqli, $sql);

          //loop through the returned data
          while ($row = mysqli_fetch_array($result)) {
            $job_location = $job_location . '"'. $row['job_location'].'",';
            $count_company_byLocation = $count_company_byLocation . '"'. $row['count_company_byLocation'].'",';
          }


          $job_location = trim($job_location,",");
          $count_company_byLocation = trim($count_company_byLocation,",");

        ?>

        <!DOCTYPE html>
        <html>
          <head>
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
            <title>Results5 updated Data</title>

            <style type="text/css">			
              body{
                font-family: Arial;
                  margin: 80px 100px 10px 100px;
                  padding: 0;
                  color: white;
                  text-align: center;
                  background: #555652;
              }

              .container {
                color: #E8E9EB;
                background: #222;
                border: #555652 1px solid;
                padding: 10px;
              }
            </style>

          </head>

          <body>	   
              <div class="container">	
              <h1>Top 10 locations have number of distinct companies hiring</h1>       
              <canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

              <script>
                var ctx = document.getElementById("chart").getContext('2d');
                  var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php echo $job_location; ?>],
                        datasets: 
                        [{
                            label: 'Number of distinct companies',
                            data: [<?php echo $count_company_byLocation; ?>],
                            backgroundColor: '#046af9',
                            // borderColor:'rgba(255,99,132)',
                            borderWidth: 3
                        },

  ]
                    },
                
                    options: {
                        scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                        tooltips:{mode: 'index'},
                        legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
                    }
                });
              </script>
              </div>
              
          </body>
        </html>