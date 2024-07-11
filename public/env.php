<?php
    if (getenv("PRODUCTION") != "true") {
        putenv("DB_HOST=localhost");
        putenv("DB_USER=root");
        putenv("DB_NAME=test");
        putenv("DB_PASS=");
    }
