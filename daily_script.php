<?php

/*
   - run daily at 00:00GMT, by cron
   - query "hour_data" table & store the following :
     - open price of the day,      (opening price at 24 hrs before)
     - heighest price of the day,  (heighest price within the last 24 hrs)
     - lowest price of the day,    (lowest price within the last 24 hrs)
     - closing price of the day    (closing price )

   - store the data into "daily_data" table of db
*/