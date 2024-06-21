<?php
    if (getenv("PRODUCTION") != "true") {
        putenv("DB_HOST=localhost");
        putenv("DB_USER=root");
        putenv("DB_NAME=z124008");
        putenv("DB_PASS=");
    }
