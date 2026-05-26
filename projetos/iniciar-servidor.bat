@echo off
title Corinthians - Servidor Local
cd /d "%~dp0"

echo ============================================
echo   Site Corinthians - Servidor Local
echo ============================================
echo.
echo Pasta: %cd%
echo.
echo Primeira vez? Leia: COMO-ABRIR.txt
echo.

if not exist "index.html" (
    echo [ERRO] Arquivo index.html nao encontrado nesta pasta!
    echo Execute este arquivo dentro da pasta "projetos".
    pause
    exit /b 1
)

if exist "C:\xampp\php\php.exe" (
    set "PHP_EXE=C:\xampp\php\php.exe"
    goto start_server
)

where php >nul 2>&1
if %errorlevel%==0 (
    set "PHP_EXE=php"
    goto start_server
)

echo [ERRO] PHP nao encontrado. Instale o XAMPP:
echo https://www.apachefriends.org/download.html
pause
exit /b 1

:start_server
echo Site:  http://localhost:8000/
echo API:   http://localhost:8000/api/index.php
echo.
echo NAO FECHE esta janela enquanto usa o site.
echo Para parar o servidor: Ctrl+C
echo.

start "" cmd /c "timeout /t 2 /nobreak >nul && start http://localhost:8000/"
"%PHP_EXE%" -S localhost:8000 router.php

pause
