<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // code to handle form submission
}

$user_id = $_POST['user'];
$username = $_POST['username'];
$email = $_POST['email'];
$role = $_POST['role'];
$status = $_POST['status'];

$stmt = $db->prepare("UPDATE users SET username=?, email=?, role=?, status=? WHERE id=?");
$stmt->execute([$username, $email, $role, $status, $user_id]);

if ($stmt->rowCount() > 0) {
    echo "User information updated successfully.";
  }

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $user_id = $_GET['user'];
    $stmt = $db->prepare("SELECT username, email, role, status FROM users WHERE id=?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
}
