<!DOCTYPE html>
          <html>
          <head>
              <title>Scrapping results</title>
          </head>
          <div class= "ScappingBody">
              <table class= "ScappingTable">
                <div id="ScrappingHeader">
                  <tr>
                      <th>Job Title</th>
                      <th>Company</th>
                      <th>Location</th>
                      <th id="thSummary">Summary</th>
                      <th>Salary</th>
                      <th>Post Date</th>
                      <th>Today</th>
                      <th>Link</th>
                  </tr>
                </div>

                  <?php
                      $conn = mysqli_connect("localhost", "root", "", "nicepage");
                      if($conn -> connect_error) {
                          die("Connection failed:". $conn -> connect_error);
                      }
                  
                      $sql= "SELECT * FROM `results5 updated` WHERE job_title != 'job_title' ";
                      $result = $conn -> query($sql);

                      if ($result -> num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo "
                                <tr>
                                  <td>" . $row["job_title"]. "</td>
                                  <td>" . $row["company"] . "</td>
                                  <td>" . $row["job_location"] . "</td>
                                  <td>" . $row["job_summary"] . "</td>
                                  <td>" . $row["job_salary"] . "</td>
                                  <td>" . $row["post_date"] . "</td>
                                  <td>" . $row["today"] . "</td>
                                  <td>
                                    <a href= " . $row["job_url"] . " class='ScappingJobURLButton' >                                      
                                      <button>Job Site</button>
                                    </a>
                                    
                                  </td>
                                </tr>";
                          }
                          echo "</table>";
                      } else {
                          echo "0 result";
                      }

                      $conn -> close();
                  ?>

              </table>    

              <style type="text/css">	
                  .ScappingBody {
                    font-family: Lato, sans-serif;
                    height: 100vh;
                    display: grid;
                    /* justify-content: center; */
                    /* align-items: center; */
                    font-size: 0.9rem;
                    /* background-image: url(images/pexels-photo-2556956.jpg);  */
                    background-color: #CBE2FC;
                    overflow: scroll;


                  }

                  .ScappingTable {
                    border-collapse: collapse;
                    box-shadow: 45px 45px 45px 45px white;
                    margin: 50px;
                    text-align: left;
                    background-color: white;
                    overflow-y: scroll;
                    overflow-x: auto;
                               
                  }

                  th {
                      color: #2489FC;
                      background-color: #8FE0E9;
                      padding: 0.0rem 2rem;
                      height: 100px;
                      text-transform: uppercase;
                      letter-spacing: 0.1rem;
                      font-size: 0.9rem;
                      font-weight: 800;
                      position: sticky;
                      position: -webkit-sticky;
                      top: 5px;
                      z-index: 2;
                      
                  }
                  #thSummary {
                    padding: 0.0rem 5rem;
                  }
                  #ScrappingHeader{
                    position: fixed;
                  }

                  td{
                    padding: 1rem 2rem;
                    font-size: 0.8rem;
                  }

                  tr:nth-child(even){
                    background-color: #CBE2FC;
                  }

                  tr:hover{
                    transform: scale(1.05);
                    box-shadow: 30px 30px 30px 30px white;
                  }

                  .ScappingJobURLButton{
                    font-size: 1.0rem;
                    border: transparent;
                  
                  }


              </style>

          </body>
          </html>