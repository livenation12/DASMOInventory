<?php
class Activitylog extends Model
{
          protected $allowedColumns = [
                    "activityLogId",
                    "action",
                    "providerId",
                    "consumerId",
                    "activityDate"
          ];

          protected $functionsBeforeInsert = [
                    "createActivityLogId",
                    "getDateTimeOfLog"
          ];

          protected $functionsAfterSelect = [
                    "getProviderById",
                    "formatActivityLogDate"
          ];

          public function createActivityLogId($data)
          {
                    $data["activityLogId"] = randomString(10);
                    return $data;
          }

          public function getDateTimeOfLog($data)
          {
                    $data["activityDate"] = date("Y-m-d H:i:s");
                    return $data;
          }

          public function formatActivityLogDate($data)
          {
                    // Get today's date
                    $today = new DateTime();
                    $todayDate = $today->format('Y-m-d');

                    // Get yesterday's date
                    $yesterday = new DateTime('yesterday');
                    $yesterdayDate = $yesterday->format('Y-m-d');

                    // Get the date one week ago
                    $oneWeekAgo = (new DateTime())->modify('-1 week');

                    if (is_array($data)) {
                              foreach ($data as $value) {
                                        // Create a DateTime object from the activityDate
                                        $activityDate = new DateTime($value->activityDate);
                                        $activityDateFormatted = $activityDate->format('Y-m-d');

                                        // Check if the date is today, yesterday, or within the last week
                                        if ($activityDateFormatted === $todayDate) {
                                                  $value->activityDate = "Today";
                                        } elseif ($activityDateFormatted === $yesterdayDate) {
                                                  $value->activityDate = "Yesterday";
                                        } elseif ($activityDate >= $oneWeekAgo) {
                                                  $value->activityDate = "Last week";
                                        } else {
                                                  $value->activityDate = $this->formatDate($value->activityDate);
                                        }
                              }
                              return $data;
                    }
          }

          public function formatDate($dateString)
          {
                    // Convert the date string to a DateTime object
                    $date = new DateTime($dateString);

                    // Format the date to your desired format, e.g., "Feb 21, 2004 1:00 PM"
                    return $date->format('M d, Y h:i A'); // Example format
          }

          public function getProviderById($data)
          {
                    $user = new User();
                    if (is_array($data)) {
                              foreach ($data as $value) {
                                        $provider = $user->single("userId", $value->providerId);
                                        $value->providerName = $provider->firstname . " " . $provider->lastname;
                              }
                              return $data;
                    }
          }
}
