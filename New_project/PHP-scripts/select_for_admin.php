<?php
	$idRequest = $resultRequestFirst['id'];
        $idUser = $resultRequestFirst['user'];
        $idDirection = $resultRequestFirst['destination'];
        $timeFrom = (substr($resultRequestFirst['time_from'], 0, -3));
        $timeTo = (substr($resultRequestFirst['time_to'], 0, -3));
                echo "<tr>";
                        $queryUser = mysqli_query($dbConnection, "SELECT * FROM user where id = '".$idUser."'");
                        while ($resultUser = mysqli_fetch_array($queryUser)) 
                        {
                                $idDepartment =  $resultUser['department'];
                                echo "<td>";
                                echo
                                $resultUser['surname']. " ".
                                $resultUser['name']{0}. ".".
                                $resultUser['patronymic']{0};
                                echo "</td>";
                        }
                        $queryDepartment = mysqli_query($dbConnection, "SELECT * FROM department where id = '".$idDepartment."'");
                        while ($resultDepartment= mysqli_fetch_array($queryDepartment)) 
                        {
                                echo "<td>";
                                echo $resultDepartment['name'];
                                echo "</td>";
                        }
                        $queryDirection = mysqli_query($dbConnection, "SELECT * FROM direction where id = '".$idDirection."'");
                        while ($resultDirection= mysqli_fetch_array($queryDirection)) 
                        {
                                echo "<td>";
                                echo $resultDirection['destination'];
                                echo "</td>";
                        }                  
                        echo "<td class = 'dateFirst'>";
                        	echo $timeFrom;
                        echo "</td>";
                         
                        echo "<td class = 'dateEnd'>";
                        	echo $timeTo;
                        echo "</td>";    
                        echo "<form action = '#' name='str' method='post' onsubmit = 'return false;'>";              
                        echo "<td>";
                        echo "<select id = 'car".$idRequest."' name = 'car' class='car' required='required'>";
                        	if($ms == 0)
                        	{
                                        $massCarTime= array ();
                                        $massLenght = 0;
	                                echo "<option disabled selected = 'selected'>Выберите машину</option>"; 
	                                $queryCar = mysqli_query($dbConnection, "SELECT * FROM car");                                    
	                                while ($resultCar = mysqli_fetch_assoc($queryCar)) 
	                                {
                                                $queryCarRequestEnd = mysqli_query($dbConnection, "SELECT * FROM request_end WHERE car =".$resultCar['id']);
                                                if(mysqli_num_rows($queryCarRequestEnd) > 0 )
                                                {
                                                        while ($resultCarRequestEnd = mysqli_fetch_assoc($queryCarRequestEnd)) 
                                                        {
                                                                $queryCarRequestFirst = mysqli_query($dbConnection, "SELECT * FROM request_first WHERE id =".$resultCarRequestEnd['request_first']);
                                                                while ($resultCarRequestFirst = mysqli_fetch_assoc($queryCarRequestFirst)) 
                                                                {
                                                                       $timeToCar =  (substr($resultCarRequestFirst['time_to'], 0, -3));
                                                                       if($timeFrom >= $timeToCar)
                                                                       {
                                                                                echo '<option value="'.$resultCar['id'].'">'.$resultCar['number'].'</option>';        
                                                                       }
                                                                       else
                                                                       {
                                                                                $massCarTime[$massLenght] = $resultCar['id'];
                                                                                $massLenght++;
                                                                       }
                                                                }
                                                        }
                                                }
                                                else
                                                        echo '<option value="'.$resultCar['id'].'">'.$resultCar['number'].'</option>'; 
                                                       
	                                } 
                                        
                                        foreach ($massCarTime as $ar)
                                        {
                                                ?>
                                                        <script type="text/javascript">
                                                                var massiv = <?php echo $ar ?>;
                                                                var selectCar = document.getElementsByClassName('car');
                                                                for(var i = 0; i < selectCar.length; i++)
                                                                {
                                                                        for (var j = 0; j <= selectCar[i].options.length-1; j++)
                                                                        {
                                                                                if(selectCar[i].options[j].value == massiv)
                                                                                {
                                                                                        selectCar[i].remove(j);
                                                                                }
                                                                        }
                                                                }           
                                                        </script>
                                                <?php
                                         }
                                } 
                                else if($ms == 1)
                                {      
                                	while ($resultCarRequestEnd = mysqli_fetch_assoc($queryCheckRequestEnd))
                                	{
	                                	$queryCarIdRequestEnd = mysqli_query($dbConnection, "SELECT * FROM car WHERE id =".$resultCarRequestEnd['car']); 
	                                	while ($resultCarIdRequestEnd = mysqli_fetch_assoc($queryCarIdRequestEnd))
	                                	{
		                                	echo '<option selected = "selected" value="'.$resultCarIdRequestEnd['id'].'">'.$resultCarIdRequestEnd['number'].'</option>';
		                                	$queryCar = mysqli_query($dbConnection, "SELECT * FROM car where id !=".$resultCarRequestEnd['car']);
		                                	while ($resultCar = mysqli_fetch_assoc($queryCar)) 
			                                {
			                                       echo '<option value="'.$resultCar['id'].'">'.$resultCar['number'].'</option>';
			                                }
		                            	}
	                            	}
                                }                                                                                              
                        echo "</select>";
                        echo "</td>";
                        echo "<td>";
                        echo "<select id = 'driver".$idRequest."' name = 'driver' class='driver' required='required'>";
                        	if($ms == 0)
                        	{
                                        $massDriverTime = array ();
                                        $massLenght = 0;
	                                echo "<option disabled selected = 'selected'>Выберите водителя</option>";     
	                                $queryDriver= mysqli_query($dbConnection, "SELECT * FROM driver");                                    
	                                while ($resultDriver = mysqli_fetch_assoc($queryDriver)) 
	                                {
                                                $queryDriverRequestEnd = mysqli_query($dbConnection, "SELECT * FROM request_end WHERE driver =".$resultDriver['id']);
                                                if(mysqli_num_rows($queryDriverRequestEnd) > 0 )
                                                {
                                                        while ($resultDriverRequestEnd = mysqli_fetch_assoc($queryDriverRequestEnd)) 
                                                        {
                                                                $queryDriverRequestFirst = mysqli_query($dbConnection, "SELECT * FROM request_first WHERE id =".$resultDriverRequestEnd['request_first']);
                                                                while ($resultDriverRequestFirst = mysqli_fetch_assoc($queryDriverRequestFirst)) 
                                                                {
                                                                       $timeToDriver =  (substr($resultDriverRequestFirst['time_to'], 0, -3));
                                                                       if($timeFrom >= $timeToDriver)
                                                                       {
                                                                                echo '<option value="'.$resultDriver['id'].'">'.$resultDriver['surname'].'</option>';       
                                                                       }
                                                                       else
                                                                       {
                                                                                $massDriverTime[$massLenght] = $resultDriver['id'];
                                                                                $massLenght++;
                                                                       }
                                                                }
                                                        }
                                                }
                                                else
                                                        echo '<option value="'.$resultDriver['id'].'">'.$resultDriver['surname'].'</option>'; 
	                                } 

                                        foreach ($massDriverTime as $ar)
                                        {
                                                ?>
                                                        <script type="text/javascript">
                                                                var massiv = <?php echo $ar ?>;
                                                                var selectDriver = document.getElementsByClassName('driver');
                                                                for(var i = 0; i < selectDriver.length; i++)
                                                                {
                                                                        for (var j = 0; j <= selectDriver[i].options.length-1; j++)
                                                                        {
                                                                                if(selectDriver[i].options[j].value == massiv)
                                                                                {
                                                                                        selectDriver[i].remove(j);
                                                                                }
                                                                        }
                                                                }           
                                                        </script>
                                                <?php
                                         }
                                }  
                                else if($ms == 1)     
                                {    
                                	$queryCheckRequestEnd =  mysqli_query($dbConnection, "SELECT * FROM request_end WHERE request_first =".$idRequest);	
                                	while ($resultDriverRequestEnd = mysqli_fetch_assoc($queryCheckRequestEnd))
                                	{
	                                	$queryDriverIdRequestEnd = mysqli_query($dbConnection, "SELECT * FROM driver WHERE id =".$resultDriverRequestEnd['driver']); 
	                                	while ($resultDriverIdRequestEnd = mysqli_fetch_assoc($queryDriverIdRequestEnd))
	                                	{
		                                	echo '<option selected = "selected" value="'.$resultDriverIdRequestEnd['id'].'">'.$resultDriverIdRequestEnd['surname'].'</option>';
		                                	$queryDriver = mysqli_query($dbConnection, "SELECT * FROM driver where id !=".$resultDriverRequestEnd['driver']);
		                                	while ($resultDriver = mysqli_fetch_assoc($queryDriver)) 
			                                {
			                                       echo '<option value="'.$resultDriver['id'].'">'.$resultDriver['surname'].'</option>';
			                                }
		                            	}
	                            	}
                                }                                                                                          
                        echo "</select>";
                        echo "</td>";
                        echo "<td class = 'memo'>";
                        echo "<textarea id = 'desc".$idRequest."' name='desc'>";
                        		if($ms == 1)
                        		{
                        		       $queryCheckRequestEnd =  mysqli_query($dbConnection, "SELECT * FROM request_end WHERE request_first =".$idRequest);
                        		       while ($resultDescRequestEnd = mysqli_fetch_assoc($queryCheckRequestEnd))
                                	       {
                                		      echo $resultDescRequestEnd['note'];
                                	       }
                        		}
                        echo "</textarea>";
                        echo "</td>";
                        echo "<td class = 'savetd'>";
                        	if($ms == 0)
                                	echo "<button id = '".$idRequest."' data-id = '".$idRequest."' type = 'submit' name = 'save' class = 'save'>Сохранить</button>";
                                else if($ms == 1)
                                	echo "<button id = '".$idRequest."' data-id = '".$idRequest."' type = 'submit' name = 'save' class = 'saved'>Сохранить</button>";
                        echo "</td>";
                echo "</tr>";     
		echo "</form>";
?>