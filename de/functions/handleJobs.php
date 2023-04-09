<?php

$conn = connect();

$jobs = getJobs($conn);

print_r($jobs);

?>