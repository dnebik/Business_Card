<?php

$data = parse_ini_file("settings.ini", true);
$databaseData = $data["database"];
$dsn = "{$databaseData["driver"]}:host={$databaseData["host"]};port={$databaseData["port"]};dbname={$databaseData["schema"]}";

return new PDO($dsn, $databaseData["username"], $databaseData["password"]);