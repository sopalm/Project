<?php 
	function thai_date($strDate){
    	$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
        return "$strDay-$strMonth-$strYear";
    }
    function thai_date_time($time){
    	$time1 = explode("-", $time);
        $d = $time1['0'];
        $m = $time1['1'];
        $y = $time1['2'];

        $time2 = $d."-".$m."-".$y;
        return $time2;
    }	

    function thai_year($time){
        $time1 = explode("-", $time);
        $y = $time1['0']+543;
 
        return $y;
    }
    function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		//$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		//$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay-$strMonth-$strYear $strHour:$strMinute";
	}
	function DateThaiShow($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai พ.ศ. $strYear";
	}
	function DateThaietc($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
    function thai_show($time){
    	$time1 = explode("-", $time);
        $y = $time1['0']+543;
        $m = $time1['1'];
        $d = $time1['2']; 
        if($m==1){
        	$m='มกราคม';
        }
        else{
        	if($m==2){
	        	$m='กุมภาพันธ์';
	        }
	        else{
	        	if($m==3){
	        		$m='มีนาคม';
	        	}else{
	        		if($m==4){
			        	$m='เมษายน';
			        }
			        else{
			        	if($m==5){
				        	$m='พฤษภาคม';
				        }
				        else{
				        	if($m==6){
				        		$m='มิถุนายน';
				        	}else{
				        		if($m==7){
						        	$m='กรกฎาคม';
						        }
						        else{
						        	if($m==8){
							        	$m='สิงหาคม';
							        }
							        else{
							        	if($m==9){
							        		$m='กันยายน';
							        	}else{
							        		if($m==10){
									        	$m='ตุลาคม';
									        }
									        else{
									        	if($m==11){
										        	$m='พฤศจิกายน';
										        }
										        else{
										        	if($m==12){
										        		$m='ธันวาคม';
										        	}
										        }
									        }
							        	}
							        }
						        }
				        	}
				        }
			        }
	        	}
	        }
        }	
        $time2 = $d." ".$m." ".$y;
        return $time2;
    } 
?>