<?php
	/* This file is part of a copyrighted work; 
	it is distributed with NO WARRANTY. --F.Tumulak
	 */
	 
namespace DDC;

class DDCAnalytics extends \ConnectDB{

    public function getTopDDC(){

        $sql="

        SELECT
            ddc,
            classification,
            COUNT(*) AS total

        FROM extract_ddc

        GROUP BY
            ddc,
            classification

        ORDER BY total DESC

        LIMIT 80

        ";

        return $this->select($sql);

    }

}