<?php
include("db.php"); I
$stmt = $conn->prepare("select mid,name, nic, gender, phone, joindate, relationship, epno from members");
$stmt->bind_result($mid, $name, $nic, $gender, $phone, $joindate, $relationship, $epno);
if ($stmt->execute()) {
while ( $stmt->fetch() ) {
$output[] = array ("mno"->$mid, "name" => $name, "nic" => $nic, "gender"=>$gender, "phone"=>$phone, "joindate"=$joindate );
}
echo json_encode( $output );
}
$stmt->close();
//}