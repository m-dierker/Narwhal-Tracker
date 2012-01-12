<?php
    
    foreach($data as $row) {
        $donation_values = $row['Donation']['don_id'] ."," .
            $row['Donation']['don_date'] ."," .
            $row['Donation']['don_date_processed'] ."," .
            $row['Donation']['don_amt'];
        foreach($row['Donor'] as $value) {
            $value = '\"' . $value . '\"';
        }
        foreach($row['RevenueSource'] as $value) {
            $value = '\"' . $value . '\"';
        }
        echo $donation_values . ','
            . implode(",", $row['Donor']) . ','
            . implode(",", $row['RevenueSource'])
            . "\n";
    }

?>