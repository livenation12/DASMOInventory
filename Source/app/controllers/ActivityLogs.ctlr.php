<?php


class ActivityLogs extends Controller
{

          function index()
          {
                    $activityLog = new Activitylog();
                    $fetchLogs = $activityLog->findAll();
                    echo json_encode(["payload" => $fetchLogs ?? []]);
          }
}
