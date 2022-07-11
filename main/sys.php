<?php

/**
 * ====================================================================================== RECORD VISITS
 */
class RecordVisits extends DbConnectt
{
	
	function __construct()
	{	
		$conn = parent::connect();

		$ip = $_SERVER['REMOTE_ADDR'];
		$today = substr(date("Y-m-d h:i:s"), 0,10);
		$sel_visits = $conn->prepare("SELECT * FROM egura_visits WHERE visit_ip='$ip'");
		$sel_visits->execute();
		if ($sel_visits->rowCount()==1) {
			$ft_sel_visits = $sel_visits->fetch(PDO::FETCH_ASSOC);
			$counts = $ft_sel_visits['visit_counts']+1;
			if ($ft_sel_visits['visit_day']!=$today) {
				$updt_vst = $conn->prepare("UPDATE egura_visits SET visit_counts='$counts',visit_day='$today' WHERE visit_ip='$ip'");
				$updt_vst->execute();
			}
		}else{
			$ins_vst = $conn->prepare("INSERT INTO egura_visits(visit_ip,visit_counts,visit_day,visit_status) VALUES('$ip',1,'$today','E')");
			$ins_vst->execute();
		}

	}
}
new RecordVisits();
?>