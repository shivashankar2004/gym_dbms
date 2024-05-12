<?php
include("db.php"); I
$stmt = $conn->prepare("select pid, planname, validity, amount from plan order by pid DESC");
$stmt->bind_result($pid, $planname, $validity, $amount);
if ($stmt->execute()) {
    while ( $stmt->fetch() ) {
        $output[] = array ("pid"=>$pid, "planname" => $planname, "validity" => $validity, "amount" => $amount);
    }
    echo json_encode( $output );
}
$stmt->close();
//}