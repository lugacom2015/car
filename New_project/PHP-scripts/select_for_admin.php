<?php
		$idRequest = $resultRequestFirst['id'];
        $idUser = $resultRequestFirst['user'];
        $idDirection = $resultRequestFirst['destination'];
        $timeFrom = $resultRequestFirst['time_from'];
        $timeTo = $resultRequestFirst['time_to'];
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
                        echo "<td>";
                        echo (substr($timeFrom, 0, -3));
                        echo "</td>";
                        echo "<td>";
                        echo (substr($timeTo, 0, -3));
                        echo "</td>";
						echo "<form action = '#' name='str' method='post' onsubmit = 'return false;'>";
                        echo "<td>";
                        echo "<select id = 'car".$idRequest."' name = 'car' class='car'>";
                                echo "<option disabled selected = 'selected'>Выберите машину</option>";     
                                $queryCar = mysqli_query($dbConnection, "SELECT * FROM car");                                    
                                while ($resultCar = mysqli_fetch_assoc($queryCar)) 
                                {
                                        echo '<option value="'.$resultCar['id'].'">'.$resultCar['number'].'</option>';
                                }                                                                                                  
                        echo "</select>";
                        echo "</td>";
                        echo "<td>";
                        echo "<select id = 'driver".$idRequest."' name = 'driver' class='driver'>";
                                echo "<option disabled selected = 'selected'>Выберите водителя</option>";     
                                $queryDriver= mysqli_query($dbConnection, "SELECT * FROM driver");                                    
                                while ($resultDriver = mysqli_fetch_assoc($queryDriver)) 
                                {
                                        echo '<option value="'.$resultDriver['id'].'">'.$resultDriver['surname'].'</option>';
                                }                                                                                                  
                        echo "</select>";
                        echo "</td>";
                        echo "<td class = 'memo'>";
                        echo "<textarea id = 'desc".$idRequest."' name='desc'>";
                        echo "</textarea>";
                        echo "</td>";
                        echo "<td class = 'savetd'>";
                                echo "<button id = '".$idRequest."' data-id = '".$idRequest."' type = 'submit' name = 'save' class = 'saved'>Сохранить</button>";
                        echo "</td>";
                echo "</tr>";     
				echo "</form>";
?>