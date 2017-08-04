<? PHP
session_start ();
	If ( ! Isset ( $ _SESSION [ ' username ' ]) ||  ! Isset ( $ _SESSION [ ' password ' ]))
	{
		Header ( ' Location: Authorization.php ' );
	}
	include_once ( ' ../PHP-scripts/connectScript.php ' );
? >
< Html >
< Head >
	< Название > Страница администратора </ название >
	< Meta  http-equiv = " Content-Type "  content = " text / html "  charset = " UTF-8 " >
	< Link  rel = " stylesheet "  type = " text / css "  href = " ../Css-files/Admin.css "  media = " all " >	
	< Link  rel = " stylesheet "  type = " text / css "  href = " ../Css-files/table.css "  media = " all " >	
	< Script  src = " https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js " > < / script >
  	< Script  type = " text / javascript "  src = " ../Java_Script / JQuery / jquery.timepicker.js " > < / script >
  	< Link  rel = " stylesheet "  type = " text / css "  href = " ../Css-files/jquery.timepicker.css " />
  	< Script  type = " text / javascript "  src = " ../Java_Script / JQuery / bootstrap-datepicker.js " > < / script >
  	< Link  rel = " stylesheet "  type = " text / css "  href = " ../Css-files/bootstrap-datepicker.css " />
  	< Script  type = " text / javascript " >	
		Функция  funckSuccess ( idRequest , carId , driverId )
		{
			$ ( " # " + IdRequest). Css ( « фон » , « # 32CD32 » );
			$ ( " # " + IdRequest). Текст ( « Сохранено » );
			$ ( " # " + IdRequest). Mouseover ( функция ( событие )
			{
  				$ ( Это ). Css ( " border " , " 2px solid # 32CD32 " );
  				$ ( Это ). Css ( « переход » , « все 0,5 с » );
  				$ ( Это ). Css ( « фон » , « #fff » );
  				$ ( Это ). Css ( « цвет » , « # 32CD32 » );
  			});
  			$ ( " # " + IdRequest). Mouseout ( функция ( событие )
			{
				$ ( Это ). Css ( « фон » , « # 32CD32 » );
				$ ( Это ). Css ( « переход » , « все 1s » );
				$ ( Это ). Css ( " border " , " 2px solid #fff " );
				$ ( Это ). Css ( « цвет » , « #fff » );
			});
			$ ( " #driver " + idRequest). Change ( function ()
			{
				$ ( " # " + IdRequest). Css ( « фон » , « # 617a76 » );
				$ ( " # " + IdRequest). Текст ( « Сохранить » );
				$ ( " # " + IdRequest). Mouseover ( функция ( событие )
				{
	  				$ ( Это ). Css ( « граница » , « 2px solid # 617a76 » );
	  				$ ( Это ). Css ( « переход » , « все 0,5 с » );
	  				$ ( Это ). Css ( « фон » , « #fff » );
	  				$ ( Это ). Css ( « цвет » , « # 617a76 » );
	  			});
	  			$ ( " # " + IdRequest). Mouseout ( функция ( событие )
				{
					$ ( Это ). Css ( « фон » , « # 617a76 » );
					$ ( Это ). Css ( « переход » , « все 1s » );
					$ ( Это ). Css ( " border " , " 2px solid #fff " );
					$ ( Это ). Css ( « цвет » , « #fff » );
				});
			});
			$ ( " #car " + idRequest). Change ( function ()
			{
				$ ( " # " + IdRequest). Css ( « фон » , « # 617a76 » );
				$ ( " # " + IdRequest). Текст ( « Сохранить » );
				$ ( " # " + IdRequest). Mouseover ( функция ( событие )
				{
	  				$ ( Это ). Css ( « граница » , « 2px solid # 617a76 » );
	  				$ ( Это ). Css ( « переход » , « все 0,5 с » );
	  				$ ( Это ). Css ( « фон » , « #fff » );
	  				$ ( Это ). Css ( « цвет » , « # 617a76 » );
	  			});
	  			$ ( " # " + IdRequest). Mouseout ( функция ( событие )
				{
					$ ( Это ). Css ( « фон » , « # 617a76 » );
					$ ( Это ). Css ( « переход » , « все 1s » );
					$ ( Это ). Css ( " border " , " 2px solid #fff " );
					$ ( Это ). Css ( « цвет » , « #fff » );
				});	
			});
			вар selectCar =  документ . GetElementsByClassName ( ' автомобиль ' );
			для ( вар я =  0 ; я <=  selectCar . Длина - 1 ; я ++ )
			{
				вар valueOptionCar = selectCar [I]. Стоимость ;
				If (valueOptionCar ! = CarId)
				{
					для ( вар J =  0 ; J <= selectCar [I]. Варианты . Длина - 1 ; J ++ )
					{
						If (selectCar [i]. Options [j]. Значение  == carId)
						{
							selectCar [I]. Удалить (j);
							Перерыв ;
						}
					}
				}
			}
			
			вар selectDriver =  документ . GetElementsByClassName ( ' driver ' );
			для (я =  0 ; я <=  selectDriver . Длина - 1 ; я ++ )
			{
				вар valueOptionDriver = selectDriver [I]. Стоимость ;
				If (valueOptionDriver ! = DriverId)
				{
					для (J =  0 ; J <= selectDriver [I]. Варианты . Длина - 1 ; J ++ )
					{
						If (selectDriver [i]. Options [j]. Value  == driverId)
						{
							selectDriver [I]. Удалить (j);
							Перерыв ;
						}
					}
				}
			}
  		}
		$ ( Документ ). Ready ( функция ()
		{
			$ ( " .saved " ). Bind ( " click " , function ()
			{
				вар idRequest =  $ ( это ). Данные ( ' id ' );
				вар carId =  документ . GetElementById ( ' car '  + idRequest). Стоимость ;
				вар driverId =  документ . GetElementById ( ' driver '  + idRequest). Стоимость ;
				вар descId =  документ . GetElementById ( ' desc '  + idRequest). Стоимость ;
				If (carId ! =  " Выбрать машину "  && driverId ! =  " Выбрать водителя " )
				{	
					$ . Аякса 
					({
						Url :  " ../PHP-scripts/requestEnd.php " ,
						Тип :  « POST » ,
						Данные : ({
			    		Автомобиль : carId,
			    		Driver : driverId,
			    		по убыванию : descId,
			   			Id : idRequest
							}),
						DataType :  " html " ,
						Успех :  funckSuccess (idRequest, carId, driverId)
					});
				}
			});
		});
	< / Script >
</ Head >
< Body >
	< Div  class = " mid " >
		< Форма  действия = " <PHP? Эхо $ _SERVER [ ' PHP_SELF ' ]; ? > "    Имя = " админ "  метод = " пост " >
		< Div >
			< P  id = " datepairExample " >
			    < Input  type = " text "  name = " ds "  class = " date start "  value = " " />
			    < Input  type = " text "  name = " ts "  class = " time start "  value = " " />
			    < Button  type = " submit "  name = " search " > Поиск </ button >
			    < Input  type = " text "  name = " df "  class = " date end "  value = " " />
			    < Input  type = " text "  name = " tf "  class = " time end "  value = " " />
			</ P >
		</ Div >
		</ Form >
		< Table  class = ' table ' >
					< Tr >
						< Th > ФИО </ th >
						< Th > Откуда </ th >
						< Th > Куда </ th >
						< Th > Дата / Время с </ th >
						< Th > Дата / Время по </ th >
						< Th > Машина </ th >
						< Th > Водитель </ th >
						< Th > Примечание </ th >
						< Th > Сохранить </ th >
					</ Tr >
					<? PHP
		                 	$ QueryRequestFirst  =  mysqli_query ( $ dbConnection , " SELECT  *  FROM request_first WHERE view =  0 " );
		                     в то время как ( $ resultRequestFirst  =  mysqli_fetch_array ( $ queryRequestFirst ))
		                     {
	           					требуется  ' ../PHP-scripts/select_for_admin.php ' ;  
		                     }		           
					? >
		</ Table >
		<! - <button type = "submit" name = "save" class = "save"> Сохранить </ button> ->
		< Script >
	    		$ ( ' #datepairExample .time ' ). Timepicker ({
	       		 	' ShowDuration ' :  true ,
	      	     	' TimeFormat ' :  ' H: i ' ,
	      	     	« Шаг » :  15
	    		});
			    $ ( ' #datepairExample .date ' ). Datepicker ({
			        ' Format ' :  ' yyyy-md ' ,
			        ' Autoclose ' :  true
			    });			    
	    		$ ( ' #datepairExample ' ). Datepair ();
			< / Script >
		</ Form >	
	</ Div >
</ Body >
</ Html >