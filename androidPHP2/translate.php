<?php

function translateData(string $wordEng){
	$thai = array("น้ำหนัก", "ส่วนสูง", "ความดัน", "ความดัน ครั้งที่2");
	$eng = array("weight", "height", "blood_pressure", "blood_pressure_extra");
	for ($i=0; $i < count($eng); $i++) { 
		if ($wordEng == $eng[$i]) {
			return $thai[$i];
		}
	}
}

function translatePersonal(string $wordEng){
	$thai = array("โรคประจำตัว", "ยาที่ใช้ประจำ", "ประวัติการแพ้ยา/สารอื่นๆ", "ยาสมุนไพรฝยาลูกกลอน", "การผ่าตัด", "การดื่มสุรา", "การสูบบุหรี่");
	$eng = array("underlying_disease", "medicines", "medicines_history", "herbal_bolus", "operate", "alcohol", "smoke");
	for ($i=0; $i < count($eng); $i++) { 
		if ($wordEng == $eng[$i]) {
			return $thai[$i];
		}
	}
}

function translateFamily(string $wordEng){
	$thai = ["โรคหัวใจ", "โรคความดันโลหิตสูง", "โรคไขมันในเลือดสูง", "โรคเบาหวาน", "โรคมะเร็ง"];
	$eng = ["heart", "hypertension", "dyslipidemia", "diabetes_mellitus", "cancer"];
	for ($i=0; $i < count($eng); $i++) { 
		if ($wordEng == $eng[$i]) {
			return $thai[$i];
		}
	}
}

function translatePe(string $wordEng){
	$thai = ["รูปร่าง/ความสมบูรณ์ของร่างกาย", "ภาวะซีด เหลือง/บวม", "ศีรษะ คอต่อมน้ำเหลือง", "ตา หู คอ จมูก ปาก ช่องคอ", "ช่องปาก ฟัน เหงือก", "เสียงปอด รูปทรงทรวงอก", "เสียงหัวใจ", "ช่องท้อง ตับ ม้าม", "แขน ขา", "กระดูกสันหลัง กล้ามเนิ้อ", "ผิวหนัง"];
	$eng = ["general_appearance", "anemia", "head_cervival_nodes", "eyes_ear_throat_nose_mouth", "oral_teeth", "breath_sound", 
				"heartbeat", "abdomen", "arm_leg", "back_bone", "skin"];
	for ($i=0; $i < count($eng); $i++) { 
		if ($wordEng == $eng[$i]) {
			return $thai[$i];
		}
	}
}

function findSomeThing (string $dataEng,int $type){
	switch ($type) {
		case '0':
			return translateData($dataEng);
			break;
		case '1':
			return translatePersonal($dataEng);
			break;
		case '2':
			return translateFamily($dataEng);
			break;
		case '3':
			return translatePe($dataEng);
			break;
	}

}

?>