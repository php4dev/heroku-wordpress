@ECHO OFF

echo "Starting DB agent ..."

"pg_ctl" -D "C:\Users\KSAF\Documents\datadir" -l logfile stop

timeout /t 2 /nobreak

"pg_ctl" -D "C:\Users\KSAF\Documents\datadir" -l logfile start

timeout /t 2 /nobreak

echo "DB agent started ..."

pause

pause
