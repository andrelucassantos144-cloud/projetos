@echo off
title Corinthians - Faculdade
cd /d "%~dp0"
echo.
echo ==========================================
echo   Projeto Corinthians - Servidor Local
echo ==========================================
echo.
echo 1. Certifique-se que o MySQL do XAMPP esta ligado
echo 2. Importe database/corinthians.sql no phpMyAdmin
echo 3. Acesse: http://localhost/projeto-corinthians/
echo.
if exist "C:\xampp\php\php.exe" (
    echo Abrindo XAMPP - inicie Apache e MySQL manualmente.
    start "" "http://localhost/projeto-corinthians/"
    start "" "C:\xampp\xampp-control.exe"
) else (
    echo XAMPP nao encontrado. Instale em: https://www.apachefriends.org
)
pause
